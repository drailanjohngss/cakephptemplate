<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
/**
 * User Entity
 *
 * @package     app
 * @subpackage  Model.Entity
 * @since       2018/08/15
 * @author      Ronie Vincent Horca <ronievincent.gss@gmail.com>
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class User extends Entity
{

    /**
     * Parent node in ACL context
     *
     * @return array|null   array with 'model' and 'foreign_key'
     */
    public function parentNode()
    {
        if (!$this->id) {
            return null;
        }
        if (isset($this->group_id)) {
            $group_id = $this->group_id;
        } else {
            $users_table = TableRegistry::get('Users');
            $user = $users_table
                ->find('all', ['fields' => ['group_id']])
                ->where(['id' => $this->id])
                ->first();
            $group_id = $user->group_id;
        }
        if (!$group_id) {
            return null;
        }

        return ['Groups' => ['id' => $group_id]];
    }

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    public function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }

    protected $_accessible = [
        'username' => true,
        'password' => true,
        'email' => true,
        'group_id' => true,
        'created' => true,
        'modified' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
