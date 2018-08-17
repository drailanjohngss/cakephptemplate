<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Routing\Router;
use App\Model\Table\MasterSignupProcessesTable;

/**
 * Landing Controller
 *
 * @author Drailan John Terrible <drailanjohn.gss@gmail.com>
 */
class LandingController extends AppController
{

    /**
     * beforeFilter
     *
     * @param \Cake\Event\Event $event An Event instance
     * @return \Cake\Http\Response|null proceed action when returns void|null
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }

    /**
     * Index Method
     *
     * Displays the Landing Controller
     */
    public function index()
    {

        $getUser = NULL;
        if($this->loginUser) {
            $getUser = $this->loginUser;
        } else {
            $getUser = NULL;
        }

        $this->set(compact('getUser'));
    }

    public function restricted() {

    }

}
