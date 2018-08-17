<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Acl\Controller\Component\AclComponent;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        $this->session = $this->request->session();
        parent::initialize();
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
          'authenticate' => [
              'Form' => [
                  'fields' => [
                      'username' => 'email',
                      'password' => 'password'
                  ]
              ]
          ],
          'loginAction' => [
              'controller' => 'Users',
              'action' => 'login'
          ],
           //use isAuthorized in Controllers
          'authorize' => ['Controller'],
           // If unauthorized, return them to page they were just on
          'unauthorizedRedirect' => false
      ]);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');

        // Get Login User
        $getUser = $this->Auth->user();
        if($getUser) {
            $this->loginUser = $getUser;
            $this->set('loginUser', $this->loginUser );
        }
        // $this->Auth->allow();
    }

    /**
     * isAuthorized
     *
     * @link   http://qiita.com/eiroh/items/f37a70a35103de6c6a1b
     * @param  array    $user   Array of user data.
     * @return bool
     */
    public function isAuthorized($user)
    {
        $Collection = new ComponentRegistry();
        $acl = new AclComponent($Collection);
        $controller = $this->request->controller;
        $action     = $this->request->action;
        return $acl->check(['Users' => ['id' => $user['id']]], "$controller/$action");
    }
}
