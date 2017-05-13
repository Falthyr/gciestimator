<?php
use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

class SecurityPlugin extends Plugin
{
    public function getAcl()
    {
        if (!isset($this->persistent->acl)) {
            $acl = new AclList();
            $acl->setDefaultAction(Acl::DENY);

            $roles = [
                'users'  => new Role('Users'),
                'guests' => new Role('Guests')
            ];

            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            $privateResources = [
                'master'    => ['index', 'create', 'update', 'delete'],
                'form'      => ['index', 'create', 'update', 'delete'],
                'session'   => ['logout']
            ];
            foreach ($privateResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }

            $publicResources = [
                'index'      => ['index'],
                'session'    => ['index', 'login'],
                'errors'     => ['error401', 'error404', 'error500'],
            ];
            foreach ($publicResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }

            foreach ($roles as $role) {
                foreach ($publicResources as $resource => $actions) {
                    foreach ($actions as $action){
                        $acl->allow($role->getName(), $resource, $action);
                    }
                }
            }

            foreach ($privateResources as $resource => $actions) {
                foreach ($actions as $action){
                    $acl->allow('Users', $resource, $action);
                }
            }

            $this->persistent->acl = $acl;
        }

        return $this->persistent->acl;
    }

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $auth = $this->session->get('auth');

        if (!$auth) {
            $role = 'Guests';
        } else {
            $role = 'Users';
        }

        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
        $acl = $this->getAcl();

        if (!$acl->isResource($controller)) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action'     => 'error404'
            ]);

            return false;
        }

        $allowed = $acl->isAllowed($role, $controller, $action);

        if (!$allowed) {
            $dispatcher->forward(array(
                'controller' => 'errors',
                'action'     => 'error401'
            ));
            $this->session->destroy();

            return false;
        }
    }
}
