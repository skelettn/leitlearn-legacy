<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SessionsFixture
 */
class SessionsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'session_uid' => 'Lorem ipsum dolor sit amet',
                'packet_id' => 1,
                'created' => '2024-03-19 18:44:17',
                'modified' => '2024-03-19 18:44:17',
            ],
        ];
        parent::init();
    }
}
