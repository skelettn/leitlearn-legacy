<?php
declare(strict_types=1);

namespace App\Controller;

class SessionsController extends AppController
{
    private $packet;
    private $flashcards;
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

        $this->set(compact('flashcards', 'session', 'packet'));
    }

    public function create()
    {
    }

    public function join()
    {
    }

    public function getFlashcards()
    {
        $flashcards = [];
        foreach ($this->packet['flashcards'] as $flashcard) {
            if ($flashcard->leitner_folder == $this->session['expected_folder'] - 1) {
                $flashcards[] = $flashcard;
            }
        }

        return $flashcards;
    }

    public function isFinished()
    {
        $finishedCardsCount = 0;
        $count = 0;
        foreach ($this->packet['flashcards'] as $flashcard) {
            $count++;
            if ($flashcard->leitner_folder == $this->session['expected_folder']) {
                $finishedCardsCount++;
            }
        }

        if ($finishedCardsCount === $count) {
            return true;
        }

        return false;
    }
}
