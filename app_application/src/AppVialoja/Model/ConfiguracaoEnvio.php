<?php

/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 17/10/16 às 16:12
 */
use AppVialoja\Interfaces\Model\IConfiguracaoEnvio;

class ConfiguracaoEnvio extends AppModel implements IConfiguracaoEnvio
{

	public $name = 'ConfiguracaoEnvio';
    public $useTable = 'configuracao_envio';
    public $useDbConfig = 'default';

    /**
     * Retorna todos os dados
     * @return array|null
     */
    public function obterTodasAsConfiguracoesDeEnvio()
    {
        try {

            $conditions = array(
                'conditions' => array(
                    'ConfiguracaoEnvio.ativo' => 1
                )
            );

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    /**
     * Recupera as formas de envio via IN
     * @param string $arrayIds
     * @return array|null
     */
    public function obterConfiguracoesDeEnvioComIN($arrayIds='')
    {
        try {

            if (!is_array($arrayIds)) {
                throw new \LogicException("Parâmetro arrayIds inválido", E_USER_NOTICE);
            }

            if (empty($arrayIds)) {
                throw new \LogicException("Parâmetro arrayIds inválido", E_USER_NOTICE);
            }

            $conditions = array(
                'conditions' => array(
                    'ConfiguracaoEnvio.id' => $arrayIds
                )
            );

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
		}

    }

}
