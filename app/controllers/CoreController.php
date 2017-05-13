<?php

use Phalcon\Mvc\Controller;

Class CoreController extends Controller
{
    protected $defaultTitle;

    protected function initialize()
    {
        $this->defaultTitle = 'GCI | ';
        $this->view->setTemplateAfter('main');
    }
}
