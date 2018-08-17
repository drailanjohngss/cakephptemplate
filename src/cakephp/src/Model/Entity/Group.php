<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Group Entity
 *
 * @package     app
 * @subpackage  Model.Entity
 * @since       2018/08/15
 * @author      Ronie Vincent Horca <ronievincent.gss@gmail.com>
 */
class Group extends Entity
{
    /**
     * Parent node in ACL context
     *
     * @return null
     */
    public function parentNode()
    {
        return null;
    }

    protected $_accessible = [
        'description' => true,
        'created' => true,
        'name' => true,
        'modified' => true
    ];
}
