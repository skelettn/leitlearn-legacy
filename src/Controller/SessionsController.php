<?php

namespace App\Controller;

class SessionsController extends AppController
{
    public function index(string $session_uid)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $result = '';

        for ($j = 0; $j < 4; $j++) {
            $randomString = '';
            for ($i = 0; $i < 7; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            $result .= $randomString;
            if ($j < 3) {
                $result .= '-';
            }
        }
        dd($result);
        $packet = $this->Sessions->contains(['Packets'])
            ->find()
            ->where(['session_uid' => trim(htmlspecialchars($session_uid))])
            ->first();

        $this->set(compact('packet'));
    }

    public function create()
    {

    }

    public function join()
    {

    }
}
