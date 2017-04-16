<?php

use Lib\Tools;
use Lib\Validate;
App::uses('Model', 'Model');

class ShopCategoria extends AppModel {

    public $name = 'ShopCategoria';
    public $useTable = 'shop_categoria';
    public $primaryKey = 'id_categoria';
    public $useDbConfig = 'default';


    /*
     * Lista as categoria em menu MainNav
     * @access public
     * @param String id_shop
     */
    public function categoriaProdutoBreadcrumb($categoria_parent_id = 0, $atividade_nome='', $atividade_id='', $id_shop_default='', $id_produto='')
    {
        
        try {

        	$atividade_nome = Tools::slug( $atividade_nome );
            
            // Construir a nossa lista de categorias de uma só vez
            static $cats;
            
            if (!is_array($cats)) {
                
                /*
                 * Verifica se a página já existe
                 */
                $conditions = array(
                    
                    'fields' => array(
                        'ShopCategoria.id_categoria',
                        'ShopCategoria.nome_categoria',
                        'ShopCategoria.url',
                        'ShopCategoria.ativa',
                        'ShopCategoria.categoria_parent_id',
                        'ShopCategoria.nleft'
                    ),
                    'conditions' => array(
                        'ShopCategoria.id_shop_default' => $id_shop_default,
                        'ShopProdutoCategoria.id_produto_default' => $id_produto
                    ),
                    'order' => array(
                        'ShopCategoria.posicao' => 'ASC',
                        'ShopCategoria.nome_categoria' => 'ASC'
                    ),

                    'joins' => array(
                        array(
                            'table' => 'shop_produto_categoria',
                            'alias' => 'ShopProdutoCategoria',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'ShopCategoria.id_categoria = ShopProdutoCategoria.id_categoria_default'
                            )
                        ), 

                    ),
                    
                );
   
                $result = $this->find('all', $conditions);

                if (!Validate::isNotNull($result)) {
                    return false;
                }
                
                $cats = array();
                foreach ($result as $key => $cat) {
                    array_push($cats, $cat);
                }
                
            }            
            
            // Preencher uma lista de matriz itens
            $lista_itens = array();
            
            foreach ($cats as $cat) {
                
                // if não do tipo inteiro, seguir em frente
                if (( int ) $cat['ShopCategoria']['categoria_parent_id'] !== ( int ) $categoria_parent_id) {
                    continue;
                }
                
                // abra o item da lista
              
				$lista_itens[] = '<a href="'. sprintf('%s/c/%s/%d/cs/%s/%d/', FULL_BASE_URL, $atividade_nome, $atividade_id, Tools::slug($cat['ShopCategoria']['nome_categoria']), $cat['ShopCategoria']['id_categoria'] ) .'" title="'. $cat['ShopCategoria']['nome_categoria'] .'">'. $cat['ShopCategoria']['nome_categoria'] .'</a>' . PHP_EOL;
                    
               
                $lista_itens[] = '<span class="navigation-pipe">/</span>';                
                
                // recurse na lista de filhos
                $lista_itens[] = self::categoriaProdutoBreadcrumb($cat['ShopCategoria']['id_categoria'], $atividade_nome, $atividade_id, $id_shop_default, $id_produto);
                
                
            }
            
            // converter para uma string
            $lista_itens = implode('', $lista_itens);
            
            // if vazio, sem os itens da lista!
            if ('' == trim($lista_itens)) {
                return '';
            }
            
            return $lista_itens;
            
        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }
        
    }

}
