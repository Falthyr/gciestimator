<?php

class ErrorsController extends CoreController
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle($this->defaultTitle . 'Error');
    }

    public function error401Action()
    {

    }

    public function error404Action()
    {

    }

    public function error500Action()
    {

    }
}
