<?php

use Lib\Validate;
App::uses('AppModel', 'Model');
/**
 * ShopProdutoImagem Model
 *
 */
class ShopProdutoImagem extends AppModel {

	public $name = 'ShopProdutoImagem';
	public $useDbConfig = 'default';
	public $useTable = 'shop_produto_imagem';
	public $primaryKey = 'id_imagem';



	/** 
     * Lista foto produto principal. 
     * @access public 
     * @param String $id
     * @param Array $conditions
     */
    public function getImagemPrincipal($id='')
    {
        try {            
            
            $this->conditions = array(
                'fields' => array(
                    'ShopProdutoImagem.nome_imagem'
                ),
                'conditions' => array(
                    'ShopProdutoImagem.posicao' => 0,
                    'ShopProdutoImagem.id_produto_default' => intval($id)
                ),
                'limit' => 1
            );
            
            $this->result = $this->find('first', $this->conditions);

            if (Validate::isNotNull($this->result)) {
                return $this->result['ShopProdutoImagem']['nome_imagem'];
            } else {
                return false;
            }
            
        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }
        
    }
	
	
	/** 
     * Lista todas ascfotos produto. 
     * @access public 
     * @param String $id_produto
     * @retunr Array
     */
    public function getImagemAll($id_produto='')
    {
        try {
 
            $this->conditions = array(
			
                'fields' => array(
                    'ShopProdutoImagem.id_imagem',
                    'ShopProdutoImagem.id_produto_default',
                    'ShopProdutoImagem.nome_imagem',
                    'ShopProdutoImagem.posicao'
                ),				
                'conditions' => array(
                    'ShopProdutoImagem.id_produto_default' => intval($id_produto)
					
                ),				
                'order' => array('ShopProdutoImagem.posicao' => 'ASC'),
				'limit' => 10
            );
            	 
            if ($this->find('count', $this->conditions) > 0) {                
				return $this->find('all', $this->conditions);                
            } else {
                return false;
            }
            
        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }
        
    }

}
