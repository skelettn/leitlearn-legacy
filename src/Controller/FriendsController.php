<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\AppSingleton;
use Cake\Http\Response;

class FriendsController extends AppController
{
    /**
     * Ajoute une relation entre 2 utilisateurs
     *
     * @param string $user_uid
     * @return \Cake\Http\Response
     */
    public function request(string $user_uid): Response
    {
        $user = $this->Friends->Users->find()->where(['user_uid' => $user_uid])->firstOrFail();

        $this->request->allowMethod(['post', 'request']);
        if ($this->request->is(['post', 'put'])) {
            $valid = true;
            $my_id = AppSingleton::getUser($this->request->getSession())->id;

            if ($user->id == $my_id) {
                $valid = false;
            }

            // Une relation existe
            if (!is_null($this->getRelation($user->id, $my_id))) {
                $valid = false;
            }

            if ($valid) {
                $request = $this->Friends->newEmptyEntity();
                $data = [
                    'requester_id' => $my_id,
                    'recipient_id' => $user->id,
                    'status' => 'pending',
                ];

                $request = $this->Friends->patchEntity($request, $data);

                if ($this->Friends->save($request)) {
                    $this->Flash->success(__('Votre demande d\'amis a été envoyé avec succès.'));
                } else {
                    $this->Flash->error(__('Une erreur s\'est produite.'));
                }
            } else {
                $this->Flash->error(__('Une demande d\'amis est déjà en cours vers cet utilisateur'));
            }
        }

        return $this->redirect($this->referer());
    }

    /**
     * Accepte la demande en amis
     *
     * @param string $requester_id
     * @return \Cake\Http\Response
     */
    public function accept(string $requester_id): Response
    {
        $user = $this->Friends->Users->find()->where(['user_uid' => $requester_id])->firstOrFail();
        $relation = $this->getRelation($user->id, $this->request->getSession()->read('Auth.id'));
        if (!is_null($relation)) {
            $data = ['status' => 'success'];
            $relation = $this->Friends->patchEntity($relation, $data);

            if ($this->Friends->save($relation)) {
                $this->Flash->success(__('Vous avez accepté la demande de l\'utilisateur'));
            } else {
                $this->Flash->success(__('Une erreur est survenue'));
            }
        }

        return $this->redirect($this->referer());
    }

    /**
     * Supprime la demande en amis
     *
     * @param string $requester_id
     * @return \Cake\Http\Response
     */
    public function delete(string $requester_id): Response
    {
        $user = $this->Friends->Users->find()->where(['user_uid' => $requester_id])->firstOrFail();
        $relation = $this->getRelation($user->id, $this->request->getSession()->read('Auth.id'));
        if (!is_null($relation)) {
            if ($this->Friends->delete($relation)) {
                $this->Flash->success(__('Vous avez refusé la demande de l\'utilisateur'));
            } else {
                $this->Flash->success(__('Une erreur est survenue'));
            }
        }

        return $this->redirect($this->referer());
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
        $relation = $this->Friends->find()
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
}
