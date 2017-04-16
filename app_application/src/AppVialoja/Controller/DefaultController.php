<?php

/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 17/10/16 às 02:55
 */
use Lib\Tools;
use Respect\Validation\Validator as v;

class DefaultController extends AppController
{

    public $uses = array(
        'Shop',
        'Wizard',
        'ShopDominio',
        'LogShopTrafego',
        'LogShopVisita',
        'PlanoShop',
        'ShopProduto',
        'ShopFatura'
    );

    public function index()
    {

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }

        /** Valida dominio de login entre dominios **/
        if (isset($this->auto_login_dominio)) {

            $this->requestAction(
                array(
                    'controller' => 'ShopDominio',
                    'action' => 'validaDominioAutoLogin',
                    'controller_redirect' => $this->request->controller,
                    'dominio' => base64_encode($this->auto_login_dominio)
                )
            );

        }

        if ($this->Session->read('id_shop')) {

            if (!$this->Session->read('passo_wizard_complete')) {
                if (!isset($_COOKIE['__vialoja_step'])) {
                    /** Verifica os passos se já foram concluídos **/
                    self::verificaPasso();
                }

            }

        }

        /** Configurações e Plano ***/
        $config = $this->Shop->configuracaoPlanoShop($this->Shop);
        $this->set(compact('config'));

        /** Retorna o cliclo de pagamento ***/
        $ciclo = $this->ShopFatura->cicloContaPlano($this->Shop);
        $this->set(compact('ciclo'));

        /** Recupera Valor e o ID do plano Atual **/
        $dados = $this->Shop->getIdStatusPlanoShop($this->Shop);
        $id_plano = $dados['Shop']['id_plano'];
        $this->Shop->setIdPlano($id_plano);
        $valor_plano = $this->PlanoShop->valorPlano($this->Shop);
        $this->set(compact('id_plano', 'valor_plano'));

        /** Total de produto Ativo **/
        $total_produto_ativo = $this->ShopProduto->totalProdutoUso($this->Shop);
        $this->set(compact('total_produto_ativo'));

        $dados = $this->Shop->getDadosLogomarca($this->Shop);

        define('PAGINA_INICIAL_PAINEL', true);

        if (!empty($dados['Shop']['logo'])) {

            $diretorio = CDN_UPLOAD . $this->Session->read('id_shop') . '/logo/';
            define('LOGO_SHOP', $diretorio . $dados['Shop']['logo']);
            define('URL_SHOP', $dados['ShopDominio']['dominio']);

        }

        $std = new \stdClass();
        $std->domain = 'subdominio';
        $res = $this->ShopDominio->obterResumoDominioTipo($this->Shop, $std);
        $subdominio = $res['ShopDominio']['dominio'];
        $this->set(compact('subdominio'));

        $std = new \stdClass();
        $std->domain = 'dominio';
        $res = $this->ShopDominio->obterResumoDominioTipo($this->Shop, $std);
        $dominio = $res['ShopDominio']['dominio'];
        $this->set(compact('dominio'));

        $std = new \stdClass();
        $std->data_inicio = $ciclo['ShopFatura']['data_mes_inicial'];
        $total = $this->LogShopTrafego->obterTotalTrafego($this->Shop, $std);
        $soma_uso_trafego = $total['0']['SOMA_BYTES'];
        $total_visita = $this->LogShopVisita->obterTotalVisita($this->Shop, $std);
        $this->set(compact('soma_uso_trafego', 'total_visita'));

        self::deleteExportacaoListaEmails();

        $this->set('title_for_layout', 'Painel de controle');
        /*==========  Manter abaixo dos code a Render  ==========*/
        $this->render('index_painel_admin');

    }

//    private function getDominio()
//    {
//        if ($this->Shop instanceof Shop) {
//            $this->Shop->setIdShop($this->Session->read('id_shop'));
//        }
//        return $this->ShopDominio->getDominioPrincipal($this->Shop);
//    }


    /**
     * Verifica o status do passo de configuracao.
     */
    public function verificaPasso()
    {

        if ($this->Session->read('conta_auto_login')) {

            if ($this->Session->read('conta_auto_login') === true) {

                if ($this->Session->read('wizard_passo_config') == 1) {

                    $this->setMsgAlertError('Por favor, digite sua senha para acessar o painel de controle.');
                    return $this->redirect(Tools::urlPassoWizard(1));

                } else {

                    return $this->redirect(Tools::urlPassoWizard($this->Session->read('wizard_passo_config')));

                }

            }

        }

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }

        if ($this->Wizard instanceof Wizard) {

            $passo = $this->Wizard->passoWizard($this->Shop);

            if ($passo['Wizard']['passo'] >= '5') {

                $this->Session->write('passo_wizard_complete', true);
                $this->cookieViaLoja()->_setcookie('__vialoja_step', $passo['Wizard']['passo'], 60 * 60 * 24 * 365);

            } else {

                if ($passo['Wizard']['passo'] <= '4') {

                    if ($this->Session->read('passo_wizard') !== true) {
                        $this->Session->write('passo_wizard', true);
                    } else {
                        $this->setMsgAlertInfo('Por favor, informe as configurações básica de sua loja.');
                    }

                }

                return $this->redirect(Tools::urlPassoWizard($passo['Wizard']['passo']));

            }

        }

    }

    /**
     * Remove arquivos exportados para uso de email marketing
     */
    private function deleteExportacaoListaEmails()
    {

        $diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'exportados' . DS . 'newsletter' . DS;

        $date = strtotime('-1 day', time());
        foreach (glob($diretorio . '*.txt') as $file) {
            $filetime = filemtime($file);

            if ($date > $filetime) {
                //Deleta Arquivo antigo se existir
                Tools::deleteFile($file);
            }

        }

    }

}
