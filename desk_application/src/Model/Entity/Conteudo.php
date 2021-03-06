<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Conteudo Entity
 *
 * @property int $id
 * @property int $id_ticket_default
 * @property int $id_cliente_default
 * @property int $id_admin_default
 * @property int $id_departamento_default
 * @property string $assunto
 * @property string $mensagem
 * @property string $ip
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\ShTicket[] $sh_ticket
 */
class Conteudo extends Entity
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
