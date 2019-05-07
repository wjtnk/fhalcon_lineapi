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
}
