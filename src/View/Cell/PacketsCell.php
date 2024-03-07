<?php
namespace App\View\Cell;

use Cake\View\Cell;

class PacketsCell extends Cell
{
    public function display(string $filter, int $logged_user_id = null, string $display = "base")
    {
        $query = $this->fetchTable("Packets")->find()->contain(['Flashcards', 'Users', 'Keywords']);

        switch ($filter) {
            case 'trend':
                $query->where(['public' => 1])->limit(10);
                break;
            case 'import':
                $query->where(['public' => 1])->order(['importation_count' => 'DESC'])->limit(10);
                break;
            case 'ai':
                $query->where(['ia' => 1, 'public' => 1])->limit(10);
                break;
            case 'public':
                $query->where(['public' => 1]);
                break;
            case 'my':
                $query->where(['user_id' => $logged_user_id]);
                break;
            case 'my_ia':
                $query->where(['user_id' => $logged_user_id, 'ia' => 1]);
                break;
            case 'my_no_ia':
                $query->where(['user_id' => $logged_user_id, 'ia' => 0]);
                break;
            default:
                break;
        }

        $packets = $query->all();

        $this->set('packets', $packets);
        $this->set('display', $display);
    }

    public function protected(int $user_id)
    {
        $packets = $this->fetchTable("Packets")
            ->find()
            ->contain(['Flashcards', 'Users', 'Keywords'])
            ->where(['public' => 0, 'user_id' => $user_id])
            ->all()
        ;

        $this->set('packets', $packets);
    }
}