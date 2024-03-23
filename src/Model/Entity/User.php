<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $user_uid
 * @property string $last_name
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string|null $birth
 * @property string|null $gender
 * @property string|null $profile_picture
 * @property bool $permission
 *
 * @property \App\Model\Entity\Packet[] $packets
 * @property \App\Model\Entity\Friend[] $friends
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_uid' => true,
        'last_name' => true,
        'name' => true,
        'username' => true,
        'email' => true,
        'password' => true,
        'birth' => true,
        'gender' => true,
        'profile_picture' => true,
        'permission' => true,
        'packets' => true,
        'friends' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected array $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }
}
