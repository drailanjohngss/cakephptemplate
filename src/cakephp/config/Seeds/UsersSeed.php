<?php
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     *
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    const ADMIN = 1;
    const USER = 2;
    public function run()
    {
        $data = [
            [
                'username' => 'foo',
                'email' => 'foo@email.com',
                'password' => 'test123',
                'group_id' => self::ADMIN,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'bar',
                'email' => 'bar@email.com',
                'password' => 'test123',
                'group_id' => self::USER,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ]
        ];

        $table = $this->table('users');
        $table->truncate();
        $table->insert($data)->save();
    }
}
