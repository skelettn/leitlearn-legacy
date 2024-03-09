<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\AppSingleton;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Response;
use DateTime;

class FlashcardsController extends AppController
{
    /**
     * Suppression d'une flashcard
     *
     * @param int $id
     * @return \Cake\Http\Response|null
     */
    public function delete(int $id): ?Response
    {
        if ($this->request->is('post')) {
            $valid = true;
            $packet = $this->Flashcards->find()->select('packet_id')->where(['id' => $id])->first();
            $user_id = $this->request->getSession()->read('Auth.id');

            if (!$this->matchUserWithPacket($user_id, $packet->packet_id)) {
                $valid = false;
            }

            if ($valid) {
                if ($this->Flashcards->find()->where(['packet_id' => $packet->packet_id])->count() > 1) {
                    $this->Flashcards->deleteAll(['id' => $id, 'packet_id' => $packet->packet_id]);
                    $this->Flash->success('Votre flashcards a été supprimé avec succès.');
                } else {
                    $this->Flash->error('Une erreur s\'est produite lors de la suppression de la flashcards.');
                }

                return $this->redirect('/packets/view/' . $packet->packet_id);
            } else {
                $this->Flash->error('Une erreur s\'est produite lors de la suppression de la flashcards.');
            }
        }

        return $this->redirect('/dashboard');
    }

    /**
     * Modification d'une flashcard
     *
     * @param int $id
     * @return \Cake\Http\Response|null
     */
    public function edit(int $id): ?Response
    {
        $flashcard = $this->Flashcards->find()
            ->where(['id' => $id])
            ->firstOrFail(); // Problème si n'existe pas


        if ($this->request->is(['post', 'put'])) {
            $valid = true;
            $user_id = $this->request->getSession()->read('Auth.id');

            if (
                !$this->matchUserWithPacket($user_id, $flashcard->packet_id)
                || !$this->flashcardInPacket($flashcard->id, $flashcard->packet_id)
            ) {
                $valid = false;
            }

            if ($valid) {
                $flashcard = $this->Flashcards->patchEntity($flashcard, $this->request->getData());
                if ($this->Flashcards->save($flashcard)) {
                    $this->Flash->success('Vos flashcards ont été modifié avec succès.');

                    return $this->redirect('/packets/view/' . $flashcard->packet_id);
                }
            } else {
                $this->Flash->error('Une erreur s\'est produite lors de la modification des flashcards.');
            }
        }

        return $this->redirect('/dashboard');
    }

    /**
     * Création d'une flashcard
     *
     * @return \Cake\Http\Response|null
     */
    public function create(): ?Response
    {
        $flashcard = $this->Flashcards->newEmptyEntity();

        if ($this->request->is(['post', 'put'])) {
            $valid = true;
            $packet_id = (int)$this->request->getData()['packet_id'];

            if (!$this->matchUserWithPacket(AppSingleton::getUser($this->request->getSession())->id, $packet_id)) {
                $valid = false;
            }

            if ($valid) {
                $flashcard = $this->Flashcards->patchEntity($flashcard, $this->request->getData());

                if ($this->Flashcards->save($flashcard)) {
                    $this->Flash->success('Votre flashcards a été crée avec succès.');
                } else {
                    $this->Flash->success('Une erreur s\'est produite lors de la création de la flashcard.');
                }
            } else {
                $this->Flash->success('Une erreur s\'est produite lors de la création de la flashcard.');
            }
        }

        return $this->redirect('/packets/view/' . $packet_id);
    }

    /**
     * Reverse les flashcards
     *
     * @param int $id
     * @return \Cake\Http\Response|null
     */
    public function reverse(int $id): ?Response
    {
        if ($this->request->is('post')) {
            $valid = true;

            if (!$this->matchUserWithPacket(AppSingleton::getUser($this->request->getSession())->id, $id)) {
                $valid = false;
            }

            if ($valid) {
                $flashcards = $this->Flashcards->find()->where(['packet_id' => $id])->toArray();

                foreach ($flashcards as $flashcard) {
                    $flashcard_id = $flashcard->id;
                    $question = $flashcard->question;
                    $answer = $flashcard->answer;

                    $flashcard = $this->Flashcards->get($flashcard_id);
                    $flashcard->question = $answer;
                    $flashcard->answer = $question;

                    $this->Flashcards->save($flashcard);
                }

                $this->Flash->success('Vos flashcards ont été modifié avec succès.');

                return $this->redirect('/packets/view/' . $id);
            } else {
                $this->Flash->error('Une erreur s\'est produite lors de la modification des flashcards.');
            }
        }

        return $this->redirect('/dashboard');
    }

    /**
     * Incrémente le dossier Leitlearn de la flashcards +1
     *
     * @param int|null $flashcard_id
     * @return \Cake\Http\Response
     */
    public function increase(?int $flashcard_id = null)
    {
        $this->autoRender = false; // Désactive le rendu automatique de la vue
        $this->response = $this->response->withType('application/json');

        $flashcard = $this->Flashcards->find()->where(['id' => $flashcard_id])->first();

        if ($flashcard) {
            $flashcard->leitnerFolder += 1;
            $flashcard->modified = new DateTime('+ 1 day');

            if ($this->Flashcards->save($flashcard)) {
                $response = ['status' => 'success'];
            } else {
                $response = ['status' => 'error', 'message' => 'La mise à jour a échoué.'];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Flashcard non trouvée.'];
        }

        return $this->response->withStringBody(json_encode($response));
    }

    /**
     * Impotation de flashcards depuis le marché
     *
     * @return \Cake\Http\Response
     */
    public function importFromMarket(): Response
    {
        if ($this->request->is(['post', 'put'])) {
            $valid = true;

            try {
                $packet = $this->Flashcards->Packets->get($this->request->getData()['selected_packet']);
            } catch (RecordNotFoundException $e) {
                return $this->redirect(['controller' => 'Home', 'action' => 'index']);
            }

            $flashcards = $this->request->getData()['flashcards'];

            if (
                empty($this->request->getData()['flashcards'])
                || !$this->matchUserWithPacket(AppSingleton::getUser($this->request->getSession())->id, $packet->id)
            ) {
                $valid = false;
            }

            if ($valid) {
                foreach ($flashcards as $flashcard) {
                    try {
                        $flashcard = $this->Flashcards->get($flashcard);
                    } catch (RecordNotFoundException $e) {
                        return $this->redirect(['controller' => 'Home', 'action' => 'index']);
                    }

                    $data = [
                        'packet_id' => $packet->id,
                        'question' => $flashcard->question,
                        'answer' => $flashcard->answer,
                        'leitnerFolder' => 1,
                    ];

                    $flashcard = $this->Flashcards->newEntity($data);

                    if ($this->Flashcards->save($flashcard)) {
                        $this->Flash->success('Flashcards importées avec succès.');
                    } else {
                        $this->Flash->error("Erreur dans l'importation des flashcards.");
                    }
                }
            } else {
                $this->Flash->error("Erreur dans l'importation des flashcards.");
            }
        }

        return $this->redirect('/packets/view/' . $packet->id);
    }

    /**
     * Vérifie si la flashcard est bien dans le paquet
     *
     * @param int $flashcard_id Identifiant de la flashcard
     * @param int $packet_id
     * @return bool
     */
    public function flashcardInPacket(int $flashcard_id, int $packet_id): bool
    {
        $flashcard = $this->Flashcards->find()
            ->where(['id' => $flashcard_id, 'packet_id' => $packet_id])
            ->first();

        return (bool)$flashcard;
    }

    /**
     * Vérifie si un utilisateur est le propriétaire du paquet
     *
     * @param int $user_id
     * @param int $packet_id
     * @return bool
     */
    public function matchUserWithPacket(int $user_id, int $packet_id): bool
    {
        return $this->Flashcards->Packets->find()
                ->select()
                ->where([
                    'user_id' => $user_id,
                    'id' => $packet_id,
                ])
                ->count() >= 1;
    }
}
