<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\I18n\I18n;

class HomeController extends AppController
{
    public function initialize(): void
    {
        I18n::setLocale('en_US');
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
    }
}
