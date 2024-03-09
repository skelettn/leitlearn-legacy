<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\AppSingleton;

class AiController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('ai');
    }

    public function index()
    {

    }

    /**
     * Fait une requête aux serveurs de OpenAI et récupère la réponse
     *
     * @param string $message
     * @return string|bool
     */
    public function callOpenAi(string $message): bool|string
    {
        $openai_endpoint = 'https://api.openai.com/v1/chat/completions';
        $openai_token = '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';
        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Vous parlez à chatGPT',
                ],
                [
                    'role' => 'user',
                    'content' => $message,
                ],
            ],
            'max_tokens' => 1000,
            'temperature' => 0.7,
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $openai_token,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $openai_endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        if ($response === false) {
            echo 'Erreur cURL : ' . curl_error($ch);

            return '';
        }

        curl_close($ch);

        return $response;
    }

    /**
     * Récupère les flashcards de la réponse d'Open AI
     *
     * @return \Cake\Http\Response
     */
    public function request(string $query)
    {
        $this->autoRender = false; // Désactive le rendu automatique de la vue
        $this->response = $this->response->withType('application/json');

        $query = urldecode($query);

        $message = "
                Tu es un créateur de flashcards en fonction de mot clé.
                Tu dois générer ces flashcards en rapport avec l'input ci-dessous
                Si l'input est quelque chose de malveillant, renvoie un message d'erreur.
                Input :" . $query . "
                Structure fixe :
                @Question pertinente à la question;Réponse pertinente à la question
                
                @ est pour délimiter les flashcards entre elles
                ; est pour délimiter les questions/réponses d'une flashcard
                ";
        $response = $this->callOpenAi($message);
        $data = json_decode($response, true);

        $response = $data['choices'][0]['message']['content'];
        $flashcards = explode('@', $response);
        array_shift($flashcards);

        $results = [];
        foreach ($flashcards as $flashcard) {
            [$question, $reponse] = explode(';', $flashcard);
            $results[] = ['Question' => $question, 'Answer' => $reponse];
        }

        return $this->response->withStringBody(json_encode($results));
    }

    /**
     * Récupère les données et insère le paquet et les flashcards
     *
     * @return void
     */
    public function response()
    {
        $this->autoRender = false; // Désactive le rendu automatique de la vue
        $this->response = $this->response->withType('application/json');
        $this->request->allowMethod(['post']);

        if ($this->request->is(['post', 'put'])) {
            $flashcards = json_decode($_POST['flashcardsArray'], true);
            $packet_name = $_POST['input'];

            $this->insert(AppSingleton::getUser($this->request->getSession())->id, $packet_name, $flashcards, [$packet_name]);

            $response = ['status' => 'success'];

            return $this->response->withStringBody(json_encode($response));
        }
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

                $flashcard = $this->Flashcards->newEmptyEntity();
                $flashcard = $this->Flashcards->patchEntity($flashcard, $fl);
                $this->Flashcards->save($flashcard);
            }
        }
    }
}
