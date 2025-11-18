<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\InternalErrorException;
use Exception;

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
        $openai_token = env('OPENAI_API_KEY');
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
            $error = 'Erreur cURL : ' . curl_error($ch);
            error_log($error); // Journalisation de l'erreur
            curl_close($ch);
            throw new InternalErrorException($error);
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
        try {
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

            if (!isset($data['choices'][0]['message']['content'])) {
                throw new InternalErrorException('Réponse OpenAI invalide : contenu manquant.');
            }

            $responseContent = $data['choices'][0]['message']['content'];
            $flashcards = explode('@', $responseContent);
            array_shift($flashcards);

            $results = [];
            foreach ($flashcards as $flashcard) {
                [$question, $reponse] = explode(';', $flashcard);
                $results[] = ['Question' => $question, 'Answer' => $reponse];
            }

            return $this->response->withStringBody(json_encode($results));
        } catch (Exception $e) {
            $error = 'Erreur lors du traitement de la requête : ' . $e->getMessage();
            error_log($error); // Journalisation de l'erreur
            throw new InternalErrorException($error);
        }
    }
}
