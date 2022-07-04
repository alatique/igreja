<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Users Model
 *
 * @method \App\Model\Entity\Users get($primaryKey, $options = [])
 * @method \App\Model\Entity\Users newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Users[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Users|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Users saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Users patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Users[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Users findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->date('birth')
            ->allowEmptyDate('birth');

        $validator
            ->scalar('address')
            ->maxLength('address', 150)
            ->allowEmptyString('address');

        $validator
            ->scalar('district')
            ->maxLength('district', 50)
            ->allowEmptyString('district');

        $validator
            ->scalar('city')
            ->maxLength('city', 20)
            ->allowEmptyString('city');

        $validator
            ->scalar('zip')
            ->maxLength('zip', 8)
            ->allowEmptyString('zip');

        $validator
            ->scalar('state')
            ->maxLength('state', 20)
            ->allowEmptyString('state');

        $validator
            ->scalar('country')
            ->maxLength('country', 30)
            ->allowEmptyString('country');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 20)
            ->allowEmptyString('tel');

        $validator
            ->scalar('cel')
            ->maxLength('cel', 20)
            ->allowEmptyString('cel');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('type')
            ->maxLength('type', 5)
            ->allowEmptyString('type');

        $validator
            ->scalar('sta_ativo')
            ->maxLength('sta_ativo', 1)
            ->allowEmptyString('sta_ativo');

        $validator
            ->scalar('username')
            ->maxLength('username', 50)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->integer('id_igreja')
            ->requirePresence('id_igreja', 'create')
            ->notEmptyString('id_igreja');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['username']));

        return $rules;
    }

    public function saveUsers($dados){


        $oQuery = $this->query();
        $conn = ConnectionManager::get('default');
        $conn->logQueries(false);

        foreach ($dados as $d) {
            $oQuery->insert(['name'
                        ,'birth'
                        ,'address'
                        ,'district'
                        ,'city'
                        ,'zip'
                        ,'state'
                        ,'country'
                        ,'tel'
                        ,'cel'
                        ,'email'
                        ,'type'
                        ,'sta_ativo'
                        ,'username'
                        ,'password'
                        ,'id_igreja'
                        ,'membro_arrolado'
                        ,'dt_cadastro'])
                ->values($d);
        }

        
        $oQuery->execute();

        return true;

    }
}
