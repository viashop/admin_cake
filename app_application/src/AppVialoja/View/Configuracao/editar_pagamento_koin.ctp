 <!-- .navbar -->
            <div id="loadingDiv" style="display: none;">carregando...</div>
            <div class="body container">
                <div id="mainContent">
                    <div class="bread-container">
                        <ul class="breadcrumb">
                            <li><a href="/painel"><i class="icon-custom icon-engine hidden-xs"></i> Painel</a> <span class="bread-separator">-</span></li>
                            <li><a href="<?php echo VIALOJA_PAINEL ?>/plataforma/conta/dados/editar"><i class="icon-briefcase hidden-xs"></i> Minha loja</a> <span class="bread-separator">-</span></li>
                            <li><a href="<?php echo VIALOJA_PAINEL ?>/plataforma/conta/configuracao/editar"><i class="icon-custom icon-tools hidden-xs"></i> Configurações</a> <span class="bread-separator">-</span></li>
                            <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar"><i class="icon-custom icon-dollar hidden-xs"></i> Forma de pagamento</a> <span class="bread-separator">-</span></li>
                            <li><span>Configurando formas de pagamento</span></li>
                        </ul>
                    </div>
                    <div id="erroTecnico">
                    </div>
                    <form class="form-horizontal" action="<?php echo Router::url(); ?>" method="post" id="formPagamentoEditar">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="pull-left">Configurações</h3>
                            </div>
                            <div class="box-content">
                                <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <img src="//cdn.awsli.com.br/production/static/painel/img/formas-de-pagamento/koin-logo.png" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-7 col-sm-offset-3">
                                        <p>A <a href="http://www.koin.com.br" target="_blank">Koin</a> é um novo modelo de negócio para suas vendas online.</p>
                                        <p>Proporcione ao seu cliente a experiência do pós-pago. Ofereça o benefício de pagar pelo pedido só depois de receber!</p>
                                        <p>Vendas sem o risco da inadimplência e fraude, a Koin assume todos os riscos.</p>
                                        <p>Para credenciar sua loja, <a href="http://www.koin.com.br/home/integracao" target="_blank">clique aqui</a>.</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Pagamento ativo?</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="id_ativo" name="ativo">
                                            <option value="True">Sim</option>
                                            <option value="False" selected="selected">Não</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="convite-cadastro">
                                    Envie dados para credenciar sua loja junto à Koin.<br/>
                                    <a href="http://www.koin.com.br/home/integracao" title="Acessar Site da Koin" class="btn btn-info btn-xs" target="_blank">Acesse</a>
                                </div>
                                <div id="forma-pagamento-corpo">
                                    <div class="form-group   token">
                                        <label class="control-label col-sm-3" for="id_token">Consumer Key</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="id_token" name="token" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group   senha">
                                        <label class="control-label col-sm-3" for="id_senha">Secret Key</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="id_senha" name="senha" type="text" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="btn-group-md text-right">
                <input type='hidden' name='csrfmiddlewaretoken' value='LjreeFW9unfs5t7LkiRhQsVm8f0hfg84' />
                <a href="https://admin.vialoja.com.br/painel/configuracao/pagamento/listar" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
                <button type="submit" class="btn btn-primary btn-save"><span class="glyphicon glyphicon-ok"></span> Salvar alterações</button>
                </div>
                <div id="saveButton">
                <div class="container">
                <div class="button-container">
                <button type="submit" class="btn btn-save btn-primary"><i class="glyphicon glyphicon-ok"></i> Salvar alterações</button>
                </div>
                </div>
                </div>
            </div>
        </div>
        </form>
        </div>
        </div>
        </div>