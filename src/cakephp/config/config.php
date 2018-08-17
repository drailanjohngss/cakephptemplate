<?php
namespace App\Model\Table;

use App\Model\Table;

/**
 * Your application config key.
 *
 * ex) define('APP_CONFIG', '[ApplicationName]');
 *
 * NOTICE: You can not use CakePHP config keys bellow.
 * (debug, App, Error, Exception, Session, Security, Acl, Dispatcher, Config)
 */
define('APP_CONFIG', 'MAIN');

/**
 * Your application configs.
 *
 * The $config load to Configure object by app/Config/bootstrap.php
 * Configure::load('application'); set $config to Configure object.
 */
$config[APP_CONFIG] = [

    /**
     * ACL config
     * Define group and its acls
     *
     * allowdで定義したアクセス権限を削除したい時は、
     * deniedで明示的にアクセス権限を拒否します。
     *
     * @see Console/Command/UpdateAclShell.php
     */
    'Acl' => [
        GroupsTable::ADMIN => [
            'name' => 'Admin',
            'description' => 'Admin',
            'allow' => [
                'Users' => [
                    'index',
                    'edit',
                    'view',
                    'logout',
                ],
                'Landing' => [
                    'restricted',
                ]
            ],
            'deny' => [
            ],
        ],
        GroupsTable::USER => [
            'name' => 'User',
            'description' => 'User',
            'allow' => [
                'Users' => [
                    'logout',
                ],
                'Landing' => [
                    'index',
                    'restricted'
                ],
            ],
            'deny' => [
            ],
        ],
    ]
];
return $config;
