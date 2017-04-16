<?php

use Lib\Tools;
use Lib\Validate;
use WideImage\WideImage;


class ShopEnvioPersonalizadoController extends AppController {

	public $uses = array('ShopEnvioPersonalizado');

	/**
	 * Cadastra frete personalizado
	 * @return string
	 */
	public function insert()
	{
		try {

			if (Tools::getValue('nome') == '') {
				throw new \LogicException("O nome do frete personalizado, não pode ser vazio.", E_USER_WARNING);
			}

			$imagem = self::envia_logo();

			$data = array(
				'id_shop_default' => $this->Session->read('id_shop'),
				'ativo' => Tools::clean(Tools::getValue('ativo')),
				'nome' => Tools::clean(Tools::getValue('nome')),
				'prazo_adicional' => Tools::clean(Tools::getValue('prazo_adicional')),
				'taxa_tipo' => Tools::clean(Tools::getValue('taxa_tipo')),
				'taxa_valor' => Tools::convertToDecimal(Tools::getValue('taxa_valor')),
	            'imagem' => $imagem
			);

			$this->ShopEnvioPersonalizado->saveAll($data);

			if ($this->ShopEnvioPersonalizado->getLastInsertId()>0) {
				$this->setMsgAlertInfo("Para que esta forma de envio fique disponível é necessário cadastrar a <a href=\"#faixas-cep\" style=\"color:green !important;\">Faixa de CEP<\/a> das regiões atendidas.");
				return $this->redirect( array('controller' => 'configuracao', 'action' => 'envio', 'personalizado', $this->ShopEnvioPersonalizado->getLastInsertId(), 'editar' ) );
			}

		} catch (\PDOException $e) {

			if (isset($e->errorInfo[0]) && $e->errorInfo[0] === '23000') {
				$this->setMsgAlertError('Atenção! Já existe Frete Personalizado com este nome.');
			} else {
				\Exception\VialojaDatabaseException::errorHandler($e);
			}

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());

		} catch (\RuntimeException $e) {

			$this->setMsgAlertError($e->getMessage());

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

	/**
	 * Upload de logotipo envio personalizado
	 * @return string
	 */
	private function envia_logo()
	{

		$arquivo = isset($_FILES['imagem']) ? $_FILES['imagem'] : false;


		if (empty($arquivo['name']) && empty($arquivo['tmp_name'])) {
			return null;
		}

		$diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'envio-personalizado' . DS;
		/**
		 *
		 * Verifica se o diretorio existe or cria
		 *
		 **/
		Tools::createFolder($diretorio);

		$img_name = $arquivo['name'];
		$img_temp = $arquivo['tmp_name'];

		if (!Validate::isMaxSize($arquivo['size'])) {
			throw new \InvalidArgumentException("O arquivo enviado é muito grande, envie arquivos de no máximo 2Mb.", E_USER_WARNING);
		}

		if (!Validate::isImage($arquivo)) {
			throw new \InvalidArgumentException("Atenção! Envie uma imagem válida. O arquivo enviado não é uma imagem ou está corrompido.", E_USER_WARNING);
		}

		$path = Validate::checkNameFile($img_name, $diretorio);

		if (isset($path)) {

			move_uploaded_file($img_temp, $diretorio . $path);
			$original = WideImage::load($diretorio . $path);
			$original->resize(100, 50, 'inside')->saveToFile($diretorio . $path);
			$original->destroy();

			return $path;

		} else {
			throw new \RuntimeException("Atenção! Não foi possivel efetuar o upload do arquivo, tente novamente!", E_USER_WARNING);
		}

	}

	/**
	 * Edita o frete personalizado
	 * @return string
	 */
	public function editar() {

		try {

			if(!is_numeric($this->params['named']['id'])){
				throw new \LogicException('Informe o id do tipo INT');
			}

			if ( empty($this->params['named']['id']) ) {
				throw new \LogicException("Valor obrigatório: Informe a variavel id ", E_USER_WARNING);
			}

			if (Tools::getValue('nome') == '') {
				throw new \LogicException("O nome do frete personalizado, não pode ser vazio.", E_USER_WARNING);
			}

			$imagem = self::envia_logo();

			$fields = array(
				'ShopEnvioPersonalizado.ativo' => sprintf("'%s'", Tools::clean(Tools::getValue('ativo'))),
				'ShopEnvioPersonalizado.nome' => sprintf("'%s'", Tools::clean(Tools::getValue('nome'))),
				'ShopEnvioPersonalizado.prazo_adicional' => sprintf("'%s'", Tools::clean(Tools::getValue('prazo_adicional'))),
				'ShopEnvioPersonalizado.taxa_tipo' => sprintf("'%s'", Tools::clean(Tools::getValue('taxa_tipo'))),
				'ShopEnvioPersonalizado.taxa_valor' => Tools::convertToDecimal(Tools::getValue('taxa_valor')),
	            'ShopEnvioPersonalizado.imagem' => sprintf("'%s'", $imagem )
			);

			$conditions = array(
			    'ShopEnvioPersonalizado.id' => $this->params['named']['id'],
			    'ShopEnvioPersonalizado.id_shop_default' => $this->Session->read('id_shop')
			);

			$this->ShopEnvioPersonalizado->updateAll($fields, $conditions);

            if ($this->ShopEnvioPersonalizado->getAffectedRows()>0) {
            	$this->setMsgAlertSuccess('Forma de envio editada com sucesso.');
				return $this->redirect( array('controller' => 'configuracao', 'action' => 'envio', 'listar') );
            } else {
                $this->setMsgAlertWarning(ERROR_UPDATE);
            }

		} catch (\PDOException $e) {

			if (isset($e->errorInfo[0]) && $e->errorInfo[0] === '23000') {
				$this->setMsgAlertError('Atenção! Já existe Frete Personalizado com este nome.');
			} else {
				\Exception\VialojaDatabaseException::errorHandler($e);
			}

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());

		} catch (\RuntimeException $e) {

			$this->setMsgAlertError($e->getMessage());

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
