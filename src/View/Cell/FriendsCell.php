<?php
namespace App\View\Cell;

use Cake\View\Cell;

class FriendsCell extends Cell
{
    public function display(string $user_id)
    {

        $friends = $this->fetchTable("Friends")
            ->find()
            ->where([
                'OR' => [
                    ['requester_id' => $user_id],
                    ['recipient_id' => $user_id],
                ],
                'status' => 'success'
            ])
            ->toArray();

        $friendUserIds = [];
        foreach ($friends as $friend) {
            if ($friend->requester_id != $user_id) {
                $friendUserIds[] = $friend->requester_id;
            }
            if ($friend->recipient_id != $user_id) {
                $friendUserIds[] = $friend->recipient_id;
            }
        }

        if(!empty($friendUserIds)) {
            $users = $this->fetchTable("Users")
                ->find()
                ->where(['Users.id IN' => $friendUserIds])
                ->toArray();
        }


        foreach ($friends as $friend) {
            foreach ($users as $user) {
                if ($friend->requester_id == $user->id || $friend->recipient_id == $user->id) {
                    $friend->user = $user;
                    break;
                }
            }
        }

        $this->set('friends', $friends);
    }
}