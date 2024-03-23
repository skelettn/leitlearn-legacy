<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\AppSingleton;
use Cake\Http\Response;

class LikesController extends AppController
{
    public function add()
    {
        $this->autoRender = false; // Désactive le rendu automatique de la vue
        $this->response = $this->response->withType('application/json');
        $this->request->allowMethod(['post']);


        if ($this->request->is(['post', 'put'])) {
            $packet_id = $this->request->getData('packet_id');
            $type = $this->request->getData('type');
            $user_id = $this->request->getSession()->read('Auth.id');

            $existing_like = $this->Likes
                ->find()
                ->where(['Likes.packet_id' => $packet_id, 'Likes.user_id' => $user_id])
                ->first();

            if ($existing_like) {
                if (($existing_like->liked && $type === 'like') || (!$existing_like->liked && $type === 'dislike')) {
                    $this->Likes->delete($existing_like);
                    $response = ['status' => 'success'];
                    return $this->response->withStringBody(json_encode($response));
                } else {
                    $this->Likes->delete($existing_like);
                }
            }

            $new_like = $this->Likes->newEmptyEntity();

            $data = [
                'packet_id' => $packet_id,
                'user_id' => $user_id,
            ];

            if ($type === 'like') {
                $data['liked'] = 1;
                $this->Likes->deleteAll(['packet_id' => $packet_id, 'user_id' => $user_id, 'liked' => 0]);
            } elseif ($type === 'dislike') {
                $data['liked'] = 0;
                $this->Likes->deleteAll(['packet_id' => $packet_id, 'user_id' => $user_id, 'liked' => 1]);
            }

            $this->Likes->patchEntity($new_like, $data);

            if ($this->Likes->save($new_like)) {
                $response = ['status' => 'success'];
            } else {
                $response = ['status' => 'error'];
            }
        }


        return $this->response->withStringBody(json_encode($response));
    }

    public function get(int $packet_id)
    {
        $this->autoRender = false; // Désactive le rendu automatique de la vue
        $this->response = $this->response->withType('application/json');
        $this->request->allowMethod(['get']);


        if ($this->request->is(['get'])) {

            $likes = $this->Likes
                ->find()
                ->where(['packet_id' => $packet_id, 'liked' => true])->count();

            $dislikes = $this->Likes
                ->find()
                ->where(['packet_id' => $packet_id, 'liked' => false])->count();

            $data = [
                'likes' => $likes,
                'dislikes' => $dislikes
            ];

        }

        return $this->response->withStringBody(json_encode($data));
    }
}
