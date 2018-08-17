<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

/**
 * Group Entity
 *
 * @package     app
 * @subpackage  Model.Entity
 * @since       2018/08/15
 * @author      Ronie Vincent Horca <ronievincent.gss@gmail.com>
 */
class GroupsTable extends Table
{
    /**
     * permission const
     *
     * @var int ADMIN   administrator level permission
     * @var int USER    user level permission
     */
    const ADMIN = 1;
    const USER = 2;

	/**
     * initialize
     *
     * @param  array $config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->setTable('groups');
        $this->setDisplayField('label');
        $this->setPrimaryKey('id');
        $this->addBehavior('Acl.Acl', ['type' => 'requester']);
        $this->addBehavior('Timestamp');

        $this->hasMany('Users', [
            'foreignKey' => 'group_id'
        ]);

    }
}
