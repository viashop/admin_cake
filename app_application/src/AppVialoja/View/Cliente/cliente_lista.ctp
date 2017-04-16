<?php 
//https://github.com/segy/PhpExcel

$this->PhpExcel->createWorksheet();

/*
$table = array(
    array('label' => __('Nome'), 'filter' => true),
    array('label' => __('Email'), 'filter' => true),
    array('label' => __('Id Cliente')),
    array('label' => __('Nome B'), 'width' => 50, 'wrap' => true),
    array('label' => __('Email B'))
);
*/

// define table cells
$table = array(
    array('label' => __('Nome')),
    array('label' => __('Email')),
    array('label' => __('Id Cliente')),
    array('label' => __('Nome B')),
    array('label' => __('Email B'))
);

// add heading with different font and bold text
$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));

// add data
foreach ($documentos as $documento) {
    $this->PhpExcel->addTableRow(array(
        $documento['Cliente']['nome'],
        $documento['Cliente']['email'],
        $documento['Cliente']['id_cliente'],
        $documento['Cliente']['nome'],
        $documento['Cliente']['email']
    ));
}

// close table and output
$this->PhpExcel->addTableFooter()
    ->output();
    //->output($filename = 'loja-arquivo-modelo-atualizar.xls', 'Excel5');


?> 