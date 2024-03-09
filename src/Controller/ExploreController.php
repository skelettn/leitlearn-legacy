<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class ExploreController extends AppController
{
    public function p(string $category = NULL)
    {
        $this->set(compact('category'));
    }
}
