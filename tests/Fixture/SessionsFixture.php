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
                'expected_folder' => 1,
                'created' => '2024-03-25 10:43:28',
                'modified' => '2024-03-25 10:43:28',
            ],
        ];
        parent::init();
    }
}
