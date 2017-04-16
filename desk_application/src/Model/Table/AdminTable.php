<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Admin Model
 *
 * @method \App\Model\Entity\Admin get($primaryKey, $options = [])
 * @method \App\Model\Entity\Admin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Admin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Admin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Admin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Admin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Admin findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AdminTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('ticket');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('id_shop_default')
            ->allowEmpty('id_shop_default');

        $validator
            ->integer('id_cliente_default')
            ->allowEmpty('id_cliente_default');

        $validator
            ->integer('id_prioridade_default')
            ->allowEmpty('id_prioridade_default');

        $validator
            ->integer('id_departamento_default')
            ->allowEmpty('id_departamento_default');

        $validator
            ->integer('id_status_departamento_default')
            ->allowEmpty('id_status_departamento_default');

        $validator
            ->integer('id_status_cliente_default')
            ->allowEmpty('id_status_cliente_default');

        $validator
            ->allowEmpty('leitura_departamento');

        $validator
            ->allowEmpty('leitura_cliente');

        $validator
            ->allowEmpty('ultima_acao');

        $validator
            ->allowEmpty('hash');

        $validator
            ->allowEmpty('ip');

        return $validator;
    }


    /**
     * Join de Filtro de tickets
     * @param  int|integer $status
     * @return array
     */
    public function joinSQL(int $status=3)
    {

        if ($status === 3) {
            $this->arrayStatus = ['Admin.id_status_departamento_default <= 3'];
        } elseif ($status === 4) {
            $this->arrayStatus = ['Admin.id_status_departamento_default = 4'];
        }

        $query = $this->find('all')
        ->select([
            'Admin.id',
            'Admin.acao_datetime',
            'Conteudo.assunto',
            'Status.id',
            'Status.status',
            'Departamento.departamento',
            'Prioridade.prioridade',
            'Prioridade.id'
        ])
        ->where($this->arrayStatus)
        ->order(['Admin.id_prioridade_default' => 'DESC', 'Admin.acao_datetime' => 'ASC'])

        ->join([
            'conteudo' => [
                'table' => 'ticket_conteudo',
                'alias' => 'Conteudo',
                'type' => 'INNER',
                'conditions' => ['Admin.id = Conteudo.id_ticket_default']
            ],
            'prioridade' => [
                'table' => 'ticket_prioridade',
                'alias' => 'Prioridade',
                'type' => 'LEFT',
                'conditions' => [
                    'Admin.id_prioridade_default = Prioridade.id'
                ]
            ],
            'status' => [
                'table' => 'ticket_status_departamento',
                'alias' => 'Status',
                'type' => 'LEFT',
                'conditions' => [
                    'Admin.id_status_departamento_default = Status.id'
                ]
            ],
            'dapartamento' => [
                'table' => 'ticket_departamento',
                'alias' => 'Departamento',
                'type' => 'LEFT',
                'conditions' => [
                    'Admin.id_departamento_default = Departamento.id'
                ]
            ]

        ]);

        return $query;
    }

}
