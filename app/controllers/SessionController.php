<?php

class SessionController extends CoreController
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle($this->defaultTitle . 'Log In');
    }

    public function indexAction()
    {
        if ($this->request->isPost()) {
            $userId = $this->request->getPost('user_id');
            $password = $this->request->getPost('password');
            $user = Users::findFirst(array(
                "user_id = :user_id: AND password = :password:",
                'bind' => array('user_id' => $userId, 'password' => sha1($password))
            ));
            if ($user) {
                return $this->_login($user);
            }
            $this->flash->error('Wrong user id/password');
        }
    }

    private function _registerSession(Users $user)
    {
        $this->session->set('auth', array(
            'id' => $user->user_id,
        ));
    }

    public function _login($user)
    {
        $this->_registerSession($user);
        $this->flash->success('Welcome, ' . $user->user_id);

        return $this->response->redirect('index/index');
    }

    public function logoutAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Successfully logged out');

        return $this->response->redirect('index/index');
    }
}
