<?php
use Phalcon\Mvc\User\Component;

class Elements extends Component
{
    private $_headerMenu = [
        'navbar-left' => [
            'master' => [
                'caption' => 'Master',
                'action' => 'index'
            ],
            'form' => [
                'caption' => 'Forms',
                'action' => 'index'
            ],
        ],
        'navbar-right' => [
            'session' => [
                'caption' => 'Log In',
                'action' => 'index'
            ],
        ]
    ];

    public function getMenu()
    {
        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['navbar-right']['session'] = [
                'caption' => 'Log Out',
                'action' => 'logout'
            ];
        } else {
            unset($this->_headerMenu['navbar-left']);
        }
        $controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    }
}
