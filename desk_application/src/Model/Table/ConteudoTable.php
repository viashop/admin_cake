<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Conteudo Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $ShTicket
 *
 * @method \App\Model\Entity\Conteudo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Conteudo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Conteudo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Conteudo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Conteudo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Conteudo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Conteudo findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ConteudoTable extends Table
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

        $this->table('ticket_conteudo');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

    }

    public function breadcrumb(int $id)
    {

        return $this->find()
                    ->select(['assunto'])
                    ->where(['id_ticket_default' => $id])
                    ->first();

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
            ->integer('id_ticket_default')
            ->allowEmpty('id_ticket_default');

        $validator
            ->integer('id_cliente_default')
            ->allowEmpty('id_cliente_default');

        $validator
            ->integer('id_admin_default')
            ->allowEmpty('id_admin_default');

        $validator
            ->integer('id_departamento_default')
            ->allowEmpty('id_departamento_default');

        $validator
            ->allowEmpty('assunto');

        $validator
            ->allowEmpty('mensagem');

        $validator
            ->allowEmpty('ip');

        return $validator;
    }
}
