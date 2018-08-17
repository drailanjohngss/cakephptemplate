<?php
namespace App\Shell;

use Acl\Controller\Component\AclComponent;
use Acl\Shell\AclExtrasShell;
use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;

/**
 * Update ACL
 *
 * @package     app
 * @subpackage  Shell
 * @since       2018/08/16
 * @author      TERRIBLE Drailan John <drailanjohn.gss@gmail.com>

 */
class UpdateAclShell extends Shell
{
    /**
     * load AclGroup config
     *
     * @var    array    $aclConfig
     */
    private $aclConfig = [];

    /**
     * startup
     *
     * @return void
     */
    public function startup()
    {
        $this->loadModel('Groups');
        // load AclComponent
        $collection = new ComponentRegistry();
        $this->Acl = new AclComponent($collection);
        // load ACL config
        $this->aclConfig = Configure::read(APP_CONFIG.'.Acl');
        parent::startup();
    }

    /**
     * main (show help)
     *
     * @return void
     */
    public function main()
    {
        $this->help();
    }

    /**
     * show help
     *
     * @return void
     */
    public function help()
    {
        $this->out(
            <<<EOD
Usage: cake UpdateAcl [<command>]
---------------------------------------------------------------
Arguments:
  [command]
    'aco' Update acos (Controllers/Actions).
    'aro' Update aros (Groups).
    'acl' Update acos_aros.
    'all' Update all acl tables.
    'help' Show this message.
EOD
        );
        $this->_stop();
    }

    /**
     * Update acos
     *
     * @return void
     */
    public function aco()
    {
        // Update Aco
        $this->out("Update Aco");
        $aclExShell = new AclExtrasShell();
        $aclExShell->startup();
        $aclExShell->acoSync();
    }

    /**
     * Update aros
     *
     * @return void
     */
    public function aro()
    {
        // Update Group and Aro
        $this->out("Update Group and Aro");
        foreach ($this->aclConfig as $groupId => $group) {
            $this->saveGroupAndAro($groupId, $group);
        }
        $this->hr();
    }

    /**
     * Update acos_aros
     *
     * @return void
     */
    public function acl()
    {
        // Add Allowed ARO_ACO
        foreach ($this->aclConfig as $groupId => $group) {
            $this->out('Add allowed ARO_ACO: '.$group['name']);
            $this->allow4Group($groupId, $group['allow']);
            $this->hr();
        }
        // Add Denied ARO_ACO
        foreach ($this->aclConfig as $groupId => $group) {
            $this->out('Add denied ARO_ACO: '.$group['name']);
            $this->deny4Group($groupId, $group['deny']);
            $this->hr();
        }
    }

    /**
     * Update whole acl tables
     *
     * @return void
     */
    public function all()
    {
        $this->aco();
        $this->aro();
        $this->acl();
    }

    /**
     * Allow Group to access some Controller/Action.
     * WhiteList ACL (Deny whole controller first,
     * then allow defined actions)
     *
     * @param  int  $groupId
     * @param  array    $controllerActions
     * @return void
     */
    private function allow4Group($groupId, $controllerActions)
    {
        $group = $this->Groups->findById($groupId)->first();
        foreach ($controllerActions as $controller => $actions) {
            // Deny whole controller
            $this->out("-> DENY Controller/$controller");
            $this->Acl->deny($group, "$controller");

            // Allow defined actions
            foreach ($actions as $action) {
                $this->out(" -> ALLOW Controller/$controller/$action");
                $this->Acl->allow($group, "$controller/$action");
            }
        }
    }

    /**
     * Deny Group to access some Controller/Action.
     *
     * @param  int  $groupId
     * @param  array    $controllerActions
     * @return void
     */
    private function deny4Group($groupId, $controllerActions)
    {
        $this->Groups->id = $groupId;
        foreach ($controllerActions as $controller => $actions) {
            foreach ($actions as $action) {
                $this->out(" -> DENY Controller/$controller/$action");
                $this->Acl->deny($this->Group, "$controller/$action");
            }
        }
    }

    /**
     * saveGroupAndAro
     *
     * @param  int  $groupId
     * @param  array    $group
     * @return void
     */
    private function saveGroupAndAro($groupId, $group)
    {
        $this->out('-> '.$group['name']);

        $group = $this->Groups->newEntity([
            'id' => $groupId,
            'name' => $group['name'],
            'description' => $group['description'],
        ]);
        $this->Groups->save($group);
/*
        $aro = $this->Aros->newEntity([
            'model' => 'Group',
            'foreign_key' => $groupId,
        ]);
        $result = $this->Aros->save($aro);
*/
    }
}
