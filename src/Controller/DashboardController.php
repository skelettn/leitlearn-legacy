<?php
declare(strict_types=1);

namespace App\Controller;

class DashboardController extends AppController
{
    public function index()
    {
        if ($this->request->getSession()->check('leitlearn_2_new_ui_enabled')) {
            $this->redirect('/dashboard/refresh');
        }
    }

    public function refresh()
    {
        $this->viewBuilder()->setLayout('dashboard_refresh');
    }

    /**
     * Enable the new UI
     *
     * @return void
     */
    public function enableNewUi()
    {
        if (!$this->request->getSession()->check('leitlearn_2_new_ui_enabled')) {
            $this->request->getSession()->write('leitlearn_2_new_ui_enabled', 1);
            $this->Flash->success('Voici un aperçu de la nouvelle interface');
            $this->redirect('/dashboard/refresh');
        } else {
            $this->Flash->success('Vous êtes revenu à l\'ancienne interface.');
            $this->request->getSession()->delete('leitlearn_2_new_ui_enabled');
            $this->redirect('/dashboard');
        }
    }
}
