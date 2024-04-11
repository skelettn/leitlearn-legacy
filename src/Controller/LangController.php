<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Http\Exception\NotFoundException;
use Cake\I18n\I18n;

class LangController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['change']);
    }

    /**
     * Change language method.
     *
     * @param string $lang The language to change to.
     * @return \Cake\Http\Response Redirects the user to the previous page.
     * @throws \Cake\Http\Exception\NotFoundException If the language is invalid.
     */
    public function change(string $lang)
    {
        if (!in_array($lang, ['en-US', 'fr-FR'])) {
            throw new NotFoundException(__('Langue invalide'));
        }

        $this->request->getSession()->write('lang', $lang);
        I18n::setLocale($lang);

        return $this->redirect($this->referer());
    }
}
