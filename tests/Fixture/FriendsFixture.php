<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FriendsFixture
 */
class FriendsFixture extends TestFixture
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
                'requester_id' => 1,
                'recipient_id' => 1,
                'status' => 'Lorem ipsum dolor ',
                'created' => '2024-03-23 16:40:49',
                'modified' => '2024-03-23 16:40:49',
            ],
        ];
        parent::init();
    }
}
