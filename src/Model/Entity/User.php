<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\FrozenDate|null $birth
 * @property string|null $address
 * @property string|null $district
 * @property string|null $city
 * @property string|null $zip
 * @property string|null $state
 * @property string|null $country
 * @property string|null $tel
 * @property string|null $cel
 * @property string $email
 * @property string|null $type
 * @property string|null $sta_ativo
 * @property string $username
 * @property string $password
 * @property int $id_igreja
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
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'birth' => true,
        'address' => true,
        'district' => true,
        'city' => true,
        'zip' => true,
        'state' => true,
        'country' => true,
        'tel' => true,
        'cel' => true,
        'email' => true,
        'type' => true,
        'sta_ativo' => true,
        'username' => true,
        'password' => true,
        'id_igreja' => true,
        'membro_arrolado' => true,
        'dt_cadastro' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword ($password){

        if (strlen($password) > 0){
            return (new DefaultPasswordHasher)->hash($password);
        }

    }
}
