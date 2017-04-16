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
    public function getImagemPrincipal($id_shop='')
    {
        try {            
            
            if (!Validate::isInt($id_shop)) {
                throw new LogicException("Valor obrigatório: Informe o id do Shop", 1);
            }
            
            $conditions = array(
                'fields' => array(
                    'ShopProdutoImagem.nome_imagem'
                ),
                'conditions' => array(
                    'ShopProdutoImagem.posicao' => 0,
                    'ShopProdutoImagem.id_produto_default' => $id_shop
                ),
                'limit' => 1
            );
            
            $result = $this->find('first', $conditions);

            if (Validate::isNotNull($result)) {
                return $result['ShopProdutoImagem']['nome_imagem'];
            } else {
                return false;
            }
            
        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }
        
    }


    /** 
     * Lista foto produto complementares da principal. 
     * @access public 
     * @param String $id
     * @param Array $conditions
     */
    public function getImagemSecundariasAll($id_shop='')
    {
        try {            
            
            if (!Validate::isInt($id_shop)) {
                throw new LogicException("Valor obrigatório: Informe o id do Shop", 1);
            }
            
            $conditions = array(
                'fields' => array(
                    'ShopProdutoImagem.nome_imagem',
                    'ShopProdutoImagem.posicao'
                ),
                'conditions' => array(
                    'ShopProdutoImagem.id_produto_default' => $id_shop
                ),
                'order' => array('ShopProdutoImagem.posicao' => 'ASC'),
                'limit' => 4
            );
            
            return $this->find('all', $conditions);
            
        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }
        
    }

}
