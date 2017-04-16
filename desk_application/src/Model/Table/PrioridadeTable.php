<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Prioridade Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $ShTicket
 *
 * @method \App\Model\Entity\Prioridade get($primaryKey, $options = [])
 * @method \App\Model\Entity\Prioridade newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Prioridade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Prioridade|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prioridade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Prioridade[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Prioridade findOrCreate($search, callable $callback = null)
 */
class PrioridadeTable extends Table
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

        $this->table('ticket_prioridade');
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
            ->allowEmpty('prioridade');

        return $validator;
    }
}
