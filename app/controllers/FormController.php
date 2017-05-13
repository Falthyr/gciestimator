<?php

class FormController extends CoreController
{
    public function initialize()
    {
        parent::initialize();
        $this->di->setTitle($this->defaultTitle . 'Form');
    }

    public function indexAction()
    {

    }
}
