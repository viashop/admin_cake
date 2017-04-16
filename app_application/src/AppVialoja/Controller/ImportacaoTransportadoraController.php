<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 04/05/16 às 02:20
 * @see Respect/Validation
 * @link https://github.com/Respect/Validation/blob/master/docs/VALIDATORS.md Documentação
 * @example if(v::notEmpty()->validate($var))
 */

use Lib\Validate;
use PHPOffice\PHPExcel\ReadExcel;
use PHPOffice\PHPExcel\AbstractReadExcel;
use AppVialoja\Interfaces\Controller\IImportacaoTransportadora;

class ImportacaoTransportadoraController extends AppController implements IImportacaoTransportadora
{

    public $uses = array(
        'Shop',
        'ShopEnvio',
        'ShopEnvioTransportadora'
    );

    private $datasource;
    private $id_envio_default;

    /**
     * Salva dados da Planilha e Remove a antiga
     * Em Caso de Erro Volta no estado Original com Transactions
     * @internal removeAll($this->Session->read('id_shop'))
     * @internal saveAll($data)
     * @param $array
     */
    private function sendObjetcsModel($array)
    {

        $this->datasource = $this->ShopEnvioTransportadora->getDataSource();

        try {

            $this->datasource->begin();

            if ($this->Shop instanceof Shop) {
                $this->Shop->setIdShop($this->Session->read('id_shop'));
            }

            if ($this->ShopEnvio instanceof ShopEnvio) {
                $this->ShopEnvio->setIdEnvio($this->id_envio_default);

                if ($this->ShopEnvioTransportadora instanceof ShopEnvioTransportadora) {

                    $this->ShopEnvioTransportadora->deleteTransportadora($this->Shop);

                    foreach ($array as $this->v) {

                        $this->ShopEnvioTransportadora->setRegiao($this->v['regiao'])
                            ->setCepInicio($this->v['cep_inicio'])
                            ->setCepFim($this->v['cep_fim'])
                            ->setPesoInicial(Validate::isDecimal($this->v['peso_inicial']))
                            ->setPesoFinal(Validate::isDecimal($this->v['peso_final']))
                            ->setValor(Validate::isDecimal($this->v['valor']))
                            ->setPrazoEntrega($this->v['prazo_entrega'])
                            ->setAdValorem(Validate::isDecimal($this->v['ad_valorem']))
                            ->setKgAdicional(Validate::isDecimal($this->v['kg_adicional']));

                        $this->ShopEnvioTransportadora->createTransportadora(
                            $this->Shop,
                            $this->ShopEnvio,
                            $this->ShopEnvioTransportadora
                        );

                    }

                }

            }

            if ($this->datasource->commit()) {
                $this->setMsgAlertSuccess('Tabela de transportes enviada com sucesso.');
            }

        } catch (\Exception\VialojaInvalidTransactionException $e) {

            $this->datasource->rollback();
            $this->setMsgAlertError($e->getMessage());
            return $this->redirect($this->referer());

        }

    }

    /**
     * Recebe a Planilha e faz a validações e cadastra
     * @see protected function salvaDadosEmDBExcelXLSX()
     */
    public function recebeDadosExcelXLSX()
    {

        if (!$this->request->is('post')) {
            throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
        }

        if (!$this->Session->read('id_shop')) {
            throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
        }

        /**
         * Parametro de Envio
         */
        $this->id_envio_default = isset($this->params['named']['id_envio_default']) ? $this->params['named']['id_envio_default'] : false;

        if (!is_numeric($this->id_envio_default)) {
            throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
        }

        $arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : false;

        $readExcel = new ReadExcel();

        if ($readExcel instanceof AbstractReadExcel) {

            $readExcel->file($arquivo);
            $readExcel->validateSomething('\PHPOffice\\PHPExcel\\Something\\SomeShippingCompany');
            $dataObject = $readExcel->draw('\\PHPOffice\\PHPExcel\\ShippingCompanyExcel');
            /**
             * Envia para Model para Salvar
             */
            self::sendObjetcsModel($dataObject);

        }

    }

}
