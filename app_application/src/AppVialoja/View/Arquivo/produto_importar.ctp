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
  array('label' => __('Sku do produto pai')),
  array('label' => __('Ativo?')),
  array('label' => __('Condição')),
  array('label' => __('Nome produto')),
  array('label' => __('Descrição')),
  array('label' => __('Disponibilidade quando não gerenciar estoque.')),
  array('label' => __('Gerenciar estoque?')),
  array('label' => __('Quantidade')),
  array('label' => __('Disponibilidade dos produtos em estoque')),
  array('label' => __('Disponibilidade quando acabar produtos em estoque.')),
  array('label' => __('Preço custo')),
  array('label' => __('Preço venda')),
  array('label' => __('Preço promocional')),
  array('label' => __('Categoria (nível 1)')),
  array('label' => __('Categoria (nível 2)')),
  array('label' => __('Categoria (nível 3)')),
  array('label' => __('Marca')),
  array('label' => __('Peso (kg)')),
  array('label' => __('Altura (cm)')),
  array('label' => __('Largura (cm)')),
  array('label' => __('Comprimento (cm)')),
  array('label' => __('Link para a foto principal')),
  array('label' => __('Link para foto adicional 1')),
  array('label' => __('Link para foto adicional 2')),
  array('label' => __('Link para foto adicional 3')),
  array('label' => __('URL antiga do produto')),
  array('label' => __('Link do vídeo no Youtube')),
  array('label' => __('Tamanho de tênis')),
  array('label' => __('Produto com uma cor')),
  array('label' => __('Tamanho de capacete')),
  array('label' => __('Tamanho de calça')),
  array('label' => __('Produto com duas cores')),
  array('label' => __('Voltagem')),
  array('label' => __('Tamanho de camisa/camiseta')),
  array('label' => __('Tamanho de anel/aliança')),
  array('label' => __('Gênero'))
);

$this->PhpExcel->getActiveSheet()
->getStyle('1')
->getFill()
->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
->getStartColor()
->setRGB('DBF9D1');

$this->PhpExcel->getActiveSheet()->getStyle("1")->getFont()->setBold(true)->setSize(13);

$this->PhpExcel->getActiveSheet()
    ->getStyle('L:M')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$this->PhpExcel->getActiveSheet()
    ->getStyle('N:S')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

// add heading with different font and bold text
$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));


// add data
foreach ($modelo as $key => $dados) {

  $peso ='';
  if (!empty($dados['ModeloProdutoImportar']['peso_kg'])) {
    $peso = Tools::convertToDecimalBR( $dados['ModeloProdutoImportar']['peso_kg'] , 3);
  }

  $preco_custo = '';
  if (!empty($dados['ModeloProdutoImportar']['preco_custo'])) {
    $preco_custo = Tools::convertToDecimalBR( $dados['ModeloProdutoImportar']['preco_custo'] );
  }

  $preco_venda = '';
  if (!empty($dados['ModeloProdutoImportar']['preco_venda'])) {
    $preco_venda = Tools::convertToDecimalBR( $dados['ModeloProdutoImportar']['preco_venda'] );
  }

  $preco_promocional = '';
  if (!empty($dados['ModeloProdutoImportar']['preco_promocional'])) {
    $preco_promocional = Tools::convertToDecimalBR($dados['ModeloProdutoImportar']['preco_promocional'] );

  }

  $altura = '';
  if (!empty($dados['ModeloProdutoImportar']['altura_cm'])) {
    $altura = $dados['ModeloProdutoImportar']['altura_cm'];
  }

  $largura = '';
  if (!empty($dados['ModeloProdutoImportar']['largura_cm'])) {
    $largura = $dados['ModeloProdutoImportar']['largura_cm'];
  }

  $comprimento ='';
  if (!empty($dados['ModeloProdutoImportar']['comprimento_cm'])) {
    $comprimento = $dados['ModeloProdutoImportar']['comprimento_cm'];
  }

  $this->PhpExcel->addTableRow(array(

    $dados['ModeloProdutoImportar']['sku'],
    $dados['ModeloProdutoImportar']['sku_do_produto_pai'],
    $dados['ModeloProdutoImportar']['ativo'],
    $dados['ModeloProdutoImportar']['condicao'],
    $dados['ModeloProdutoImportar']['nome_produto'],
    $dados['ModeloProdutoImportar']['descricao'],
    $dados['ModeloProdutoImportar']['disponibilidade_quando_nao_gerenciar_estoque'],
    $dados['ModeloProdutoImportar']['gerenciar_estoque'],
    $dados['ModeloProdutoImportar']['quantidade'],
    $dados['ModeloProdutoImportar']['disponibilidade_dos_produtos_em_estoque'],
    $dados['ModeloProdutoImportar']['disponibilidade_quando_acabar_produtos_em_estoque'],
    $preco_custo,
    $preco_venda,
    $preco_promocional,
    $dados['ModeloProdutoImportar']['categoria_nivel_1'],
    $dados['ModeloProdutoImportar']['categoria_nivel_2'],
    $dados['ModeloProdutoImportar']['categoria_nivel_3'],
    $dados['ModeloProdutoImportar']['marca'],
    $peso,
    $altura,
    $largura,
    $comprimento,
    $dados['ModeloProdutoImportar']['link_para_a_foto_principal'],
    $dados['ModeloProdutoImportar']['link_para_foto_adicional_1'],
    $dados['ModeloProdutoImportar']['link_para_foto_adicional_2'],
    $dados['ModeloProdutoImportar']['link_para_foto_adicional_3'],
    $dados['ModeloProdutoImportar']['url_antiga_do_produto'],
    $dados['ModeloProdutoImportar']['link_do_video_no_youtube'],
    $dados['ModeloProdutoImportar']['tamanho_de_tenis'],
    $dados['ModeloProdutoImportar']['produto_com_uma_cor'],
    $dados['ModeloProdutoImportar']['tamanho_de_capacete'],
    $dados['ModeloProdutoImportar']['tamanho_de_calca'],
    $dados['ModeloProdutoImportar']['produto_com_duas_cores'],
    $dados['ModeloProdutoImportar']['voltagem'],
    $dados['ModeloProdutoImportar']['tamanho_de_camisa_camiseta'],
    $dados['ModeloProdutoImportar']['tamanho_de_anel_alianca'],
    $dados['ModeloProdutoImportar']['genero']

  ));

}

// close table and output
$this->PhpExcel->addTableFooter()
->output('arquivo-modelo-importar.xlsx', 'Excel2007');
