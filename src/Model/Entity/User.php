<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher; // Add this line

/**
 * User Entity
 *
 * @property int $id
 * @property string $nama
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $alamat
 *
 * @property \App\Model\Entity\Album[] $albums
 * @property \App\Model\Entity\Likephoto[] $likephotos
 * @property \App\Model\Entity\Photocomment[] $photocomments
 * @property \App\Model\Entity\Photo[] $photos
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
        'nama' => true,
        'username' => true,
        'password' => true,
        'email' => true,
        'alamat' => true,
        'albums' => true,
        'likephotos' => true,
        'photocomments' => true,
        'photos' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
    ];
    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}
