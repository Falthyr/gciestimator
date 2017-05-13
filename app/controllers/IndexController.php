<?php

class IndexController extends CoreController
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle($this->defaultTitle . 'Home');
    }

    public function indexAction()
    {
        if (!$this->session->get('auth'))
            return $this->response->redirect('session/index');
    }
}
