<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use App\Utility\AppSingleton;
use Cake\Controller\Controller;
use Cake\ORM\Query\SelectQuery;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Flash');

        /*
         * Definition of the singleton application class to obtain one instance.
         */
        $app = AppSingleton::getInstance();
        $user_data = $app->getUser($this->request->getSession());
        $is_logged = $this->request->getSession()->check('Auth.id');

        $this->set(compact('app', 'user_data', 'is_logged'));

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    function generate_long_uid(): string
    {
        $uid = uniqid('user_', true);

        return $uid;
    }

    /**
     * Récupère les paquets avec un filtre
     *
     * @param string $filter
     * @param int|null $logged_user_uid
     * @return mixed
     */
    public function fetchPackets(string $filter, ?int $logged_user_uid = null): mixed
    {
        switch ($filter) {
            case 'trend':
                return $this->Packets->find()->where(['public' => 1])->limit(10);
            case 'import':
                return $this->Packets->find()->where(['public' => 1])->order(['importation_count' => 'DESC'])->limit(10);
            case 'ai':
                return $this->Packets->find()->where(['ia' => 1, 'public' => 1])->limit(10);
            case 'public':
                return $this->Packets->find()->where(['public' => 1]);
            case 'my':
                return $this->Packets->find()->where(['user_id' => $logged_user_uid]);
            case 'my_ia':
                return $this->Packets->find()->where(['user_id' => $logged_user_uid, 'ia' => 1]);
            case 'my_no_ia':
                return $this->Packets->find()->where(['user_id' => $logged_user_uid, 'ia' => 0]);
            default:
                return $this->Packets->find();
        }
    }

    /**
     * Récupère l'identifiant du dernier paquet crée par l'utilisateur
     *
     * @return int
     */
    public function getLastPacket(): int
    {
        $id = $this->Packets->find()
            ->select(['id'])
            ->where(['user_id' => AppSingleton::getUser($this->request->getSession())->id])
            ->order(['id' => 'DESC'])
            ->limit(1)
            ->first();

        return $id->id;
    }

    /**
     * Supprime les accents d'une chaîne de caractères.
     *
     * @param string $string
     * @return string
     */
    public function removeAccents($string)
    {
        return iconv('UTF-8', 'ASCII//TRANSLIT', $string);
    }

    public function generateUID()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $result = '';

        for ($j = 0; $j < 4; $j++) {
            $randomString = '';
            for ($i = 0; $i < 7; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            $result .= $randomString;
            if ($j < 3) {
                $result .= '-';
            }
        }

        return $result;
    }
}
