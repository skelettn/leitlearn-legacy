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
}