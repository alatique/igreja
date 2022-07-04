<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Lista Model
 *
 * @property \App\Model\Table\DizimoTable&\Cake\ORM\Association\HasMany $Dizimo
 *
 * @method \App\Model\Entity\Lista get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lista newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Lista[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lista|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lista saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lista patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lista[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lista findOrCreate($search, callable $callback = null, $options = [])
 */
class ListaTable extends Table
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
        //$this->addBehavior('Relatorio');

    }

    public function listaDiaconos(){


    	$tbUsers = TableRegistry::get('Users');
        $lista = $tbUsers->find()
                         ->where(['type' => 'DC']);

        $diaconos = [];

        foreach ($lista as $value) {
            $diaconos[$value->id] = $value->name;
        }

        return $diaconos;

    }


    public function listaIgrejas(){
    	

    	$tbIgreja = TableRegistry::get('Igreja');
        $lista = $tbIgreja->find('All');

        $igrejas = [];
        
        foreach ($lista as $value) {
            $igrejas[$value->id] = $value->name;
        }

        return $igrejas;

    }


    public function listaUsuarios(){
        

        $tbUsuario = TableRegistry::get('Users');
        $lista = $tbUsuario->find('All');

        $usuarios = [];
        
        foreach ($lista as $value) {
            $usuarios[$value->id] = $value->name;
        }

        return $usuarios;

    }
}
