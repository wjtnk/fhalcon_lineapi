<?php

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase
{
    public function initialize()
    {
      // http://192.168.6.10:8000/session/indexの時のタイトルタグを挿入　詳細はhttps://docs.phalconphp.com/3.4/en/tutorial-invo Changing the Title Dynamicallyを参照
        $this->tag->setTitle('Sign Up/Sign In');
        parent::initialize();
    }

    // ログイン画面（http://192.168.6.10:8000/session/index）
    public function indexAction()
    {
        if (!$this->request->isPost()) {
          //http://192.168.6.10:8000/session/indexのUsername/Emailとpasword欄に初期値を代入
            $this->tag->setDefault('email', 'wjtnk@icloud.com');
            $this->tag->setDefault('password', 'renren1219');

        }

    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession(Users $user)
    {
        $this->session->set('auth', [
            'id' => $user->id,
            'name' => $user->name
        ]);
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
     // session/index.voltから投げられたstartアクション
    public function startAction()
    {
        if ($this->request->isPost()) {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = Users::findFirst([
                "(email = :email: OR username = :email:) AND password = :password: AND active = 'Y'",
                'bind' => ['email' => $email, 'password' => sha1($password)]
            ]);

            if ($user != false) {
                $this->_registerSession($user);
                $this->flash->success('Welcome ' . $user->name);
                return $this->dispatcher->forward(
                    [
                        "controller" => "post",
                        "action"     => "index",
                    ]
                );
            }
            $this->flash->error('Wrong email/password');
        }
        return $this->dispatcher->forward(
            [
                "controller" => "session",
                "action"     => "index",
            ]
        );
    }

    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->dispatcher->forward(
            [
                "controller" => "index",
                "action"     => "index",
            ]
        );
    }
}
