<?php

use Lib\Tools;
use Lib\Blowfish;


class ShopContaController extends AppController {

	public $uses = array('ShopConta');
	private $cipher;
    private $datasource;

	public function getAll()
	{
		try {

			$conditions = array(
                'conditions' => array(
                    'ShopConta.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            return $this->ShopConta->find('all', $conditions);

		} catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	public function recebeDados()
	{

        $this->datasource = $this->ShopConta->getDataSource();

		try {

            $this->datasource->begin();

            $this->cipher = new Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);

			$conditions = array(
                'conditions' => array(
                    'ShopConta.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ShopConta->find('count', $conditions) > 0) {

                $this->ok = $this->ShopConta->updateAll(array(

                    'ShopConta.tipo' => sprintf("'%s'", Tools::clean(Tools::getValue('tipo'))),
                    'ShopConta.email_nota_fiscal' => sprintf("'%s'", Tools::clean(Tools::getValue('email_nota_fiscal'))),
                    'ShopConta.nome_responsavel' => sprintf("'%s'", Tools::clean(Tools::getValue('nome_responsavel'))),
                    'ShopConta.razao_social' => sprintf("'%s'", Tools::clean(Tools::getValue('razao_social'))),
                    'ShopConta.cpf' => sprintf("'%s'", $this->cipher->encrypt(Tools::clean(Tools::getValue('cpf')))),
                    'ShopConta.cnpj' => sprintf("'%s'", $this->cipher->encrypt(Tools::clean(Tools::getValue('cnpj')))),
                    'ShopConta.telefone_principal' => sprintf("'%s'", Tools::clean(Tools::getValue('telefone_principal'))),
                    'ShopConta.telefone_celular' => sprintf("'%s'", Tools::clean(Tools::getValue('telefone_celular'))),
                    'ShopConta.endereco_logradouro' => sprintf("'%s'", Tools::clean(Tools::getValue('endereco_logradouro'))),
                    'ShopConta.endereco_complemento' => sprintf("'%s'", Tools::clean(Tools::getValue('endereco_complemento'))),
                    'ShopConta.endereco_bairro' => sprintf("'%s'", Tools::clean(Tools::getValue('endereco_bairro'))),
                    'ShopConta.endereco_cep' => sprintf("'%s'", Tools::clean(Tools::getValue('endereco_cep'))),
                    'ShopConta.endereco_estado' => sprintf("'%s'", Tools::clean(Tools::getValue('endereco_estado'))),
                    'ShopConta.endereco_cidade' => sprintf("'%s'", Tools::clean(Tools::getValue('endereco_cidade'))),
                    'ShopConta.forma_pagamento' => sprintf("'%s'", Tools::clean(Tools::getValue('forma_pagamento'))),
                    'ShopConta.numero' => sprintf("'%s'", $this->cipher->encrypt(Tools::clean(Tools::getValue('numero')))),
                    'ShopConta.editar_cartao' => sprintf("'%s'", Tools::clean(Tools::getValue('editar_cartao'))),
                    'ShopConta.nome' => sprintf("'%s'", $this->cipher->encrypt(Tools::clean(Tools::getValue('nome')))),
                    'ShopConta.cvv' => sprintf("'%s'", $this->cipher->encrypt(Tools::clean(Tools::getValue('cvv')))),
                    'ShopConta.mes_expiracao' => sprintf("'%s'", $this->cipher->encrypt(Tools::clean(Tools::getValue('mes_expiracao')))),
                    'ShopConta.ano_expiracao' => sprintf("'%s'", $this->cipher->encrypt(Tools::clean(Tools::getValue('ano_expiracao'))))

                ), array(
                    'ShopConta.id_shop_default' => $this->Session->read('id_shop')
                ));

            } else {

                $data = array(

                    'id_shop_default' => $this->Session->read('id_shop'),
                    'tipo' => Tools::clean(Tools::getValue('tipo')),
                    'email_nota_fiscal' => Tools::clean(Tools::getValue('email_nota_fiscal')),
                    'nome_responsavel' => Tools::clean(Tools::getValue('nome_responsavel')),
                    'razao_social' => Tools::clean(Tools::getValue('razao_social')),
                    'cpf' => $this->cipher->encrypt(Tools::clean(Tools::getValue('cpf'))),
                    'cnpj' => $this->cipher->encrypt(Tools::clean(Tools::getValue('cnpj'))),
                    'telefone_principal' => Tools::clean(Tools::getValue('telefone_principal')),
                    'telefone_celular' => Tools::clean(Tools::getValue('telefone_celular')),
                    'endereco_logradouro' => Tools::clean(Tools::getValue('endereco_logradouro')),
                    'endereco_complemento' => Tools::clean(Tools::getValue('endereco_complemento')),
                    'endereco_bairro' => Tools::clean(Tools::getValue('endereco_bairro')),
                    'endereco_cep' => Tools::clean(Tools::getValue('endereco_cep')),
                    'endereco_estado' => Tools::clean(Tools::getValue('endereco_estado')),
                    'endereco_cidade' => Tools::clean(Tools::getValue('endereco_cidade')),
                    'forma_pagamento' => Tools::clean(Tools::getValue('forma_pagamento')),
                    'editar_cartao' => Tools::clean(Tools::getValue('editar_cartao')),
                    'numero' => $this->cipher->encrypt(Tools::clean(Tools::getValue('numero'))),
                    'nome' => $this->cipher->encrypt(Tools::clean(Tools::getValue('nome'))),
                    'cvv' => $this->cipher->encrypt(Tools::clean(Tools::getValue('cvv'))),
                    'mes_expiracao' => $this->cipher->encrypt(Tools::clean(Tools::getValue('mes_expiracao'))),
                    'ano_expiracao' => $this->cipher->encrypt(Tools::clean(Tools::getValue('ano_expiracao')))

                );

                $this->ok = $this->ShopConta->saveAll($data);

            }

            $this->datasource->commit();

            return $this->ok;

		} catch (\PDOException $e) {

            $this->datasource->rollback();

            \Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
