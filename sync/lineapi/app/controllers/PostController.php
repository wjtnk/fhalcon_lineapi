<?php

use Phalcon\Mvc\Controller;

class PostController extends Controller
{
    public function indexAction()
    {
      $this->view->posts = Posts::find();

    }

    public function newAction()
    {

    }

    public function createAction()
    {
        $post = new Posts();

        // Store and check for errors
        $success = $post->save(
            $this->request->getPost(),
            [
                "message"
            ]
        );

        if ($success) {
            echo "Thanks for registering!";
        } else {
            echo "Sorry, the following problems were generated: ";

            $messages = $post->getMessages();

            foreach ($messages as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }
        $this->view->disable();
    }

    public function deleteAction($id)
    {
      $post = Posts::findFirstById($id);
      $post->delete();
      $this->response->redirect("/post");
    }

    public function sendAction()
    {
      $id = $this->request->getPost('id');
      $post = Posts::findFirst($id);

      $access_token = $_ENV['ACCESS_TOKEN'];
      $user_id = $_ENV['USER_ID'];

      //ヘッダ設定
      $header = array(
          'Content-Type: application/json',
          'Authorization: Bearer ' . $access_token
      );
      $message = array(
          'type' => 'text',
          'text' => $post->message
      );
      $body = json_encode(array(
          'to' => $user_id,
          'messages'   => array($message)
      ));
      $options = array(
          CURLOPT_URL=> 'https://api.line.me/v2/bot/message/push',
          CURLOPT_CUSTOMREQUEST  => 'POST',
          CURLOPT_HTTPHEADER     => $header,
          CURLOPT_POSTFIELDS     => $body,
          CURLOPT_RETURNTRANSFER => true
      );



      $curl = curl_init();
      curl_setopt_array($curl, $options);
      curl_exec($curl);
      curl_close($curl);
      /////////////////////////////////

      echo "Thanks for sending!";
      $this->view->disable();

      // return $this->response->redirect("/");
    }


}
