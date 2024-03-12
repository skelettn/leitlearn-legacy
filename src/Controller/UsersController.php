<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\User;
use App\Utility\AppSingleton;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\Event\EventInterface;
use Cake\Http\Response;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('home_market');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login', 'register']);
    }

    /**
     * Page qui affiche les informations de l'utilisateur
     *
     * @param string $user_uid
     * @return void
     */
    public function view(string $user_uid): void
    {
        $user = $this->Users->find()->where(['user_uid' => $user_uid])->first();

        if (!$user) {
            $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        $relation = $this->getRelation($user->id, $this->request->getSession()->read('Auth.id'));

        $this->viewBuilder()->setLayout('default');
        $this->set(compact('user', 'relation'));
    }

    public function settings()
    {
        $dashboard_sidebar_title = "Paramètres";

        $this->viewBuilder()->setLayout('default');
        $this->set(compact( 'dashboard_sidebar_title'));
    }

    /**
     * Connexion de l'utilisateur
     */
    public function login()
    {
        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/dashboard';
            $this->Flash->error('Connecté à Leitlearn');

            return $this->redirect($target);
        }

        if ($this->request->is('post')) {
            $this->Flash->error('Adresse e-mail ou mot de passe incorrect');
        }
    }

    /**
     * Inscription de l'utilisateur
     */
    public function register()
    {
        $user = $this->Users->newEmptyEntity();

        if (!empty($this->request->getData())) {
            $data = $this->request->getData();
            $data['user_uid'] = $this->generate_long_uid();
            $this->Users->patchEntity($user, $data);
            $this->Users->save($user);
            if ($this->Users->save($user)) {
                $this->Flash->success('Votre compte a été crée avec succès');
                $this->redirect('/dashboard');
            } else {
                $this->Flash->error('Erreur lors de la création de compte');
            }
        }

        $this->set(compact('user'));
    }

    /**
     * Déconnecte l'utilisateur
     *
     * @return \Cake\Http\Response|null
     */
    public function logout(): ?Response
    {
        $this->Authentication->logout();

        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Vérifie si le formulaire est valide pour mise à jour de l'utilisateur
     *
     * @return \Cake\Http\Response|null
     */
    public function update(): ?Response
    {
        $user = $this->Users->get(AppSingleton::getUser($this->request->getSession())->id);
        if ($this->request->is(['post', 'put'])) {
            /**
             * Problème avec les dates de naissances
             * + Récupérer les infos de la bd pour le formulaire
             * + Vérifier si les champs sont vides
             */
            $data = $this->request->getData();
            $file = $this->request->getData('profile_picture');
            $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
            $ext = ['jpg', 'avif', 'webp', 'jpeg', 'png'];

            if (in_array($extension, $ext) && $extension != '') {
                $file_name = bin2hex(random_bytes(32));
                $data['profile_picture'] = $file_name . '.' . $extension;
                $filePath = WWW_ROOT . 'img/user_profile_pic' . DS . $data['profile_picture'];
                $file->moveTo($filePath);
                $this->deleteOldImage($user);
            }else{
                $data['profile_picture'] = $user->profile_picture;
            }
            $user = $this->Users->patchEntity($user, $data);

            if ($this->Users->save($user)) {
                $this->Flash->success('L\'utilisateur a été mis à jour avec succès.');
            } else {
                $this->Flash->error('Erreur lors de la mise à jour de l\'utilisateur. Veuillez réessayer.');
            }
        } else {
            $this->Flash->error('jpg, avif ou webp seulement pris en compte');
        }
        return $this->redirect('/users/settings');
    }

    public function updatePassword(?string $id = null)
    {
        $user = $this->Users->get($this->request->getSession()->read('Auth.id'));

        if (!empty($this->request->getData())) {

            $data= $this->request->getData();
            if ((new DefaultPasswordHasher)->check($data['current_password'], $user->password)) {
                if ($data['new_password'] === $data['confirm_new_password']) {
                    $user->password = $data['confirm_new_password'];

                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('Votre mot de passe a été modifié'));
                    } else {
                        $this->Flash->error(__('Impossible de modifier votrre mot de passe. Veuillez réessayer.'));
                    }
                } else {
                    $this->Flash->error(__('Nouveau mot de passe et la confirmation ne correspondent pas.'));
                }
            } else {
                $this->Flash->error(__('Mot de passe est incorrect'));

            }
        }

        $this->set(compact('user'));
        return $this->redirect('/users/settings');

    }

    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get(AppSingleton::getUser($this->request->getSession())->id);

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('L\'utilisateur a été supprimé.'));
        } else {
            $this->Flash->error(__('Erreur lors de la suppression de l\'utilisateur.'));
        }

        return $this->redirect('/users/logout');
    }

    /**
     * Renvoie le status actuel d'une relation
     *
     * @param int $requester_id
     * @param int $recipient_id
     * @return App\Model\Entity\Friend|null
     */
    public function getRelation(int $requester_id, int $recipient_id)
    {
        $relation = $this->Users->Friends->find()
            ->where([
                'OR' => [
                    ['requester_id' => $requester_id, 'recipient_id' => $recipient_id],
                    ['requester_id' => $recipient_id, 'recipient_id' => $requester_id],
                ],
            ])
            ->first();

        if ($relation) {
            return $relation;
        }

        return null;
    }

    public function get(string $query)
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');

        if (empty($query)) {
            return $this->response->withStringBody(json_encode([]));
        }

        $searchTerm = $this->removeAccents(trim($query));
        $escapedTerm = preg_quote($searchTerm, '/');

        if(!is_null($query)) {
            $users = $this->Users->find()
                ->contain(['Friends'])
                ->where(['username LIKE' => '%' . $query . '%'])
                ->limit(20)
                ->toArray();
        }

        return $this->response->withStringBody(json_encode($users));
    }

    /**
     * Fonction pour supprimer l'ancienne image de l'utilisateur
     *
     * @param \App\Model\Entity\User $user .
     * @return void
     */
    private function deleteOldImage(User $user): void
    {
        $oldImageName = $user->profile_picture;

        $oldImagePath = WWW_ROOT . 'img/user_profile_pic' . DS . $oldImageName;

        if (
            file_exists($oldImagePath)
            && $oldImageName != 'a21c0b2e1b225581c475320be513af6f22ff6910ccb0045b8cf8f8b09160c39f.jpg'
        ) {
            unlink($oldImagePath);
        }
    }
}
