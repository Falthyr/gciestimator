<?php

class MasterController extends CoreController
{
    public function initialize()
    {
        parent::initialize();
        $this->di->setTitle($this->defaultTitle . 'Master');
    }

    public function indexAction()
    {

    }
}
