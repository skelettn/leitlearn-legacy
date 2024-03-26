<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use DateTime;

class SessionsController extends AppController
{
    private $packet;
    private $session;

    public function index(string $session_uid)
    {

        $session = $this->Sessions
            ->find()
            ->contain(['Packets'])
            ->where(['session_uid' => trim(htmlspecialchars($session_uid))])
            ->first();

        $packet = $this->Sessions->Packets
            ->find()
            ->contain(['Flashcards'])
            ->where(['packet_uid' => $session->packet->packet_uid])
            ->first();

        $this->packet = $packet;
        $this->session = $session;
        $flashcards = $this->getFlashcards();

        $now = new DateTime();
        if ($session->next_launch > $now) {
            return $this->redirect('/deck/' . $packet->packet_uid);
        }

        $this->set(compact('flashcards', 'session', 'packet'));
    }

    public function getFlashcards()
    {
        $flashcards = [];
        foreach ($this->packet['flashcards'] as $flashcard) {
            if ($flashcard->leitner_folder === $this->session['expected_folder'] - 1) {
                $flashcards[] = $flashcard;
            }
        }

        return $flashcards;
    }

    public function increase()
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');
        $data = $this->request->getData();

        $session = $this->Sessions->find()->contain(['Packets'])->where(['packet_id' => $data['packet']])->first();

        $now = new DateTime();
        $now->modify('+1 days');
        $session_folder['next_launch'] = $now;

        $session_folder['expected_folder'] = $session->expected_folder += 1;

        $session = $this->Sessions->patchEntity($session, $session_folder);

        if ($this->Sessions->save($session)) {
            $response = $this->Sessions->save($session);
        } else {
            $response = ['status' => 'error', 'message' => 'La mise à jour a échoué.'];
        }

        return $this->response->withStringBody(json_encode($response));
    }

    function createOrRedirect($id = null)
    {
        try {
            $existingSession = $this->Sessions->find('all', [
                'conditions' => ['packet_id' => $id],
                'limit' => 1,
            ])->first();

            if (
                $existingSession &&
                $this->matchUserWithPacketAndSessions(
                    $this->request->getSession()->read('Auth.id'),
                    $existingSession->packet_id,
                    $existingSession->id
                )
            ) {
                return $this->redirect('/sessions/index/' . $existingSession->session_uid);
            }
        } catch (RecordNotFoundException $e) {
        }

        $session = $this->Sessions->newEmptyEntity();
        $session->session_uid = $this->generateUID();
        $session->expected_folder = 2;
        $session->packet_id = $id;

        if ($this->Sessions->save($session)) {
            $this->Flash->success('Session de jeu créée avec succès');

            return $this->redirect('/sessions/index/' . $session->session_uid);
        } else {
            $this->Flash->error('Erreur lors de la création de la session de jeu');
        }

        return $this->redirect('/deck/' . $id);
    }

    /**
     * Vérifie si un utilisateur est le propriétaire du paquet et de la session
     *
     * @param int $user_id
     * @param string $packet_uid
     * @param string $session_uid
     * @return bool
     */
    public function matchUserWithPacketAndSessions(int $user_id, string $packet_uid, string $session_uid): bool
    {
        return $this->Sessions->Packets->find()
                ->select()
                ->where([
                    'user_id' => $user_id,
                    'packet_uid' => $packet_uid,
                ])
                ->count() >= 1
            &&
            $this->Sessions->find()
                ->select()
                ->where([
                    'session_uid' => $session_uid,
                ])
                ->count() >= 1;
    }
}
