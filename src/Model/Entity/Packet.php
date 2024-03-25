<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Packet Entity
 *
 * @property int $id
 * @property string $packet_uid
 * @property string $name
 * @property string|null $description
 * @property \Cake\I18n\DateTime|null $created
 * @property int $importation_count
 * @property int $status
 * @property bool $ia
 * @property int $user_id
 * @property int|null $creator_id
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Flashcard[] $flashcards
 * @property \App\Model\Entity\Keyword[] $keywords
 */
class Packet extends Entity
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
        'packet_uid' => true,
        'name' => true,
        'description' => true,
        'created' => true,
        'importation_count' => true,
        'status' => true,
        'ia' => true,
        'user_id' => true,
        'creator_id' => true,
        'modified' => true,
        'user' => true,
        'flashcards' => true,
        'keywords' => true,
    ];
}
