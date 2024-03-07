<?php
namespace App\View\Cell;

use Cake\View\Cell;

class FriendsCell extends Cell
{
    public function display()
    {
        $friends = $this->fetchTable("Friends")
            ->find()
            ->contain(['Users'])
            ->where([
                'OR' => [
                    ['requester_id' => $this->request->getSession()->read('Auth.id')],
                    ['recipient_id' => $this->request->getSession()->read('Auth.id')],
                ],
            ])
            ->where(['status' => 'success'])
        ;

        $this->set('friends', $friends->toArray());
    }
}