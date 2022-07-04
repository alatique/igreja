<?php

// Aumentando o tempo maximo de execução para o php poder trabalhar - Padrão
ini_set('max_execution_time', 0);
// Aumentando o tamanho da memória para não estourar o timeout de memória - Padrão
ini_set("memory_limit", "24000000000000000M");


/** Error reporting */
error_reporting(E_ALL);

// Usando a biblioteca PHP Excel - Padrão
$objPHPExcel = new PHPExcel();
$sheet = $objPHPExcel->getActiveSheet();

// Não mostrar grades
$sheet->setShowGridlines(false);

// Não mostrar linhas de impressão
$sheet->setPrintGridlines(false);

// Alimenta as colunas
//$c = $this->Relatorio->alimentaColunas();

// Set properties
//$this->Relatorio->GlobalTagsExcel($objPHPExcel, "002 - Recall");

require 'estilos.ctp';
require 'detalhe.ctp';


$objPHPExcel->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=" . $nome_arquivo);
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');



exit;