<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsuarioFixture
 *
 */
class UsuarioFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'usuario';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_shop_default' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_cliente_default' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_prioridade_default' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_departamento_default' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_status_departamento_default' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_status_cliente_default' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'leitura_departamento' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => 'False', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'leitura_cliente' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => 'False', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'ultima_acao' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => 'cliente', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'hash' => ['type' => 'string', 'length' => 40, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ip' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'sh_ticket_fk_1_idx' => ['type' => 'index', 'columns' => ['id_shop_default'], 'length' => []],
            'sh_ticket_fk_2_idx' => ['type' => 'index', 'columns' => ['id_prioridade_default'], 'length' => []],
            'sh_ticket_fk_3_idx' => ['type' => 'index', 'columns' => ['id_departamento_default'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'usuario_ibfk_1' => ['type' => 'foreign', 'columns' => ['id_shop_default'], 'references' => ['sh_shop', 'id_shop'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'usuario_ibfk_2' => ['type' => 'foreign', 'columns' => ['id_prioridade_default'], 'references' => ['sh_ticket_prioridade', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'usuario_ibfk_3' => ['type' => 'foreign', 'columns' => ['id_departamento_default'], 'references' => ['sh_ticket_departamento', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'id_shop_default' => 1,
            'id_cliente_default' => 1,
            'id_prioridade_default' => 1,
            'id_departamento_default' => 1,
            'id_status_departamento_default' => 1,
            'id_status_cliente_default' => 1,
            'leitura_departamento' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'leitura_cliente' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'ultima_acao' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'hash' => 'Lorem ipsum dolor sit amet',
            'ip' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-10-05 03:22:17',
            'modified' => 1475637737
        ],
    ];
}
