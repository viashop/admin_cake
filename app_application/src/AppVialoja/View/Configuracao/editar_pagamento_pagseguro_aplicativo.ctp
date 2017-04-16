<style type="text/css">
<!--
input[type="checkbox"]{
    margin-top: -5px !important;
}

.help-block {
    margin-top: -8px !important;
}

.facil_paypal{
    margin-left: 180px;
}
-->
</style>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar"><i class="icon-custom icon-dollar"></i> Formas de pagamento</a> <span class="bread-separator">-</span></li>
        <li><span>Configurando formas de pagamento</span></li>
    </ul>
</div>
<div class="row config-pagamento-editar">
    <form class="form-horizontal" action="<?php echo Router::url(); ?>" method="post" id="formPagamentoEditar">
        <div class="box">
            <div class="box-header">
                <h3 class="pull-left">Forma de pagamento PagSeguro</h3>
            </div>
            <div class="box-content">
                <div class="control-group">
                    <div class="controls">
                        <img src="/admin/img/formas-de-pagamento/pagseguro-logo.png" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Pagamento ativo?</label>
                    <div class="controls">
                        <select class="input-small" id="id_ativo" name="ativo">
                            <option value="True">Sim</option>
                            <option value="False" selected="selected">Não</option>
                        </select>
                    </div>
                </div>
                <div class="convite-cadastro">
                    Ainda não tem conta no PagSeguro?<br/>
                    <a href="//pagseguro.uol.com.br/" title="Criar conta PagSeguro" class="btn btn-info btn-mini" target="_blank">cadastre-se</a>
                </div>
                <div id="forma-pagamento-corpo" class="">
                    <div class="control-group" style="margin-bottom: 0">
                        <div class="controls">
                            <div class="alert alert-danger">
                                <p>
                                    Se você não estiver conseguindo instalar a aplicação, por favor clique no botão abaixo, remova a aplicação e depois tente novamente.
                                </p>
                                <p>
                                    <a target="_blank" href="https://pagseguro.uol.com.br/aplicacao/listarAutorizacoes.jhtml" class="btn btn-danger">
                                    <i class="icon-trash icon-white"></i>
                                    Remover aplicação
                                    </a>
                                </p>
                            </div>
                            <div class="alert alert-error alert-block" id="">
                                <h4>O aplicativo do PagSeguro ainda não está instalado</h4>
                                <p>Para você conseguir efetuar vendas através do PagSeguro, instale o aplicativo clicando no botão abaixo.</p>
                                <p><a class="btn btn-primary" href="/admin/configuracao/pagamento/pagseguro/aplicacao/instalar"><i class="icon-ok icon-white"></i> Instalar aplicativo do PagSeguro</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"></div>
                        <div class="controls">
                            <div class="alert alert-info alert-block">
                                <h4>Siga atentamente nossas instruções para que o pagamento funcione corretamente.</h4>
                                <ol>
                                    <li>Clique no botão <strong>Instalar aplicativo do PagSeguro</strong> nesta página.</li>
                                    <li>Entre em sua conta no <a href="//pagseguro.uol.com.br/acesso.jhtml" title="Login no PagSeguro" target="_blank">PagSeguro</a>;</li>
                                    <li>Tenha uma conta no PagSeguro do tipo <b>Conta Vendedor</b> para prosseguir. <a href="//pagseguro.uol.com.br/account/viewDetails.jhtml" target="_blank">Clique aqui</a> para fazer esta mudança caso sua conta não seja deste tipo;</li>
                                    <li>Entre no menu <b>Preferências -> Frete</b> e depois marque a opção <strong>Frete adicional com valor fixo</strong> e coloque o valor de <strong>R$ 0,00 reais</strong> e clique em <strong>CONFIRMAR</strong> no final da página</strong>.</li>
                                </ol>
                                <p style="margin-left:28px;">
                                    <small style="line-height:1.2em;">
                                    * A integração com o PagSeguro gera custos de operação que são repassados para a Loja Integrada pelo PagSeguro (0,5%). Porém isso não altera o valor da taxa cobrada às lojas pelo PagSeguro pelas transações, 4,79%.
                                    </small>
                                </p>
                                <br />
                                <div>
                                    <label class="checkbox">
                                    <input id="id_li_msg" name="li_msg" type="checkbox" />Li e segui todos os passos.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
                <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
                <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
            </div>
        </div>
    </form>
</div>
