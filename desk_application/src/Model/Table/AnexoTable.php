<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Anexo Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $ShTicket
 *
 * @method \App\Model\Entity\Anexo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Anexo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Anexo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Anexo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Anexo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Anexo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Anexo findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AnexoTable extends Table
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

        $this->table('ticket_anexo');
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
            ->integer('id_ticket_conteudo_default')
            ->requirePresence('id_ticket_conteudo_default', 'create')
            ->notEmpty('id_ticket_conteudo_default');

        $validator
            ->requirePresence('anexo', 'create')
            ->notEmpty('anexo');

        return $validator;
    }
}
