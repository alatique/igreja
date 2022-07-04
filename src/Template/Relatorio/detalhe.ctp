<?php

$nomePagina = "NoMatch Juegos";

$sheet = $objPHPExcel->getActiveSheet();
$sheet->setTitle($nomePagina);
$sheet->getPageSetup()
    ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$sheet->getPageSetup()
    ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);

$sheet->getColumnDimension('A')->setWidth(41);
$sheet->getColumnDimension('B')->setWidth(29);
$sheet->getColumnDimension('C')->setWidth(25);
$sheet->getColumnDimension('D')->setWidth(22);
$sheet->getColumnDimension('E')->setWidth(25);
$sheet->getColumnDimension('F')->setWidth(29);
$sheet->getColumnDimension('G')->setWidth(26);
$sheet->getColumnDimension('H')->setWidth(26);
$sheet->getColumnDimension('I')->setWidth(26);

$l = 1;
$l_final = 0;

$l_inicial = $l;
$sheet->setCellValue("A{$l}", "#FECHA-PARTIDO-FORMATO-DD/MM/YYYY#");
$sheet->setCellValue("B{$l}", "#HORARIO FORMATO HH:MM#");
$sheet->setCellValue("C{$l}", "#NOMBRE EQUIPO LOCALl#");
$sheet->setCellValue("D{$l}", "#GOLS EQUIPO LOCALl#");
$sheet->setCellValue("E{$l}", "#GOLS EQUIPO VISITANTE#");
$sheet->setCellValue("F{$l}", "#NOMBRE EQUIPO VISITANTE#");
$sheet->setCellValue("G{$l}", "#NOMBRE TORNEO / LIGA #");
$sheet->setCellValue("H{$l}", "#NOMBRE ESTADIO#");
$sheet->setCellValue("I{$l}", "#NOMBRE PAIS#");
            



$l++;


foreach ($lista as $key => $value) {

   $placar = explode(":", $value['placar']);
   
   $sheet->setCellValue("A{$l}", $value['dt_date']->format('d/m/Y'));
   $sheet->setCellValue("B{$l}", '');
   $sheet->setCellValue("C{$l}", $value['team_local']);
   $sheet->setCellValue("D{$l}", $placar[0]);
   $sheet->setCellValue("E{$l}", $placar[1]);
   $sheet->setCellValue("F{$l}", $value['team_visitor']);
   $sheet->setCellValue("G{$l}", "");
   $sheet->setCellValue("H{$l}", "");
   $sheet->setCellValue("I{$l}", "");
   $l++;
   $l_final = $l;
}

$sheet->getStyle("A1:I{$l_final}")->applyFromArray($estiloCabecalho);
$sheet->getPageSetup()->setPrintArea("A1:I{$l_final}");
$sheet->getStyle("A1:I{$l_final}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle("A1:I{$l_final}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getPageSetup()->setFitToWidth(1);



//$objDrawing = new PHPExcel_Worksheet_Drawing();
//$this->Relatorio->GlobalLogotipo($objDrawing,$objPHPExcel, "N{$l}", 65);





/*
$l++;

$sheet->mergeCells("B{$l}:G{$l}");
$sheet->setCellValue("A{$l}", "Contato:");
$sheet->setCellValue("B{$l}", $dados[0]['solicitante']);

$l++;

$sheet->mergeCells("B{$l}:D{$l}");
$sheet->mergeCells("F{$l}:G{$l}");
$sheet->setCellValue("A{$l}", "Email:");
$sheet->setCellValue("B{$l}", $dados[0]['email']);
$sheet->setCellValue("E{$l}", "celular:");
$sheet->setCellValue("F{$l}", $dados[0]['celular']);


$l++;

$l_final = $l;
$sheet->mergeCells("B{$l}:D{$l}");
$sheet->setCellValue("A{$l}", "Período:");
$sheet->setCellValue("B{$l}", $dt_inicio . " - " . $dt_fim );
$sheet->getStyle("A{$l_inicial}:G{$l_final}")->applyFromArray($estiloCabecalho);

$l += 3;

$sheet->getStyle("A{$l}:I{$l}")->applyFromArray($estiloMenu);
$sheet->getStyle("A{$l}:I{$l}")->getAlignment()->setWrapText(true);


foreach (range("A{$l}", "G{$l}") as $columnId) {
   $sheet->getColumnDimension($columnId)->setWidth(12);
}

foreach (range("I{$l}", "I{$l}") as $columnId) {
  $sheet->getColumnDimension($columnId)->setWidth(11);
}

$sheet->getColumnDimension('H')->setWidth(35);



$linha_inicio_dados = $l;
$linha_final_dados = $l;
$ultimo_protocolo = null;
foreach($dados as $d):   

   if ($d['protocolo'] != $ultimo_protocolo){

      for ($letra = "A"; $letra <= "O"; $letra++) { 
         if(!in_array($letra,['D','E','F'])){
            $sheet->mergeCells(
              "{$letra}"."{$linha_inicio_dados}:{$letra}"."{$linha_final_dados}");
         }
      }
    


      $l++;
      $linha_inicio_dados = $l;
    }
    
    $sheet->setCellValue("A{$l}", $d['protocolo']);
    $sheet->setCellValue("B{$l}", $d['caminhao']);
    $sheet->setCellValue("C{$l}", $d['solicitante']);
    $sheet->setCellValue("G{$l}", $this->Global->mascaraDataString($d['data_serv'], true ) );

    $sheet->setCellValue("H{$l}", $d['local_destino']);
    $sheet->setCellValue("I{$l}", $d['taxa_atendimento']); 
    $sheet->setCellValue("J{$l}", $d['km_excedido']); 
    $sheet->setCellValue("K{$l}", $d['acesso']); 
    $sheet->setCellValue("L{$l}", $d['patins']); 
    $sheet->setCellValue("M{$l}", $d['segundo_veiculo']); 
    $sheet->setCellValue("N{$l}", $d['adicional']); 
    $sheet->setCellValue("I{$l}", $d['valor']); 
    $sheet->setCellValue("D{$l}", $d['placa_veiculo']);
    $sheet->setCellValue("E{$l}", $d['marca']);
    $sheet->setCellValue("F{$l}", $d['modelo']);

    for ($letra = "I"; $letra <="O" ; $letra++) { 
       $sheet->getStyle("{$letra}"."{$l}")->getNumberFormat()->setFormatCode('R$ * 0.00');
    }

    $linha_final_dados = $l;   
    $sheet->getStyle("A{$linha_inicio_dados}:I{$linha_final_dados}")->applyFromArray($estiloConteudo);
    $sheet->getStyle("A{$linha_inicio_dados}:I{$linha_final_dados}")->applyFromArray($bordaGrossa);  
    

    $l++; 
    
    $ultimo_protocolo = $d['protocolo'];

endforeach;

$sheet->getPageSetup()->setPrintArea("A{$l_inicial}:I{$linha_final_dados}");
$sheet->getStyle("A{$l_inicial}:I{$linha_final_dados}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$l_inicial = $l_inicial + 5;
$sheet->getStyle("A{$l_inicial}:I{$linha_final_dados}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getPageSetup()->setFitToWidth(1);
*/


