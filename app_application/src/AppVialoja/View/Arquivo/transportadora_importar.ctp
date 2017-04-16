<?php
/*
*
* https://github.com/segy/PhpExcel
* Usando Helper Class PhpExcelHelper extends AppHelper
*
*/
use Lib\Tools;

$this->PhpExcel->createWorksheet();


// define table cells
$table = array(
	array('label' => __('Cidade ou Região')),
	array('label' => __('Faixa CEP Inicial')),
	array('label' => __('Faixa CEP Final')),
	array('label' => __('Peso Inicial')),
	array('label' => __('Peso Final')),
	array('label' => __('Valor Frete')),
	array('label' => __('Prazo de Entrega')),
	array('label' => __('AD VALOREM ( % )')),
	array('label' => __('KG Adicional'))
);


$this->PhpExcel->getActiveSheet()
->getStyle('1')
->getFill()
->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
->getStartColor()
->setRGB('F9F9D1');

$this->PhpExcel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true)->setSize(13);


function setCorLinha($PhpExcel,$linha='')
{
	$PhpExcel->getActiveSheet()
	->getStyle($linha)
	->getFill()
	->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	->getStartColor()
	->setRGB('DEEBF7');
}

$this->PhpExcel->getActiveSheet()
    ->getStyle('F:H')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


// add heading with different font and bold text
$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));


// add data
$regiao='';
foreach ($tabela as $key => $dados) {

	if ($regiao !== $dados['ModeloTransportadora']['regiao']) {
		setCorLinha($this->PhpExcel, $key+2 );
		$regiao = $dados['ModeloTransportadora']['regiao'];
	}

	$this->PhpExcel->addTableRow(array(

		$dados['ModeloTransportadora']['regiao'],
		$dados['ModeloTransportadora']['cep_inicial'],
		$dados['ModeloTransportadora']['cep_final'],
		$dados['ModeloTransportadora']['peso_inicial'],
		$dados['ModeloTransportadora']['peso_final'],
		Tools::convertToDecimalBR( $dados['ModeloTransportadora']['valor'] ),
		$dados['ModeloTransportadora']['prazo_entrega'],
		$dados['ModeloTransportadora']['ad_valorem'],
		$dados['ModeloTransportadora']['kg_adicional']

	));

}

// close table and output
$this->PhpExcel->addTableFooter()
->output('arquivo-modelo-transportadora.xlsx', 'Excel2007');
