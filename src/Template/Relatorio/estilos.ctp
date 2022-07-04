<?php


// Estilos CSS
$bordaGrossa = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
            'color' => array('argb' => 'FF000000'),
        ),
        'inside' => array(
            'style' => PHPExcel_Style_Border::BORDER_DOTTED,
            'color' => array('argb' => 'FF000000'),
        ),
    ),
);

$estiloConteudo = array(
     'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '404040'),
        'size'  => 10,
        'name'  => 'Calibri'
    )
);

$estiloMenu = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '000000'),
        'size'  => 10,
        'name'  => 'Calibri'
    ),
    'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FED700')
    ),
    'alignment' => array(
       'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
       'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
   ), 
);

$estiloCabecalho = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '404040'),
        'size'  => 11,
        'name'  => 'Calibri'
    ),
);