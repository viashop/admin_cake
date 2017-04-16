<?php

App::uses('Model', 'Model');

class ShopCupomDesconto extends AppModel {

    public $name = 'ShopCupomDesconto';
    public $useTable = 'shop_cupom_desconto';
    public $primaryKey = 'id_cupom';
    public $useDbConfig = 'default';

    /**
     * Retorna os dados de cupom de desconto
     * @param  string $id_shop ID da Loja Shop
     * @param  string $codigo  codigo de desconto
     * @return array dados do cupom
     */
    public function getCupomCode($id_shop='', $codigo='')
    {
    	try {
            
            $conditions = array(
                'fields' => array(
                    'ShopCupomDesconto.id_cupom',
                    'ShopCupomDesconto.ativo',
                    'ShopCupomDesconto.codigo',
                    'ShopCupomDesconto.descricao',
                    'ShopCupomDesconto.tipo',
                    'ShopCupomDesconto.valor',
                    'ShopCupomDesconto.valor_minimo',
                    'ShopCupomDesconto.quantidade',
                    'ShopCupomDesconto.validade',
                    'ShopCupomDesconto.cumulativo',
                    'ShopCupomDesconto.quantidade_por_cliente',
                    'ShopCupomDesconto.aplicar_no_total'
                ),
                'conditions' => array(
                    'ShopCupomDesconto.id_shop_default' => $id_shop,
                    'ShopCupomDesconto.codigo' => $codigo,
                    'ShopCupomDesconto.ativo' => 'True'
                ),
                'limit' => 1
            );
            
            if ($this->find('count', $conditions) <= 0) {
                return false;
            }
            
           	return $this->find('first', $conditions);

            
        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }


    /**
     * Verifica se existe cupom ativo
     * @param  string $id_shop ID da Loja Shop
     * @return bool true or false
     */
    public function getCupomAtivo($id_shop='')
    {
    	try {
            
            $conditions = array(           
                'conditions' => array(
                    'ShopCupomDesconto.id_shop_default' => $id_shop
                )
            );
            
            if ($this->find('count', $conditions) > 0)
                return true;
            return false;
                  
        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }


}
