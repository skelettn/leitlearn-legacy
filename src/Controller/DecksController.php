<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\I18n\FrozenTime;
use DateTime;

class DecksController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->setLayout('dashboard_refresh');
    }
}
