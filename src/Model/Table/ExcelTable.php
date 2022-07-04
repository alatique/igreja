<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Cake\Http\Exception\NotFoundException;

/**
 * Excel Model
 *
 * @property \App\Model\Table\DizimoTable&\Cake\ORM\Association\HasMany $Dizimo
 *
 * @method \App\Model\Entity\Excel get($primaryKey, $options = [])
 * @method \App\Model\Entity\Excel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Excel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Excel|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Excel saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Excel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Excel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Excel findOrCreate($search, callable $callback = null, $options = [])
 */
class ExcelTable extends Table
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

    public function criaArquivo(){

    	//Esta função cria um excel na raiz de webroot
    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Hello World !');

		$writer = new Xlsx($spreadsheet);
		$writer->save('hello world.xlsx');

        /*
        //tirei esta função do userscontroller. Quando quiser usar, criar novamente
        public function testeExcel(){
            $this->loadModel('Excel');
            $this->Excel->criaArquivo();
            die();
        }
        */

    }

    private function moveTempFileToFolder($file){

        $temp_file = $file['upload-users']['tmp_name'];
        $project_name = 'usuarios-excel';
        $file_name = date('Ymd.His')."-".$file['upload-users']['name'];
        $raiz = realpath(__DIR__."/../../..");

        


        if (!is_dir($raiz."/webroot/uploads/".$project_name)) {
            mkdir($raiz."/webroot/uploads/".$project_name);
        }

        $caminho = $raiz."/webroot/uploads/".$project_name."/".$file_name;
        
        move_uploaded_file($temp_file, $caminho);
        

        return $caminho;
        
    }


    public function importExcelFile($file){

        $caminho = $this->moveTempFileToFolder($file);

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $planilha = $reader->load($caminho);
        $arquivo = $planilha->getActiveSheet();

        $dados = $this->scanExcel($arquivo);

        
        return $dados;

    }


    private function scanExcel($arquivo){

        $ultima_linha = $arquivo->getHighestRow();
        $total_dados = [];

        for ($linha=2; $linha <= $ultima_linha; $linha++) { 
            $total_dados[] = 
                ['name' => $this->excelValuesValidator($arquivo->getCell('A'.$linha)->getValue(), 'letters', 'A'.$linha)
                ,'birth' => $this->excelValuesValidator($arquivo->getCell('B'.$linha)->getValue(), 'date', 'B'.$linha)
                ,'address' => $arquivo->getCell('C'.$linha)->getValue()
                ,'district' => $this->excelValuesValidator($arquivo->getCell('D'.$linha)->getValue(), 'letters', 'D'.$linha)
                ,'city' => $this->excelValuesValidator($arquivo->getCell('E'.$linha)->getValue(), 'letters', 'E'.$linha)
                ,'zip' => $this->excelValuesValidator($arquivo->getCell('F'.$linha)->getValue(), 'numbers', 'F'.$linha)
                ,'state' => $arquivo->getCell('G'.$linha)->getValue()
                ,'country' => $this->excelValuesValidator($arquivo->getCell('H'.$linha)->getValue(), 'letters', 'H'.$linha)
                ,'tel' => $this->excelValuesValidator($arquivo->getCell('I'.$linha)->getValue(), 'tel', 'I'.$linha)
                ,'cel' => $this->excelValuesValidator($arquivo->getCell('J'.$linha)->getValue(), 'tel', 'J'.$linha)
                ,'email' => $this->excelValuesValidator($arquivo->getCell('K'.$linha)->getValue(), 'email', 'K'.$linha)
                ,'type' => $this->excelValuesValidator($arquivo->getCell('L'.$linha)->getValue(), 'tipo', 'L'.$linha)
                ,'sta_ativo' => $this->excelValuesValidator($arquivo->getCell('M'.$linha)->getValue(), 'sta', 'M'.$linha)
                ,'username' => $this->excelValuesValidator($arquivo->getCell('K'.$linha)->getValue(), 'email', 'K'.$linha)
                ,'password' => ''
                ,'id_igreja' => 1
                ,'membro_arrolado' => $this->excelValuesValidator($arquivo->getCell('N'.$linha)->getValue(), 'sta', 'N'.$linha)
                ,'dt_cadastro' => date('Y-m-d')
                ];
                
        }

        

        return $total_dados;
        

    }

    public function excelValuesValidator($value, $index, $celula){

        
        if ($value != '') {
            if ($index == 'date') {

                //spreadsheet traz data no formato de número
                if (filter_var($value, FILTER_VALIDATE_INT)) {
                    $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
                    $value = $date->format('Y-m-d');
                } else {
                    throw new NotFoundException(__("O registro {$value} na posição {$celula} não foi reconhecido como um formato de data válido. Ele deve ser DD/MM/AAAA"));
                }
                
    
            

            } elseif ($index == 'letters') {
                if (!filter_var($value)) {
                    throw new NotFoundException(__("o valor {$value} na posição {$celula} é inválido. Necessário conter apenas letras"));
                }
           


            } elseif ($index == 'numbers') {
                if (!filter_var($value, FILTER_VALIDATE_INT)) {
                    throw new NotFoundException(__("o tel/cel {$value} na posição {$celula} é inválido. Necessário conter apenas números"));
                }
           


            } elseif ($index == 'tel') {
                
                $value = str_replace(['.', '/', ':', '-', '(', ')', ' '], '', $value); 
                
                if (strlen($value) <= 9) {
                    $value = '11'.$value;
                }
                
                if (!filter_var($value, FILTER_VALIDATE_INT)) {
                    throw new NotFoundException(__("o tel/cel {$value} na posição {$celula} é inválido. Necessário conter apenas números"));
                }
                



            } elseif ($index == 'email') {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    throw new NotFoundException(__("email {$value} na posição {$celula} inválido"));
                }



            } elseif ($index == 'sta') {

                if ($value == 'Sim') {
                    $value = 1;
                } else {
                    $value = 0;
                }             

            

            } elseif ($index == 'tipo') {
                
                if ($value == 'secretaria') {
                    $value = 'SC';
                } elseif ($value == 'tesoureiro') {
                    $value = 'TS';
                } elseif ($value == 'diacono') {
                    $value = 'DC';
                } elseif ($value == 'presbitero') {
                    $value = 'PB';
                } elseif ($value == 'pastor') {
                    $value = 'PR';
                } else {
                    $value = 'MB';
                }
                
            }

        }        
        
        

        return $value;

    }

    


    	
}
