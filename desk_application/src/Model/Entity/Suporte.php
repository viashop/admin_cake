<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Admin Entity
 *
 * @property int $id
 * @property int $id_shop_default
 * @property int $id_cliente_default
 * @property int $id_prioridade_default
 * @property int $id_departamento_default
 * @property int $id_status_departamento_default
 * @property int $id_status_cliente_default
 * @property string $leitura_departamento
 * @property string $leitura_cliente
 * @property string $ultima_acao
 * @property string $hash
 * @property string $ip
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Admin extends Entity
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
        '*' => true,
        'id' => false
    ];
}
