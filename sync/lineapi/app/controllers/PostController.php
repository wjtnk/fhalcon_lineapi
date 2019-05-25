<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PostController extends Controller
{



    public function indexAction()
    {
      //一覧表示
      $this->view->posts = Posts::find();


    }

    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Posts", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }
        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }
        //
        $posts = Posts::find($parameters);
        if (count($posts) == 0) {
            $this->flash->notice("The search did not find any posts");
            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "index",
                ]
            );
        }
        //
        $paginator = new Paginator(array(
            "data"  => $posts,
            "limit" => 10,
            "page"  => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
        $this->view->posts = $posts;
    }

    public function newAction()
    {

    }

    public function createAction()
    {
        $post = new Posts();
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

    #hogeAction($パラメータ)でurlにあるパラメータの値を取得
    public function deleteAction($id)
    {
      $post = Posts::findFirstById($id);
      $post->delete();
      $this->response->redirect("/post");
    }

    public function sendAction()
    {
    #フォームから送られてきた値は$this->request->getPost('name属性');で取得可能
      $id = $this->request->getPost('id');
      $post = Posts::findFirst($id);
      // privateメソッドを作り、参照することも可能
      $this->sendToLine($post);

      echo "Thanks for sending!";
      $this->view->disable();
      // return $this->response->redirect("/");
    }

    //privateメソッド
    private function sendToLine($post)
    {
      $access_token = $_ENV['ACCESS_TOKEN'];
      $user_id      = $_ENV['USER_ID'];
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
    }


}
