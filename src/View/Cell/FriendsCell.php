<?php
namespace App\View\Cell;

use Cake\View\Cell;

class FriendsCell extends Cell
{
    protected $Friends;
    protected $Users;

    public function initialize(): void
    {
        parent::initialize();
        $this->Friends = $this->fetchTable('Friends');
        $this->Users = $this->fetchTable('Users');
    }

    public function display(string $user_id)
    {

        $friends = $this->Friends
            ->find()
            ->contain(['Requester', 'Recipient'])
            ->where([
                'OR' => [
                    ['requester_id' => $user_id],
                    ['recipient_id' => $user_id],
                ],
                'status' => 'success'
            ])
            ->toArray();

        // Attacher l'utilisateur ami à chaque relation
        foreach ($friends as $friend) {
            if ($friend->requester_id != $user_id) {
                $friend->user = $friend->requester;
            } else {
                $friend->user = $friend->recipient;
            }
        }

        $this->set('friends', $friends);
    }
}