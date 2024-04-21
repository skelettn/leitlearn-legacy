<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class HomeController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('home_market');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['index']);
    }

    public function index()
    {
        if ($this->request->getSession()->check('Auth.id')) {
            return $this->redirect('/dashboard');
        }
    }
}
