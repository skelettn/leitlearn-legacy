<?php

namespace App\Controller;

use App\Utility\AppSingleton;
use Cake\Event\EventInterface;

class ArticlesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('home_market');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['index', 'view']);
    }

    public function index()
    {
    }

    public function view(string $url)
    {
        $article = $this->Articles
            ->find()
            ->where(['url' => $url])
            ->firstOrFail();

        $this->set(compact('article'));
    }

    public function add()
    {
    }

    public function delete()
    {
    }
}
