<?php
namespace App\View\Cell;

use Cake\View\Cell;

class UsersCell extends Cell
{
    protected $Users;
    protected $Packets;

    public function initialize(): void
    {
        parent::initialize();
        $this->Users = $this->fetchTable('Users');
        $this->Packets = $this->fetchTable('Packets');
    }

    public function display()
    {
        $users = $this->Users->find()->limit(20)->toArray();

        $this->set('users', $users);
    }

    public function display_public_data(int $user_id)
    {
        $friends = $this->Users
            ->find()
            ->contain(['FriendsRequested', 'FriendsReceived'])
            ->where(['Users.id' => $user_id])
            ->count();

        $packets = $this->Packets
            ->find()
            ->contain(['Users'])
            ->where(['Users.id' => $user_id])
            ->count();

        $this->set('friends', $friends);
        $this->set('packets', $packets);
    }
}