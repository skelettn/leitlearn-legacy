<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\AppSingleton;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Response;
use Cake\I18n\FrozenTime;

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
            $flashcard = $this->Flashcards->get($id);
            $packet = $this->Flashcards->Packets->find()->where(['id' => $flashcard->packet_id])->first();
            $user_id = $this->request->getSession()->read('Auth.id');

            if (!$this->matchUserWithPacket($user_id, $packet->packet_uid)) {
                $valid = false;
            }

            if ($valid) {
                if ($this->Flashcards->find()->where(['packet_id' => $packet->id])->count() > 1) {
                    $this->Flashcards->deleteAll(['id' => $id, 'packet_id' => $packet->id]);
                    $this->Flash->success('Votre flashcards a été supprimé avec succès.');
                } else {
                    $this->Flash->error(__('Une erreur s\'est produite lors de la suppression de la flashcards.'));
                }

                return $this->redirect('/deck/' . $packet->packet_uid);
            } else {
                $this->Flash->error(__('Une erreur s\'est produite lors de la suppression de la flashcards.'));
            }
        }

        return $this->redirect('/dashboard');
    }

    /**
     * Modification d'une flashcard
     *
     * @return \Cake\Http\Response|null
     */
    public function edit(int $packet_id): ?Response
    {

        if ($this->request->is(['post', 'put'])) {
            $valid = true;
            $user_id = $this->request->getSession()->read('Auth.id');
            $data = $this->request->getData();
            $flashcard_id = $data['flashcard_id'];

            $flashcard = $this->Flashcards->find()
                ->where(['id' => $flashcard_id])
                ->first();

            $packet = $this->Flashcards->Packets->get($packet_id);

            if (
                $flashcard === null
                || !$this->matchUserWithPacket($user_id, $packet->packet_uid)
                || !$this->flashcardInPacket($flashcard->id, $packet->id)
                || $data['question'] == '<p><br></p>'
                || $data['answer'] == '<p><br></p>'
            ) {
                $valid = false;
            }

            if ($valid) {
                $data['id'] = $flashcard_id;
                $flashcard = $this->Flashcards->patchEntity($flashcard, $data);
                if ($this->Flashcards->save($flashcard)) {
                    $this->Flash->success(__('Flashcard modifié avec succès.'));

                    return $this->redirect('/deck/' . $packet->packet_uid);
                }
            } else {
                $this->Flash->error(__('Une erreur s\'est produite lors de la modification de la flashcard.'));
            }
        }

        return $this->redirect('/dashboard');
    }

    /**
     * Création d'une flashcard
     *
     * @return \Cake\Http\Response|null
     */
    public function create(int $packet_id): ?Response
    {
        $flashcard = $this->Flashcards->newEmptyEntity();

        if ($this->request->is(['post', 'put'])) {
            $valid = true;
            $packet = $this->Flashcards->Packets->get($packet_id);
            $data = $this->request->getData();

            if (!$this->matchUserWithPacket(AppSingleton::getUser($this->request->getSession())->id, $packet->packet_uid)) {
                $valid = false;
            }

            if ($valid) {
                $data['packet_id'] = $packet->id;
                $flashcard = $this->Flashcards->patchEntity($flashcard, $data);

                if ($this->Flashcards->save($flashcard)) {
                    $this->Flash->success(__('Votre carte a été crée avec succès.'));
                } else {
                    $this->Flash->success(__('Une erreur s\'est produite lors de la création de la carte.'));
                }
            } else {
                $this->Flash->success(__('Une erreur s\'est produite lors de la création de la carte.'));
            }
        }

        return $this->redirect('/deck/' . $packet->packet_uid);
    }

    /**
     * Incrémente le dossier Leitlearn de la flashcards +1
     *
     * @param int|null $flashcard_id
     * @return \Cake\Http\Response
     */
    public function increase()
    {
            $this->autoRender = false;
            $this->response = $this->response->withType('application/json');
            $data = $this->request->getData();

            $flashcard = $this->Flashcards->find()->where(['id' => $data['flashcard']])->first();
            $packet = $this->Flashcards->Packets->get($data['packet']);

        if ($flashcard && $this->matchUserWithPacket($this->request->getSession()->read('Auth.id'), $packet->packet_uid)) {
            $data_flashcard['leitner_folder'] = $flashcard->leitner_folder += 1;

            $now = FrozenTime::now();
            $days_to_add = $data_flashcard['leitner_folder'];
            $now = $now->modify('+' . $days_to_add . ' days');
            $data_flashcard['arrived'] = $now;

            $this->Flashcards->patchEntity($flashcard, $data_flashcard);

            if ($this->Flashcards->save($flashcard)) {
                $response = $data_flashcard['arrived'];
            } else {
                $response = ['status' => 'error', 'message' => 'La mise à jour a échoué.'];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Flashcard non trouvée.'];
        }

        return $this->response->withStringBody(json_encode($response));
    }

    /**
     * Importation de flashcards depuis le marché
     *
     * @return \Cake\Http\Response
     */
    public function importFromMarket(): Response
    {
        if ($this->request->is(['post', 'put'])) {
            $valid = true;

            if (!isset($this->request->getData()['selected_packet'])) {
                $valid = false;
            }

            if (!isset($this->request->getData()['flashcards'])) {
                $valid = false;
            }

            try {
                $packet = $this->Flashcards->Packets->get($this->request->getData()['selected_packet']);
            } catch (RecordNotFoundException $e) {
                return $this->redirect(['controller' => 'Home', 'action' => 'index']);
            }

            if (
                empty($this->request->getData()['flashcards'])
                || !$this->matchUserWithPacket(AppSingleton::getUser($this->request->getSession())->id, $packet->packet_uid)
            ) {
                $valid = false;
            }

            if ($valid) {
                $flashcards = $this->request->getData()['flashcards'];
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
                        $this->Flash->success(__('Cartes importées avec succès.'));
                    } else {
                        $this->Flash->error("Erreur dans l'importation des cartes.");
                    }
                }
            } else {
                $this->Flash->error(__("Erreur dans l\'importation des cartes."));
            }
        }

        return $this->redirect('/deck/' . $packet->packet_uid);
    }

    /**
     * Permet d'envoyer les données de la flashcard
     *
     * @param int $id
     * @return \Cake\Http\Response
     */
    public function get(int $id)
    {
        $this->response = $this->response->withType('application/json');
        $flashcard = $this->Flashcards->get($id);

        return $this->response->withStringBody(json_encode($flashcard));
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
     * @param string $packet_uid
     * @return bool
     */
    public function matchUserWithPacket(int $user_id, string $packet_uid): bool
    {
        return $this->Flashcards->Packets->find()
                ->select()
                ->where([
                    'user_id' => $user_id,
                    'packet_uid' => $packet_uid,
                ])
                ->count() >= 1;
    }
}
