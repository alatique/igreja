<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Arrecadacao Model
 *
 * @property \App\Model\Table\DizimoTable&\Cake\ORM\Association\HasMany $Dizimo
 *
 * @method \App\Model\Entity\Arrecadacao get($primaryKey, $options = [])
 * @method \App\Model\Entity\Arrecadacao newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Arrecadacao[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Arrecadacao|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Arrecadacao saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Arrecadacao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Arrecadacao[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Arrecadacao findOrCreate($search, callable $callback = null, $options = [])
 */
class ArrecadacaoTable extends Table
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

        $this->setTable('arrecadacao');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Dizimo', [
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
            ->date('dt_cadastro')
            ->allowEmptyDate('dt_cadastro');

        $validator
            ->decimal('total_dizimo')
            ->allowEmptyString('total_dizimo');

        $validator
            ->decimal('total_oferta')
            ->allowEmptyString('total_oferta');

        $validator
            ->decimal('total_arrecadado')
            ->allowEmptyString('total_arrecadado');

        $validator
            ->integer('id_igreja')
            ->requirePresence('id_igreja', 'create')
            ->notEmptyString('id_igreja');

        return $validator;
    }

    public function finalizaArrecadacao($data){

        $objArrecadacao = $this->find()
                               ->where(['id' => $data['id']])
                               ->first();

        $objArrecadacao->total_dizimo = $data['vl_dizimos'];
        $objArrecadacao->total_oferta = $data['vl_ofertas'];
        $objArrecadacao->total_arrecadado = $data['vl_total'];
        $objArrecadacao->sta_edicao = 'N';

        if ($this->save($objArrecadacao)) {
            return true;
        }

        return false;

    }

    public function listaDizimosUmaArrecadacao($arrecadacao_id){

    
        $resultado = [];
        $arrecadacao_id = intval($arrecadacao_id);
        

        $tbDizimo = TableRegistry::get('Dizimo');
        $resultado['dizimo'] = $tbDizimo->find()
                                        ->where(['arrecadacao_id' => $arrecadacao_id]);

    

        $arrecadacao = $this->find()
                            ->where(['id' => $arrecadacao_id])
                            ->first();

        $resultado['sta_edicao'] = $arrecadacao->sta_edicao;




        $tbLista = TableRegistry::get('Lista');
        $resultado['usuarios'] = $tbLista->listaUsuarios();

        return $resultado;

    }

    public function carregarArrecadacao($arrecadacao_id){

        $resultado = [];
        $arrecadacao_id = intval($arrecadacao_id);

        $tbDizimo = TableRegistry::get('Dizimo');
        $resultado['arrecadacao'] = $this->find()
                                         ->where(['id' => $arrecadacao_id])
                                         ->first();

        $resultado['disable'] = false;
        if ($resultado['arrecadacao']->sta_edicao == 'N') {
            $resultado['disable'] = true;
        }

   
        $resultado['dizimo'] = $tbDizimo->newEntity();


        $tbLista = TableRegistry::get('Lista');
        $resultado['diaconos'] = $tbLista->listaDiaconos();
        $resultado['igrejas'] = $tbLista->listaIgrejas();
        $resultado['usuarios'] = $tbLista->listaUsuarios();

        return $resultado;

    }
}
