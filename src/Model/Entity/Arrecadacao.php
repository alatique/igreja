<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Arrecadacao Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate|null $dt_cadastro
 * @property float|null $total_dizimo
 * @property float|null $total_oferta
 * @property float|null $total_arrecadado
 * @property int $id_igreja
 *
 * @property \App\Model\Entity\Dizimo[] $dizimo
 */
class Arrecadacao extends Entity
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
        'dt_cadastro' => true,
        'total_dizimo' => true,
        'total_oferta' => true,
        'total_arrecadado' => true,
        'id_igreja' => true,
        'diacono1_id' => true,
        'diacono2_id' => true,
        'sta_edicao' => true
    ];
}
