<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\AppSingleton;
use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;
use DateTime;
use DateTimeImmutable;

class PacketsController extends AppController
{

    public function view(int $id)
    {

        $this->viewBuilder()->setLayout('play');

        $logged_user_uid = AppSingleton::getUser($this->request->getSession())->user_uid;
        $packet_id = htmlspecialchars((string)$id);

        try {
            $packet = $this->Packets->get($id, ['contain' => ['Flashcards', 'Keywords', 'Users']]);
        } catch (RecordNotFoundException $e) {
            // Si le paquet n'est pas trouvé on redirige vers dashboard
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        $handlePlayBtn = null;
        $handleRemainingTime = null;
        $leitlearn_folders = null;
        $date = null;

        $flashcards_numb = count($packet->flashcards);

        if($flashcards_numb != 0) {
            $all_appearances = $this->Packets->Flashcards->find()
                ->select('modified')
                ->where(['packet_id' => $packet_id])
                ->groupBy('modified')
                ->limit(1)
                ->first();

            $date = $all_appearances->modified;

            $handlePlayBtn = $this->handlePlayBtn($date);
            $handleRemainingTime = $this->handleRemainingTime($date);

            $leitlearn_folders = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0];
            foreach ($packet->flashcards as $flashcard) {
                $folder = $flashcard->leitnerFolder;
                if (isset($leitlearn_folders[$folder])) {
                    $leitlearn_folders[$folder]++;
                }
            }
        }

        $is_my_packet = true;
        $is_private = true;

        if ($packet->public == 1) {
            $is_private = false;
        }

        if ($packet->user->user_uid !== $logged_user_uid) {
            $is_my_packet = false;
        }

        $creator = $this->Packets->Users->get($packet->creator_id);

        $dashboard_sidebar_title = $packet->name;

        $this->set(compact('packet', 'date', 'dashboard_sidebar_title', 'handlePlayBtn', 'handleRemainingTime', 'is_private', 'is_my_packet', 'leitlearn_folders', 'creator', 'flashcards_numb'));
    }

    /**
     * Récupère un paquet en fonction de la requête
     *
     * @param string|null $query La requête de recherche
     * @return \App\Controller\json
     */
    public function get(?string $query = null, ?string $category = null)
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');

        if (empty($query)) {
            return $this->response->withStringBody(json_encode([]));
        }

        $searchTerm = $this->removeAccents(trim($query));
        $escapedTerm = preg_quote($searchTerm, '/');

        if(!is_null($category)) {
            $paquets = $this->Packets->find()
                ->contain(['Keywords'])
                ->matching('Keywords', function ($q) use ($category) {
                    return $q->where(['Keywords.word' => $category]);
                })
                ->toArray();
        } else {
            $paquets = $this->Packets->find()->contain(['Keywords'])->toArray();
        }

        $filteredPaquets = [];
        foreach ($paquets as $paquet) {
            $name = $this->removeAccents($paquet->name);
            $keywords = [];
            foreach ($paquet->keywords as $keyword) {
                $keywords[] = $this->removeAccents($keyword->word);
            }
            $dataToSearch = array_merge([$name], $keywords);
            foreach ($dataToSearch as $data) {
                if (preg_match("/$escapedTerm/ui", $data)) {
                    $filteredPaquets[] = $paquet;
                    break;
                }
            }
        }

        return $this->response->withStringBody(json_encode($filteredPaquets));
    }

    /**
     * Récupère les données d'un paquet en JSON pour le market
     *
     * @param int $id
     * @return void
     */
    public function getMarket(int $id)
    {
        $this->autoRender = false; // Désactive le rendu automatique de la vue
        $this->response = $this->response->withType('application/json');

        $packet = $this->Packets->get($id);
        $flashcards = $this->Packets->Flashcards->find()->where(['packet_id' => $id])->toArray();

        $packetKeywords = [];
        $keywords = $this->Packets->Keywords->find()->toArray();
        foreach ($keywords as $keyword) {
            if ($keyword['exist'] == 1) {
                $packetKeywords[] = $keyword;
            }
        }
        $user_packets = [];
        if ($this->request->getSession()->check('Auth.id')) {
            $user_packets = $this->Packets->find()->where(['user_id' => AppSingleton::getUser($this->request->getSession())->id])->toArray();
        }

        $data = [
            'id' => $packet->id,
            'name' => $packet->name,
            'description' => $packet->description,
            'flashcards' => $flashcards,
            'keywords' => $packetKeywords,
            'user_packets' => $user_packets,
            'creator' => $this->Packets->Users->get($packet->creator_id),
        ];

        return $this->response->withStringBody(json_encode($data));
    }

    public function settings(int $id)
    {
        $this->viewBuilder()->setLayout('play');

        $logged_user_uid = AppSingleton::getUser($this->request->getSession())->user_uid;
        $packet_id = htmlspecialchars((string)$id);

        try {
            $packet = $this->Packets->get($id, ['contain' => ['Flashcards', 'Keywords', 'Users']]);
        } catch (RecordNotFoundException $e) {
            // Si le paquet n'est pas trouvé on redirige vers dashboard
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        if ($packet->user->user_uid !== $logged_user_uid) {
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        $flashcards_numb = count($packet->flashcards);

        $dashboard_sidebar_title = 'Paramètre de '. $packet->name;

        $this->set(compact('packet', 'flashcards_numb' ,'dashboard_sidebar_title'));
    }

    /**
     * Handle the visibility of the play-button
     *
     * @param $date
     * @return string
     */
    public function handlePlayBtn($date)
    {
        return (new DateTime() >= new DateTimeImmutable((string)$date)) ? '' : 'hidden';
    }

    /**
     * Handle the visibility of the remainingTime
     *
     * @param $date
     * @return string
     */
    public function handleRemainingTime($date)
    {
        return (new DateTime() >= new DateTimeImmutable((string)$date)) ? 'hidden' : '';
    }

    /**
     * Suppression d'un paquet
     *
     * @param int $id
     * @return \Cake\Http\Response|null
     */
    public function remove(int $id): ?\Cake\Http\Response
    {
        if ($this->request->is('post')) {
            $entity = $this->Packets->get($id);
            if ($this->Packets->delete($entity)) {
                $this->Flash->success('Votre paquet a été supprimé avec succès.');
            } else {
                $this->Flash->error('Une erreur s\'est produite lors de la suppression du paquet.');
            }
        }

        return $this->redirect('/dashboard');
    }

    /**
     * Modification d'un paquet
     *
     * @param int $id
     * @return \Cake\Http\Response|null
     */
    public function modify(int $id): ?\Cake\Http\Response
    {
        $packet = $this->Packets->find()
            ->where(['id' => $id])
            ->contain('Keywords')
            ->firstOrFail();

        if ($this->request->is(['post', 'put'])) {

            $data = $this->request->getData();

            if(!empty($data['public'])) {
                $data['public'] = 1;
            } else {
                $data['public'] = 0;
            }

            $packet = $this->Packets->patchEntity($packet, $data);

            $keywordsEntities = [];
            if($this->request->getData('keywords')!=null){
                foreach ($this->request->getData('keywords') as $keyword) {
                    $keywordEntity = $this->Packets->Keywords->findOrCreate(['id' => $keyword]);
                    $keywordsEntities[] = $keywordEntity;

                }
                $packet->keywords = $keywordsEntities;
            }

            if ($this->Packets->save($packet, ['associated' => ['Keywords']])) {
                $this->Flash->success('Votre paquet a été modifié avec succès.');
            } else {
                $this->Flash->error('Une erreur s\'est produite lors de la modification du paquet.');
            }
        }

        return $this->redirect($this->referer());
    }

    /**
     * Création d'un paquet
     *
     * @return \Cake\Http\Response|null
     */
    public function create(): ?\Cake\Http\Response
    {
        $packet = $this->Packets->newEmptyEntity();

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            // Créateur du paquet
            $data['user_id'] = $this->request->getSession()->read('Auth.id');;
            $data['creator_id'] = $this->request->getSession()->read('Auth.id');;

            $packet = $this->Packets->patchEntity($packet, $data);

            if($this->request->getData('keywords')!=null){
                foreach ($this->request->getData('keywords') as $keyword) {
                    $keywordEntity = $this->Packets->Keywords->findOrCreate(['id' => $keyword]);
                    $keywordsEntities[] = $keywordEntity;

                }
                $packet->keywords = $keywordsEntities;
            }

            if ($this->Packets->save($packet, ['associated' => ['Keywords']])) {
                $this->Flash->success('Votre paquet a été créé avec succès.');
            } else {
                $this->Flash->error('Une erreur s\'est produite lors de la création du paquet.');
            }
        }

        return $this->redirect('/dashboard');
    }

    /**
     * Import packet to user's dashboard
     *
     * @return \Cake\Http\Response
     */
    public function import(): ?\Cake\Http\Response
    {
        if ($this->request->is(['post', 'put'])) {
            $packet_id = $this->request->getData()['packet_id'];
            $valid = true;

            try {
                $packet = $this->Packets->get($packet_id);

                if (!$packet->public) {
                    $valid = false;
                }

                if ($valid) {
                    $packet_data = [
                        'id' => $packet->id,
                        'name' => $packet->name,
                        'description' => $packet->description,
                        'ia' => $packet->ia,
                        'user_id' => AppSingleton::getUser($this->request->getSession())->id,
                        'creator_id' => $packet->creator_id,
                    ];

                    $packet = $this->Packets->newEntity($packet_data);
                    $this->Packets->save($packet);

                    $last_id = $this->getLastPacket();
                    $flashcards = $this->Packets->Flashcards->find()->where(['packet_id' => $packet_data['id']])->toArray();

                    foreach ($flashcards as $flashcard) {
                        $data  = [
                            'packet_id' => $last_id,
                            'question' => $flashcard->question,
                            'answer' => $flashcard->answer,
                        ];

                        $flashcard = $this->Packets->Flashcards->newEntity($data);
                        $this->Packets->Flashcards->save($flashcard);
                    }
                    $this->Flash->success('Votre paquet a été importé avec succès.');
                } else {
                    $this->Flash->error("Erreur dans l'importation du paquet.");
                }
            } catch (RecordNotFoundException $e) {
                $this->Flash->error("Le paquet demandé n'existe pas");
            }
        }

        return $this->redirect('/dashboard');
    }
}
