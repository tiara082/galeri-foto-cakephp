<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Photo Entity
 *
 * @property int $id
 * @property string $nama
 * @property string $deskripsi
 * @property \Cake\I18n\Date $created
 * @property string $foto
 * @property int $album_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\Album $album
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Likephoto[] $likephotos
 * @property \App\Model\Entity\Photocomment[] $photocomments
 */
class Photo extends Entity
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
        'nama' => true,
        'deskripsi' => true,
        'created' => true,
        'foto' => true,
        'album_id' => true,
        'user_id' => true,
        'album' => true,
        'user' => true,
        'likephotos' => true,
        'photocomments' => true,
    ];
}
