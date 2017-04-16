<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usuario Model
 *
 * @method \App\Model\Entity\Usuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Usuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Usuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Usuario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsuarioTable extends Table
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
}
