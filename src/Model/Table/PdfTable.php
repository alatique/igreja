<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Http\Exception\NotFoundException;
use Cake\Datasource\ConnectionManager;
use Cake\Core\Configure;
use Cake\View\View;


/*Configure::write('CakePdf', [
    'engine' => 'CakePdf.Mpdf',
    'margin' => [
        'bottom' => 15,
        'left' => 50,
        'right' => 30,
        'top' => 45
    ],
    'orientation' => 'portrait',
    'download' => true
]);*/

/**
 * Pdf Model
 *
 * @property \App\Model\Table\DizimoTable&\Cake\ORM\Association\HasMany $Dizimo
 *
 * @method \App\Model\Entity\Pdf get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pdf newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pdf[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pdf|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pdf saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pdf patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pdf[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pdf findOrCreate($search, callable $callback = null, $options = [])
 */
class PdfTable extends Table
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
        //$this->addBehavior('Param');

    }

    public function relatorioFidelidadeAnoAtual(){
        

        ini_set('max_execution_time', 300);

        $user = Configure::read('Request.user_obj');
        $dados = $this->fidelidadeMembrosAnoAtual();
        $repeticao_meses = $this->verificaLinhasPorMes($dados);


        require_once(ROOT . DS . 'vendor' . DS . 'autoload.php');
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        //$ocDebito = $this->OcDebito->getPdfOcDebito($id);

        $view = new View();
        $view->set('dados', $dados);
        $view->set('user', $user);
        $view->set('repeticao_meses', $repeticao_meses);
       

        $htmlViewPage1 = $view->render('Relatorio/gerar-pdf-fidelidade-ano-atual',false);

        $encode = 'utf-8';
        $pageSize = 'A4';
        $marginLeft = 7;
        $marginRight = 7;
        $marginTop = 12; 
        $marginBottom = 7;

        $mpdf = new \Mpdf\Mpdf([$encode,$pageSize,'','',$marginLeft,$marginRight,$marginTop,$marginBottom]);

        // define um cabeçalho

        /*$stylesheet = file_get_contents(ROOT . DS . 'webroot' . DS . 'css' .DS.'pdf.css');
        $mpdf->WriteHTML($stylesheet,1);*/

        // adiciona uma marca d'agua
        //$mpdf->SetWatermarkImage(ROOT . DS . 'webroot' . DS . 'img' .DS. 'pdf'.DS.'receita_federal_logo.gif');
        //$mpdf->showWatermarkImage = true;

        //$mpdf->AddPage();
        $mpdf->WriteHTML($htmlViewPage1);
        
        $mpdf->showWatermarkImage = false;
        $mpdf->showImageErrors = true; // caso queira visualar algum erro

        //exibe na tela
        //$mpdf->Output('Relatorio-fidelidade-ano-atual.pdf', 'I');
        //faz o download
        $mpdf->Output('Relatorio-fidelidade-ano-atual.pdf', 'D');
    
        exit;

        

    }


    private function fidelidadeMembrosAnoAtual(){


        $ano_atual = date('Y');
        $query = "SELECT
                         date_format(Arrecadacao.dt_cadastro, '%M') as '1'
                        ,Users.name as '2'
                        ,sum(Dizimo.vl_dizimo) as '3'
                        ,sum(Dizimo.vl_oferta) as '4'
                    from
                        users Users
                        ,dizimo Dizimo
                        ,arrecadacao Arrecadacao
                    where
                            Dizimo.user_id = Users.id
                        and Arrecadacao.id = Dizimo.arrecadacao_id
                        and date_format(Arrecadacao.dt_cadastro, '%Y') = '{$ano_atual}'
                    group by
                        date_format(Arrecadacao.dt_cadastro, '%Y%m')
                        ,Users.name;";

        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute($query);
        $dados = $stmt->fetchAll('assoc');

        return $dados;

    }


    public function verificaLinhasPorMes($dados){

        $linhas_por_mes = [];
        $mes_anterior = '';
        $contador_meses = 0;
        foreach ($dados as $key => $dado) {
            if ($mes_anterior != $dado[1] and $mes_anterior != '') {
                $linhas_por_mes[$mes_anterior] = $contador_meses;
                $contador_meses = 0;
            } 

            $mes_anterior = $dado[1];
            $contador_meses++;

        }

        $linhas_por_mes[$mes_anterior] = $contador_meses;


        return $linhas_por_mes;

    }

        	
}

