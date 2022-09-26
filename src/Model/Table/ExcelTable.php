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
use Cake\Datasource\ConnectionManager;
use Cake\Core\Configure;

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

    public function relatorioFidelidadeAnoAtual(){


        $user = Configure::read('Request.user_obj');
        
    	//Esta função cria um excel na raiz de webroot
    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
        //PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

        $dados = $this->fidelidadeMembrosAnoAtual();

        $letras = [];
        $index = 1;
        for ($i='A'; $i <= 'Z' ; $i++) { 
            $letras[$index] = $i;
            $index++;
        }

        
        $sheet->getColumnDimension('A')->setWidth('11');
        $sheet->getColumnDimension('B')->setWidth('45');
        $sheet->getColumnDimension('C')->setWidth('13');
        $sheet->getColumnDimension('D')->setWidth('13');
        $sheet->getStyle("A1:Z200")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFFFF');


        $sheet->setCellValue("A1", "Título:");
        $sheet->setCellValue("A2", "Data:");
        $sheet->setCellValue("A3", "Gerado por:");
        $sheet->setCellValue("B1", "Relatório de dízimos e ofertas mensais por membro");
        $sheet->setCellValue("B2", date('d/m/Y'));
        $sheet->setCellValue("B3", $user['name']);


        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setPath('img/IPM-logo.png'); 
        $drawing->setCoordinates('D1');
        $drawing->setHeight(50);
        $drawing->setWidth(50);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        $sheet->setCellValue("A6", "MÊS");
        $sheet->setCellValue("B6", "MEMBRO");
        $sheet->setCellValue("C6", "DÍZIMO");
        $sheet->setCellValue("D6", "OFERTA");
        $sheet->getStyle("A6:D6")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle("A6:D6")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('138DB2DD');

        
        $linha = 7;
        $primeira_linha = $linha;
        $mes_anterior = '';
        $primeira_vez_mes = 0;
        $verifica = [];
        $ultima_letra = '';

        foreach ($dados as $d) {
            
            $posicao_array = 1;
            if ($mes_anterior != '' and $d[1] != $mes_anterior) {
                $linha_anterior = $linha - 1;
                $sheet->mergeCells("A".$primeira_vez_mes.":A".$linha_anterior);
                $sheet->getStyle("A".$primeira_vez_mes.":".$letras[count($d)].$linha_anterior)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $linha++;
            }
            
            for ($i='A'; $i <= $letras[count($d)]; $i++) { 
                $sheet->setCellValue($i.$linha, $d[$posicao_array]);    
                $verifica[] = $d[$posicao_array];
                $posicao_array++;

                if ($d[1] != $mes_anterior) {
                    $primeira_vez_mes = $linha;
                }
                $mes_anterior = $d[1];
            }

            $linha++;
            $ultima_letra = $letras[count($d)];
            
        }

        $linha_anterior = $linha - 1;
        $sheet->mergeCells("A".$primeira_vez_mes.":A".$linha_anterior);
        $sheet->getStyle("A".$primeira_vez_mes.":".$ultima_letra.$linha_anterior)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $spreadsheet->getActiveSheet()->getStyle("C".$primeira_linha.":D".$linha_anterior)->getNumberFormat()->setFormatCode('#.##0,0_-');
        $sheet->getStyle('A1:Z200')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $linha_rodape = $linha + 1;
        $sheet->setCellValue("A".$linha_rodape, "Documento confidencial da Igreja Presbiteriana do Morumbi");

        /*print_r($verifica);
        die();*/
        

		$writer = new Xlsx($spreadsheet);
        $fileName = 'Relatorio-fidelidade-ano-atual.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');

        

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
