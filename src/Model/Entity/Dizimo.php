<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Dizimo Entity
 *
 * @property int $id
 * @property float|null $vl_dizimo
 * @property float|null $vl_oferta
 * @property int|null $user_id
 * @property \Cake\I18n\FrozenDate|null $dt_dizimo
 * @property int|null $arrecadacao_id
 */
class Dizimo extends Entity
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
        'vl_dizimo' => true,
        'vl_oferta' => true,
        'user_id' => true,
        'dt_dizimo' => true,
        'arrecadacao_id' => true,
    ];
}
