<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StatusCliente Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $ShTicket
 *
 * @method \App\Model\Entity\StatusCliente get($primaryKey, $options = [])
 * @method \App\Model\Entity\StatusCliente newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StatusCliente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StatusCliente|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StatusCliente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StatusCliente[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StatusCliente findOrCreate($search, callable $callback = null)
 */
class StatusClienteTable extends Table
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

        $this->table('ticket_status_cliente');
        $this->displayField('id');
        $this->primaryKey('id');

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
            ->allowEmpty('status');

        return $validator;
    }
}
