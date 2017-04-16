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

$regiao='';
foreach ($tabela as $key => $dados) {

  if ($key <= 0) {
    $created = $dados['ShopEnvioTransportadora']['created'];
  }

  if ($regiao !== $dados['ShopEnvioTransportadora']['regiao']) {
    setCorLinha( $this->PhpExcel, $key+2 );
    $regiao = $dados['ShopEnvioTransportadora']['regiao'];
  }

  $this->PhpExcel->addTableRow(array(

    $dados['ShopEnvioTransportadora']['regiao'],
    $dados['ShopEnvioTransportadora']['cep_inicio'],
    $dados['ShopEnvioTransportadora']['cep_fim'],
    $dados['ShopEnvioTransportadora']['peso_inicial'],
    $dados['ShopEnvioTransportadora']['peso_final'],
    Tools::convertToDecimalBR( $dados['ShopEnvioTransportadora']['valor'] ),
    $dados['ShopEnvioTransportadora']['prazo_entrega'],
    $dados['ShopEnvioTransportadora']['ad_valorem'],
    $dados['ShopEnvioTransportadora']['kg_adicional']

  ));

}


// close table and output
$this->PhpExcel->addTableFooter()
->output('arquivo-'. \Lib\Tools::slug( $created ) .'-transportadora.xlsx', 'Excel2007');
