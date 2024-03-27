<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\I18n\FrozenTime;
use DateTime;

class SessionsController extends AppController
{
    private $packet;
    private $session;

    public function index(string $session_uid)
    {

        $this->viewBuilder()->setLayout('play');

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

        $this->set(compact('flashcards', 'session', 'packet'));
    }

    public function getFlashcards()
    {
        $now = new DateTime();
        $flashcards = [];
        foreach ($this->packet['flashcards'] as $flashcard) {
            if ($now >= $flashcard['arrived'] && $flashcards['leitner_folder'] < 7) {
                $flashcards[] = $flashcard;
            }
        }

        return $flashcards;
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
                    $existingSession->session_uid
                )
            ) {
                return $this->redirect('/session/' . $existingSession->session_uid);
            }
        } catch (RecordNotFoundException $e) {
        }

        $session = $this->Sessions->newEmptyEntity();
        $session->session_uid = $this->generateUID();
        $session->packet_id = $id;

        if ($this->Sessions->save($session)) {
            $this->Flash->success('Session de jeu créée avec succès');

            return $this->redirect('/session/' . $session->session_uid);
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
    public function matchUserWithPacketAndSessions(int $user_id, int $packet_id, string $session_uid): bool
    {
        return $this->Sessions->Packets->find()
                ->select()
                ->where([
                    'user_id' => $user_id,
                    'id' => $packet_id,
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

    public function delete($session_uid)
    {
        $session = $this->Sessions->find()->contain(['Packets'])->where(['session_uid' => $session_uid])->firstOrFail();

        if (
            $this->matchUserWithPacketAndSessions(
                $this->request->getSession()->read('Auth.id'),
                $session->packet_id,
                $session->session_uid
            )
        ) {
            if ($this->Sessions->delete($session)) {
                $packet = $this->Sessions->Packets
                    ->find()
                    ->contain(['Flashcards'])
                    ->where(['packet_uid' => $session->packet->packet_uid])
                    ->first();
                foreach ($packet['flashcards'] as $flashcard) {
                    $flashcard->leitner_folder = 1;
                    $now = FrozenTime::now();
                    $flashcard->arrived = $now;
                    $this->Sessions->Packets->Flashcards->save($flashcard);
                }
                $this->request->getFlash()->success('Session terminée !');
            } else {
                $this->request->getFlash()->success('Erreur dans le suppression de la session.');
            }
        }

        return $this->redirect('/deck/' . $session->packet->packet_uid);
    }
}
