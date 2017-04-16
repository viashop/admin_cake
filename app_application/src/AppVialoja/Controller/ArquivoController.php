<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 27/09/16 às 14:51
 */

use Lib\Tools;
use AppVialoja\Interfaces\Controller\IArquivo;
use AppVialoja\Interfaces\Model\IShopEnvioTransportadora;
use AppVialoja\Interfaces\Model\IModeloTransportadora;
use AppVialoja\Interfaces\Model\IModeloProdutoImportar;


class ArquivoController extends AppController implements IArquivo
{

    /**
     * @var array
     */
    public $uses = array(

        'Shop',
        'ShopEnvio',
        'ShopEnvioTransportadora',
        'ModeloTransportadora',
        'ModeloProdutoImportar',
        'ShopDominio'

    );

    private function transportadoraImportar()
    {

        if ($this->ModeloTransportadora instanceof IModeloTransportadora) {
            $tabela = $this->ModeloTransportadora->getAll();
            $this->set(compact('tabela'));
        }
        $this->render('transportadora_importar');
    }

    private function transportadoraExportar()
    {
        if ($this->ShopEnvioTransportadora instanceof IShopEnvioTransportadora) {
            $tabela = $this->ShopEnvioTransportadora->readTransportadora($this->Shop);
            $this->set(compact('tabela'));
        }
        $this->render('transportadora_exportar');
    }

    private function transportadoraRemover()
    {
        if ($this->ShopEnvioTransportadora instanceof IShopEnvioTransportadora) {
            $this->ShopEnvioTransportadora->deleteTransportadora($this->Shop);
        }
        $this->setMsgAlertSuccess('Os dados de envio da transportadora foram apagados.');
        $this->redirect($this->referer());
    }

    /**
     * Transportadora Ler ou Remover
     * Dados de Transportadora
     */
    public function transportadora()
    {

        $this->layout = false;

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }

        if (isset($this->request->params['pass']['2'])) {

            switch ($this->request->params['pass']['2']) {
                case 'exportar':
                    self::transportadoraExportar();
                    break;
                case 'remover':
                    self::transportadoraRemover();
                    break;
            }

        } else {
            self::transportadoraImportar();
        }

    }

    /**
     * Importar XLSX Produto
     */
    public function produto()
    {

        $this->layout = false;

        try {

            if (!isset($this->request->params['pass']['0'])) {
                throw new \Exception();
            }

            switch ($this->request->params['pass']['0']) {
                case 'importar':
                    self::produtoModeloImportar();
                    break;

                case 'atualizar':
                    self::produtoModeloAtualizar();
                    break;

                default:
                    throw new \Exception();
                    break;
            }

        } catch (\Exception $e) {

            $this->render(false);
            return $this->redirect($this->referer());

        }

    }

    /**
     * Recebe XLSX Importar
     */
    private function produtoModeloImportar()
    {

        try {

            if ($this->ModeloProdutoImportar instanceof IModeloProdutoImportar) {
                $modelo = $this->ModeloProdutoImportar->obterModeloImportar();
                $this->set(compact('modelo'));
            }

            $this->render('produto_importar');
        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

    /**
     * Recebe XLSX
     */
    private function produtoModeloAtualizar()
    {

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }

        $produtos = $this->requestAction(
            array(
                'controller' => 'ShopProduto',
                'action' => 'getProdutoImportar'
            )
        );

        $dados = $this->ShopDominio->virtualUri($this->Shop);
        $nome_arquivo = Tools::slug($dados['ShopDominio']['virtual_uri']);

        $this->set(compact('nome_arquivo', 'produtos'));

        $this->render('produto_atualizar');

    }


}
