<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Likephoto Entity
 *
 * @property int $id
 * @property \Cake\I18n\Date $created
 * @property int $user_id
 * @property int $photo_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Photo $photo
 */
class Likephoto extends Entity
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
        'created' => true,
        'user_id' => true,
        'photo_id' => true,
        'user' => true,
        'photo' => true,
    ];
}
