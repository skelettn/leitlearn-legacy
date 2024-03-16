<?php
namespace App\View\Cell;

use Cake\View\Cell;

class FriendsCell extends Cell
{
    public function display()
    {
        $loggedInUserId = $this->request->getSession()->read('Auth.id');

        $friends = $this->fetchTable("Friends")
            ->find()
            ->where([
                'OR' => [
                    ['requester_id' => $loggedInUserId],
                    ['recipient_id' => $loggedInUserId],
                ],
                'status' => 'success'
            ])
            ->toArray();

        $friendUserIds = [];
        foreach ($friends as $friend) {
            if ($friend->requester_id != $loggedInUserId) {
                $friendUserIds[] = $friend->requester_id;
            }
            if ($friend->recipient_id != $loggedInUserId) {
                $friendUserIds[] = $friend->recipient_id;
            }
        }

        $users = $this->fetchTable("Users")
            ->find()
            ->where(['Users.id IN' => $friendUserIds])
            ->toArray();

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