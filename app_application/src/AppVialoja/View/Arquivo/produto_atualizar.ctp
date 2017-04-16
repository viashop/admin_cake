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
    array('label' => __('SKU')),
    array('label' => __('Ativo?')),
    array('label' => __('Nome produto')),
    array('label' => __('Gerenciar estoque?')),
    array('label' => __('Quantidade em estoque')),
    array('label' => __('Preço custo')),
    array('label' => __('Preço venda')),
    array('label' => __('Preço promocional')),
    array('label' => __('Peso (kg)')),
    array('label' => __('Altura (cm)')),
    array('label' => __('Largura (cm)')),
    array('label' => __('Comprimento (cm)'))
);



function setCorLinha($PhpExcel,$linha='')
{
  $PhpExcel->getActiveSheet()
  ->getStyle($linha)
  ->getFill()
  ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
  ->getStartColor()
  ->setRGB('E1E1E1');
}




$this->PhpExcel->getActiveSheet()
    ->getStyle('1')
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setRGB('D1E6F9');

$this->PhpExcel->getActiveSheet()->getStyle("1")->getFont()->setBold(true)->setSize(13);

$this->PhpExcel->getActiveSheet()
    ->getStyle('F:G')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$this->PhpExcel->getActiveSheet()
    ->getStyle('H:I')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

// add heading with different font and bold text
$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));

// add data
foreach ($produtos as $key => $produto) {

	if(!empty($produto['ShopProduto']['nome'])){

		$ativo = 'NÃO';
		if ($produto['ShopProduto']['ativo'] =='True') {
			$ativo = 'SIM';
		}

		$gerenciado = 'NÃO';
		if ($produto['ShopProduto']['gerenciado'] =='True') {
			$gerenciado = 'SIM';
		}

		$quantidade = null;
		if (isset($produto['ShopProduto']['quantidade'])) {
			$quantidade = $produto['ShopProduto']['quantidade'];
		}

		$preco_custo = null;
		if (!empty($produto['ShopProduto']['preco_custo'])
			&& floatval($produto['ShopProduto']['preco_custo']) > 0 ) {
			$preco_custo = Tools::convertToDecimalBR( $produto['ShopProduto']['preco_custo'] );
		}

		$preco_cheio = null;
		if (!empty($produto['ShopProduto']['preco_cheio'])
			&& floatval($produto['ShopProduto']['preco_cheio']) > 0 ) {
			$preco_cheio = Tools::convertToDecimalBR( $produto['ShopProduto']['preco_cheio'] );
		}

		$preco_promocional = null;
		if (!empty($produto['ShopProduto']['preco_promocional'])
			&& floatval($produto['ShopProduto']['preco_promocional']) > 0 ) {
			$preco_promocional = Tools::convertToDecimalBR( $produto['ShopProduto']['preco_promocional'] );

		}

		$peso = null;
		if (!empty($produto['ShopProduto']['peso'])
			&& floatval($produto['ShopProduto']['peso']) > 0 ) {
			$peso = Tools::convertToDecimalBR( $produto['ShopProduto']['peso'], 3);

		}

		$altura = null;
		if (!empty($produto['ShopProduto']['altura'])) {
			$altura = $produto['ShopProduto']['altura'];
		}

		$largura = null;
		if (!empty($produto['ShopProduto']['largura'])) {
			$largura = $produto['ShopProduto']['largura'];
		}

		$comprimento = null;
		if (!empty($produto['ShopProduto']['comprimento'])) {
			$comprimento = $produto['ShopProduto']['comprimento'];
		}


		if ($produto['ShopProduto']['tipo'] === 'atributo') {

			if ($produto['ShopProduto']['parente_id'] > 0) {

				$this->PhpExcel->addTableRow(array(
					$produto['ShopProduto']['sku'],
					$ativo,
					$produto['ShopProduto']['nome'],
					$gerenciado,
					$quantidade,
					$preco_custo,
					$preco_cheio,
					$preco_promocional,
					$peso,
					$altura,
					$largura,
					$comprimento
				));

			} else {


				setCorLinha( $this->PhpExcel, $key +2 );

				$this->PhpExcel->addTableRow(array(
					$produto['ShopProduto']['sku'],
					$ativo,
					$produto['ShopProduto']['nome'],
					'#None',
					'#None',
					'#None',
					'#None',
					'#None',
					'#None',
					'#None',
					'#None',
					'#None'
				));

			}


		} else {

			$this->PhpExcel->addTableRow(array(
				$produto['ShopProduto']['sku'],
				$ativo,
				$produto['ShopProduto']['nome'],
				$gerenciado,
				$quantidade,
				$preco_custo,
				$preco_cheio,
				$preco_promocional,
				$peso,
				$altura,
				$largura,
				$comprimento
			));

		}

	}

}

$this->PhpExcel->addTableFooter()
    ->output($nome_arquivo .'-arquivo-modelo-atualizar.xlsx', 'Excel2007');
