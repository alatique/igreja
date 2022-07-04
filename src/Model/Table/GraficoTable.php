<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Grafico Model
 *
 * @property \App\Model\Table\DizimoTable&\Cake\ORM\Association\HasMany $Dizimo
 *
 * @method \App\Model\Entity\Grafico get($primaryKey, $options = [])
 * @method \App\Model\Entity\Grafico newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Grafico[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Grafico|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Grafico saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Grafico patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Grafico[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Grafico findOrCreate($search, callable $callback = null, $options = [])
 */
class GraficoTable extends Table
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

    public function listaDizimosOfertasAnoAtual(){

    	$query = "SELECT 
			    		 DATE_FORMAT(dt_cadastro, '%m') as month
			    	    ,SUM(total_dizimo) as dizimos
    					,SUM(total_oferta) as ofertas
			    	FROM
			    		arrecadacao
			    	WHERE
			    		DATE_FORMAT(dt_cadastro, '%Y') = DATE_FORMAT(curdate(), '%Y')
			    	GROUP BY
			    		month(dt_cadastro);";

		$conn = ConnectionManager::get('default');
        $stmt = $conn->execute($query);
        $dados = $stmt->fetchAll('assoc');

        $barra['dizimos'] = [];
        $barra['ofertas'] = [];

        for ($i=1; $i <= 12 ; $i++) { 


        	$verificador = 0;

        	foreach($dados as $d){	

        		if ($d['month'] == $i) {
	        		$barra['dizimos'][] = round($d['dizimos'], 0);
	        		$barra['ofertas'][] = round($d['ofertas'], 0);        	
	        		$verificador = 1;
	        	}
				
        	}

        	if ($verificador == 0) {
        		$barra['dizimos'][] = 0;
	        	$barra['ofertas'][] = 0;        	
        	}
        	
        }


        return $barra;


    }


    public function fidelidadeAnoPorcentagem(){

        /*
        métrica: 
            1. pega quantos membros deram dízimo por mês e soma até o mês atual;
            2. para pegar a média por mês, divide o resultado acima pelo mês atual (qtd meses já vividos no ano);
            3. pega esta média de membros dizimistas e divide pelo total de membros da igreja calculando a porcentagem.
        */

        $mes_atual = date("Ym");
        $mes_inicial = date("Y") . '01';
        $membros_dizimistas = 0;

        for ($i=$mes_inicial; $i <= $mes_atual; $i++) { 
            $query = "SELECT
                            count(distinct(user_id)) as dizimistas
                        from
                            dizimo
                        where
                            date_format(dt_dizimo, '%Y%m') = '{$mes_inicial}';";

            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute($query);
            $dados = $stmt->fetchAll('assoc');
            

            $membros_dizimistas += $dados[0]['dizimistas'];
            $mes_inicial++;
        }


        $tbUsuario = TableRegistry::get('Users');
        $query = $tbUsuario->find();
        $total_membros = $query->select(['count' => $query->func()->count('*')])->first();


        $fieis = ($membros_dizimistas / date('m') * 100) / $total_membros['count'];
        $retorno['fieis'] = $fieis;
        $retorno['infieis'] = 100 - $fieis;


        return $retorno;


    }

    
}
