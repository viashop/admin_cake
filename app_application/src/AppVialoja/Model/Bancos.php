<?php



class Bancos extends AppModel {

    public $name = 'Bancos';
    public $useDbConfig = 'default';
    public $useTable = 'bancos';

    /**
     * Listar Forma de Pagamento
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function getBancosJoinAll($id_shop='')
    {
        try {

            $conditions = array(

                'fields' => array(
                    'Bancos.*',
                    'ShopPagamentoDepositoConfig.*'
                    ),

                /*
                'conditions' => array(
                    'ConfiguracaoPagamento.ativo' => 1,
                ),
                */

                'order' => array(
                    'Bancos.id' => 'ASC'
                    ),

                //'group' => array('Bancos.numero'),
                //'limit' => 25,

                'joins' => array(

                    array(
                        'table' => 'shop_pagamento_deposito_config',
                        'alias' => 'ShopPagamentoDepositoConfig',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopPagamentoDepositoConfig.numero_banco_default = Bancos.numero',
                            'ShopPagamentoDepositoConfig.id_shop_default' => $id_shop
                            )
                        ),

                    ),

                );

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

     /**
     * Recuperar nome Banco
     * @access public
     * @param String $id_shop variavel de sessão
      * @return string
     */
     public function getIdBanco($id='')
     {
        try {

            if ( empty( $id ) ) {
                throw new \LogicException("Parâmetro ID inválido", 1);
            }

            $conditions = array(
                'fields' => array(
                    'Bancos.numero',
                    'Bancos.nome',
                    'Bancos.logo'
                    ),
                'conditions' => array('Bancos.id' => $id )
                );

            return $this->find('first', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

}
