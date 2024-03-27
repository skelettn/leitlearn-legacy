<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\AppSingleton;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;
use Cake\Http\Response;
use Cake\I18n\Date;
use Cake\I18n\DateTime;
use Cake\I18n\FrozenTime;
use Cake\Validation\Validator;
use PDO;
use ZipArchive;

class PacketsController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['get', 'getMarket']);
    }

    public function view(string $packet_uid)
    {

        $this->viewBuilder()->setLayout('play');

        $logged_user_uid = AppSingleton::getUser($this->request->getSession())->user_uid;
        $packet_uid = htmlspecialchars($packet_uid);

        try {
            $packet = $this->Packets
                ->find()
                ->contain(['Flashcards', 'Keywords', 'Users', 'Sessions'])
                ->where(['packet_uid' => $packet_uid])
                ->first();
        } catch (RecordNotFoundException $e) {
            // Si le paquet n'est pas trouvé on redirige vers dashboard
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        foreach ($packet->flashcards as $flashcard) {
            $flashcard->time_string = $this->timeFormat($flashcard['arrived']);
        }

        $handleRemainingTime = null;
        $leitlearn_folders = null;

        $flashcards_numb = count($packet->flashcards);

        if ($flashcards_numb != 0) {
            $leitlearn_folders = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0];
            foreach ($packet->flashcards as $flashcard) {
                $folder = $flashcard->leitner_folder;
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

        try {
            $creator = $this->Packets->Users->get($packet->creator_id);
        } catch (RecordNotFoundException $e) {
            $creator = $this->Packets->Users->get($packet->user_id);
        }

        if (!empty($packet->sessions)) {
            $session = $packet->sessions[0];
            $date = $this->getPlayableFlashcardDate($packet['flashcards']);
            $now = new DateTime();
            $dateString = $date->format('Y-m-d\TH:i:s.uP');
            $this->set(compact('date', 'dateString', 'now', 'session'));
        }

        $this->set(compact('packet', 'handleRemainingTime', 'is_private', 'is_my_packet', 'leitlearn_folders', 'creator', 'flashcards_numb'));
    }

    /**
     * Crées un string pour identifier le temps restant avant
     * la prochaine apparition de la flashcard
     *
     * @param $time
     * @return string
     */
    public function timeFormat($time)
    {
        if (is_string($time)) {
            $time = new \Cake\I18n\DateTime($time);
            dd($time);
        }
        $now = new \Cake\I18n\DateTime();
        if ($time <= $now) {
            return 'Jouable maintenant';
        }

        $interval = $now->diff($time);

        if ($interval->days > 0) {
            return 'Jouable dans ' . $interval->days . ' jours';
        } elseif ($interval->h > 0) {
            return 'Jouable dans ' . $interval->h . ' h';
        } elseif ($interval->i > 0) {
            return 'Jouable dans ' . $interval->i . ' min';
        } elseif ($interval->s > 0) {
            return $interval->s . ' s';
        } else {
            return 'Jouable maintenant';
        }
    }

    /**
     * Récupère la date de la flashcard qui va etre jouable en première
     *
     * @param array $flashcards le tableau de flashcards
     * @return \DateTime
     */
    public function getPlayableFlashcardDate(array $flashcards)
    {
        $min_date = $flashcards[0]['arrived'];
        foreach ($flashcards as $flashcard) {
            if ($flashcard['arrived'] < $min_date) {
                 $min_date = $flashcard['arrived'];
            }
        }

        return $min_date;
    }

    /**
     * Récupère un paquet en fonction de la requête
     *
     * @param string|null $query La requête de recherche
     * @return Response
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

        if (!is_null($category)) {
            $paquets = $this->Packets->find()
                ->contain(['Keywords'])
                ->where(['status' => 1])
                ->matching('Keywords', function ($q) use ($category) {
                    return $q->where(['Keywords.word' => $category]);
                })
                ->toArray();
        } else {
            $paquets = $this->Packets->find()
                ->contain(['Keywords'])
                ->where(['status' => 1])
                ->toArray();
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
     * @return \Cake\Http\Response
     */
    public function getMarket(int $id)
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');

        try {
            $packet = $this->Packets
                ->find()
                ->contain(['Flashcards', 'Keywords'])
                ->where(['Packets.id' => $id])
                ->firstOrFail();
        } catch (RecordNotFoundException $e) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        if ($packet->status !== 1) {
            $this->Flash->error('This deck is private.');

            return $this->response->withStringBody(json_encode('This deck is private'));
        }

        $user_packets = [];
        if ($this->request->getSession()->check('Auth.id')) {
            $user_packets = $this->Packets->find()->where(['user_id' => AppSingleton::getUser($this->request->getSession())->id])->toArray();
        }

        $data = [
            'id' => $packet->id,
            'name' => $packet->name,
            'description' => $packet->description,
            'flashcards' => $packet->flashcards,
            'keywords' => $packet->keywords,
            'user_packets' => $user_packets,
            'creator' => $this->Packets->Users->get($packet->creator_id),
        ];

        return $this->response->withStringBody(json_encode($data));
    }

    public function settings(string $packet_uid)
    {
        $this->viewBuilder()->setLayout('play');

        $logged_user_uid = AppSingleton::getUser($this->request->getSession())->user_uid;
        $packet_uid = htmlspecialchars($packet_uid);

        try {
            $packet = $this->Packets
                ->find()
                ->contain(['Flashcards', 'Keywords', 'Users'])
                ->where(['packet_uid' => $packet_uid])
                ->first();
        } catch (RecordNotFoundException $e) {
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        if ($packet->user->user_uid !== $logged_user_uid) {
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        $flashcards_numb = count($packet->flashcards);

        $dashboard_sidebar_title = 'Paramètre de ' . $packet->name;

        $this->set(compact('packet', 'flashcards_numb', 'dashboard_sidebar_title'));
    }

    /**
     * Suppression d'un paquet
     *
     * @param int $id
     * @return \Cake\Http\Response|null
     */
    public function remove(int $id): ?Response
    {
        if ($this->request->is('post')) {
            $entity = $this->Packets->get($id);

            if ($entity->user_id == $this->request->getSession()->read('Auth.id')) {
                if ($this->Packets->delete($entity)) {
                    $this->Flash->success('Votre paquet a été supprimé avec succès.');
                } else {
                    $this->Flash->error('Une erreur s\'est produite lors de la suppression du paquet.');
                }
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
    public function modify(int $id): ?Response
    {
        $packet = $this->Packets->find()
            ->where(['id' => $id])
            ->contain('Keywords')
            ->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            if (!empty($data['status'])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }

            $packet = $this->Packets->patchEntity($packet, $data);

            $keywordsEntities = [];
            if ($this->request->getData('keywords') != null) {
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
    public function create(): ?Response
    {
        $packet = $this->Packets->newEmptyEntity();

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            // Créateur du paquet
            $data['packet_uid'] = $this->generateUID();
            $data['user_id'] = $this->request->getSession()->read('Auth.id');
            $data['creator_id'] = $this->request->getSession()->read('Auth.id');

            $packet = $this->Packets->patchEntity($packet, $data);

            if ($this->request->getData('keywords') != null) {
                foreach ($this->request->getData('keywords') as $keyword) {
                    $keywordEntity = $this->Packets->Keywords->findOrCreate(['id' => $keyword]);
                    $keywordsEntities[] = $keywordEntity;
                }
                $packet->keywords = $keywordsEntities;
            }
            if ($this->Packets->save($packet, ['associated' => ['Keywords','Sessions']])) {
                $this->Flash->success('Votre paquet a été créé avec succès.');
            } else {
                $this->Flash->error('Une erreur s\'est produite lors de la création du paquet.');
            }
        }

        return $this->redirect('/dashboard');
    }

    /**
     * Récupère les données et insère le paquet et les flashcards
     *
     * @return \Cake\Http\Response
     */
    public function aiResponse(): Response
    {
        $this->autoRender = false; // Désactive le rendu automatique de la vue
        $this->response = $this->response->withType('application/json');
        $this->request->allowMethod(['post']);

        if ($this->request->is(['post', 'put'])) {
            $flashcards = json_decode($this->request->getData('flashcards'), true);
            $packet_name = $this->request->getData('query');

            $response = ['status' => 'success'];
            $this->insert(AppSingleton::getUser($this->request->getSession())->id, $packet_name, $flashcards, [$packet_name]);
        }

        return $this->response->withStringBody(json_encode($response));
    }

    /**
     * Insère le paquet, les flashcards et les mots clés
     *
     * @param int $id
     * @param string $name
     * @param array $flashcards
     * @param array $keywords
     * @return void
     */
    public function insert(int $id, string $name, array $flashcards, array $keywords)
    {
        $data = [
            'name' => $name,
            'ia' => 1,
            'user_id' => $id,
            'creator_id' => $id,
        ];

        $packet = $this->Packets->newEntity($data);

        if ($this->Packets->save($packet)) {
            $latestPaquetID = $this->getLastPacket();

            foreach ($flashcards as $fl) {
                $fl['packet_id'] = $latestPaquetID;

                $flashcard = $this->Packets->Flashcards->newEmptyEntity();
                $flashcard = $this->Packets->Flashcards->patchEntity($flashcard, $fl);
                $this->Packets->Flashcards->save($flashcard);
            }
        }
    }

    /**
     * Import packet to user's dashboard
     *
     * @return \Cake\Http\Response
     */
    public function import($packet_id = null): ?Response
    {
        if ($this->request->is(['post', 'put'])) {
            if (isset($this->request->getData()['packet_id'])) {
                $packet_id = $this->request->getData()['packet_id'];
            }

            $valid = true;

            try {
                $packet = $this->Packets->get($packet_id);

                if ($packet->user_id == AppSingleton::getUser($this->request->getSession())->id) {
                    $valid = false;
                }

                if (!$packet->public) {
                    $valid = false;
                }

                if ($valid) {
                    $packet_data = [
                        'id' => $packet->id,
                        'packet_uid' => $this->generateUID(),
                        'name' => $packet->name,
                        'description' => $packet->description,
                        'ia' => $packet->ia,
                        'user_id' => AppSingleton::getUser($this->request->getSession())->id,
                        'creator_id' => $packet->creator_id,
                    ];

                    $packet = $this->Packets->newEntity($packet_data);
                    $this->Packets->save($packet);

                    $last_id = $this->getLastPacket();
                    $flashcards = $this->Packets->Flashcards
                        ->find()
                        ->where(['packet_id' => $packet_data['id']])
                        ->toArray();

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

    /**
     * Importation d'un paquet avec un fichier
     *
     * @return \Cake\Http\Response|null
     */
    public function importViaFile(): ?Response
    {
        if ($this->request->is('post')) {
            // Validation des données
            $validator = new Validator();
            $validator
                ->requirePresence('name')
                ->requirePresence('description')
                ->notEmptyFile('uploaded_file', __('Veuillez télécharger un fichier.'));

            $errors = $validator->validate($this->request->getData());
            $data = $this->request->getData();

            if (empty($errors)) {
                $uploadedFile = $this->request->getData('uploaded_file');
                $fileExtension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

                if ($fileExtension === 'csv') {
                    $csvContent = file_get_contents($uploadedFile->getStream()->getMetadata('uri'));
                    $csvRows = str_getcsv($csvContent, "\n"); // Séparer les lignes
                    $csvData = [];
                    $headerSkipped = false;

                    foreach ($csvRows as $csvRow) {
                        if (!$headerSkipped) {
                            $headerSkipped = true;
                            continue;
                        }

                        $csvData[] = str_getcsv($csvRow, ';'); // Séparer les colonnes
                    }

                    $packet = $this->Packets->newEmptyEntity();
                    $data['packet_uid'] = $this->generateUID();
                    $data['user_id'] = $this->request->getSession()->read('Auth.id');
                    $data['creator_id'] = $this->request->getSession()->read('Auth.id');
                    $packet = $this->Packets->patchEntity($packet, $data);

                    if ($this->Packets->save($packet)) {
                        $packet_id = $packet->id;

                        foreach ($csvData as $flashcard_data) {
                            $flashcard = $this->Packets->Flashcards->newEntity([
                                'packet_id' => $packet_id,
                                'question' => $flashcard_data[0],
                                'answer' => $flashcard_data[1],
                            ]);

                            $this->Packets->Flashcards->save($flashcard);
                        }

                        $this->Flash->error(__('Votre paquet a été crée avec succès.'));

                        return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
                    } else {
                        $this->Flash->error(__('Erreur lors de la sauvegarde du paquet.'));
                    }
                } elseif ($fileExtension === 'apkg') {
                    $folder = WWW_ROOT . 'temp_packet' . DS . AppSingleton::getUser($this->request->getSession())->user_uid;
                    if (!is_dir($folder)) {
                        mkdir($folder, 0777, false);
                    }
                    $apkg_file_path = $folder . DS . $uploadedFile->getClientFilename();

                    $uploadedFile->moveTo($apkg_file_path);
                    $this->importAnkiPackage($apkg_file_path);
                } else {
                    $this->Flash->error(__('Format de fichier non pris en charge.'));

                    return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
                }
            } else {
                $this->Flash->error(__('Erreur de validation.'));
            }
        }

        return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
    }

    private function importAnkiPackage($apkg_file_path)
    {
        $extracted_directory = WWW_ROOT . 'temp_packet' . DS . AppSingleton::getUser($this->request->getSession())->user_uid . DS;
        $archive = new ZipArchive();

        if ($archive->open($apkg_file_path) === true) {
            $archive->extractTo($extracted_directory);
            $archive->close();

            $this->apkgDatabase($extracted_directory . 'collection.anki2');
            if (
                file_exists($apkg_file_path)
            ) {
                unlink($extracted_directory . 'media');
                unlink($apkg_file_path);
            }
        } else {
            $this->Flash->error(__('Échec de l\'ouverture de l\'archive .apkg.'));
        }
    }

    public function export($packet_id)
    {
        $packet = $this->Packets->get($packet_id);
        if (!$packet) {
            $this->Flash->error(__('Paquet introuvable.'));

            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        $flashcards = $this->Packets->Flashcards->find()->where(['packet_id' => $packet_id])->toArray();
        $csvData = [];
        $csvData[] = ['Question', 'Réponse'];

        foreach ($flashcards as $flashcard) {
            $csvData[] = [$flashcard->question, $flashcard->answer];
        }

        $fileName = 'export_paquet_' . $packet_id . '.csv';
        $this->response = $this->response->withType('csv')->withDownload($fileName);

        $output = fopen('php://temp', 'w');
        foreach ($csvData as $row) {
            fputcsv($output, $row, ';');
        }
        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        $this->response->getBody()->write($csv);

        return $this->response;
    }

    private function apkgDatabase($database_path): ?Response
    {
            $pdo = new PDO('sqlite:' . $database_path);
            $results = $pdo->query('SELECT * FROM notes');
            $packet = $this->Packets->newEmptyEntity();
            $data = $this->request->getData();

            $data['user_id'] = $this->request->getSession()->read('Auth.id');
            $data['creator_id'] = $this->request->getSession()->read('Auth.id');

            $packet = $this->Packets->patchEntity($packet, $data);
        if ($this->Packets->save($packet)) {
            $packetId = $packet->id;

            foreach ($results as $flashcardData) {
                $flashcard = explode("\x1F", $flashcardData['flds']);
                $question = $flashcard[0];
                $answer = $flashcard[1];

                $flashcard = $this->Packets->Flashcards->newEntity([
                    'packet_id' => $packetId,
                    'question' => $question,
                    'answer' => $answer,
                ]);

                $this->Packets->Flashcards->save($flashcard);
            }
            if (
                file_exists($database_path)
            ) {
                unlink($database_path);
            }

            $this->Flash->error(__('Votre paquet a été crée avec succès.'));
        } else {
            $this->Flash->error(__('Erreur lors de la sauvegarde du paquet.'));
        }
            $pdo = null;

        return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
    }
}
