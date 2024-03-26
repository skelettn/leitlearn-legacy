<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SocialProfilesFixture
 */
class SocialProfilesFixture extends TestFixture
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
                'user_id' => 1,
                'provider' => 'Lorem ipsum dolor sit amet',
                'access_token' => 'Lorem ipsum dolor sit amet',
                'identifier' => 'Lorem ipsum dolor sit amet',
                'username' => 'Lorem ipsum dolor sit amet',
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'full_name' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'birth_date' => '2024-03-23',
                'gender' => 'Lorem ipsum dolor sit amet',
                'picture_url' => 'Lorem ipsum dolor sit amet',
                'email_verified' => 1,
                'created' => '2024-03-23 16:40:56',
                'modified' => '2024-03-23 16:40:56',
            ],
        ];
        parent::init();
    }
}
