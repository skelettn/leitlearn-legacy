<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Flashcard Entity
 *
 * @property int $id
 * @property int $packet_id
 * @property string $question
 * @property string $answer
 * @property string|null $media
 * @property int $leitner_folder
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Packet $packet
 */
class Flashcard extends Entity
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
        'packet_id' => true,
        'question' => true,
        'answer' => true,
        'media' => true,
        'leitner_folder' => true,
        'modified' => true,
        'packet' => true,
    ];
}
