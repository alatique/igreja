<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dizimo Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Users
 * @property &\Cake\ORM\Association\BelongsTo $Arrecadacao
 *
 * @method \App\Model\Entity\Dizimo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Dizimo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Dizimo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Dizimo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dizimo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dizimo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Dizimo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Dizimo findOrCreate($search, callable $callback = null, $options = [])
 */
class DizimoTable extends Table
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

        $this->setTable('dizimo');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Arrecadacao', [
            'foreignKey' => 'arrecadacao_id',
        ]);
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
            ->decimal('vl_dizimo')
            ->allowEmptyString('vl_dizimo');

        $validator
            ->decimal('vl_oferta')
            ->allowEmptyString('vl_oferta');

        $validator
            ->date('dt_dizimo')
            ->allowEmptyDate('dt_dizimo');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['arrecadacao_id'], 'Arrecadacao'));

        return $rules;
    }

    public function inserirDizimo($request){
        

        $dizimo = $this->newEntity();

        $dizimo->vl_dizimo = $request['dizimo'];
        $dizimo->vl_oferta = $request['oferta'];
        $dizimo->user_id = $request['user_id'];
        $dizimo->dt_dizimo = $request['data'];
        $dizimo->arrecadacao_id = $request['arrecadacao_id'];
            
        $this->save($dizimo);
        return true;

    }


    public function excluirDizimo($id){

        $dizimo = $this->get($id);
        $this->delete($dizimo);
        return true;

    }

}
