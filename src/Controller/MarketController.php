<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\AppSingleton;
use Cake\Event\EventInterface;

class MarketController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('home_market');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['index', 'get']);
    }

    public function index(): void
    {
    }

    public function category(string $category)
    {

        $this->set(compact('category'));
    }
}
