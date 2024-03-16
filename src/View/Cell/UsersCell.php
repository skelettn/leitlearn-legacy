<?php
namespace App\View\Cell;

use Cake\View\Cell;

class UsersCell extends Cell
{
    public function display()
    {
        $users = $this->fetchTable("Users")->find()->limit(20)->toArray();

        $this->set('users', $users);
    }

    public function display_public_data(int $user_id)
    {
        $friends = $this->fetchTable("Users")
            ->find()
            ->contain(['Friends'])
            ->where(['Users.id' => $user_id])
            ->count();

        $packets = $this->fetchTable("Packets")
            ->find()
            ->contain(['Users'])
            ->where(['Users.id' => $user_id])
            ->count();

        $this->set('friends', $friends);
        $this->set('packets', $packets);
    }
}