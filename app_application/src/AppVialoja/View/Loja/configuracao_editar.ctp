<style>
    .form-horizontal .control-group.mini { margin-bottom: 5px; }
    .form-horizontal .control-group.dominio { margin-bottom: 10px; }
    .form-horizontal .dominio-adicional .controls { margin-left: 200px; }
    .form-horizontal input[name=subdominio] { -webkit-border-radius: 0 0 0 0; -moz-border-radius: 0 0 0 0; border-radius: 0 0 0 0; border-right: 0; }
    #listaDominios { margin-left: 0; }
    #listaDominios li { padding: 10px 0; border-bottom: 1px solid #EEE; }
    /*#listaDominios li span.label { float: right; }*/
    .definir-outro-subdominio input[name=definir_outro_subdominio] {
        margin-top: -5px;

    }

    .verifica-apelido{
        margin-left: 10px;
        display: block;
        float:right;
    }

    @-moz-document url-prefix() { 
      .verifica-apelido {
        margin-top: -30px;
        margin-left: 10px;
        display: block;
        float:right;
      }
    }

    input[name=comentarios_produtos] {
        margin-top: -5px;
    }

    input[name=preferencia_url_dominio] {
        margin-top: -5px;
    }



</style>
<script type="text/javascript">
    $(document).ready(function () {
    
        $('a[data-toggle="tooltip"]').tooltip();
    
        // $("[name=tipo_listagem]").change(function () {
        //     if ($('[name=tipo_listagem]:checked').val() == 'alfabetica') {
        //         // desabilitar = '#id_quantidade_ultimos_produtos, [name=quantidade_destaque]';
        //         desabilitar = '[name=quantidade_destaque]:first, [name=quantidade_destaque]:last';
        //         habilitar = '';
        //     } else if ($('[name=tipo_listagem]:checked').val() == 'destaque') {
        //         habilitar = '[name=quantidade_destaque]:last';
        //         desabilitar = '[name=quantidade_destaque]:first';
        //         // desabilitar = '#id_quantidade_ultimos_produtos';
        //     } else if ($('[name=tipo_listagem]:checked').val() == 'ultimos_produtos') {
        //         habilitar = '[name=quantidade_destaque]:first';
        //         desabilitar = '[name=quantidade_destaque]:last';
        //         // habilitar = '#id_quantidade_ultimos_produtos';
        //     } else {
        //         habilitar = '';
        //         desabilitar = '';
        //     }
        //     $(habilitar).removeAttr('disabled').parent().removeClass('muted').css('opacity', '1');
        //     $(desabilitar).attr('disabled', 'disabled').parent().addClass('muted').css('opacity', '0.5');
        // }).change();
    
        if(/dominio/.test(document.location.hash) && $('#dominio').length) {
          $('html, body').animate({
            scrollTop: $("#dominio").offset().top - 100
          }, 600);
    
          $('#dominio').css({
            backgroundColor: '#fcf8e3',
            padding: '10'
          });
        }
    
        $('[name=definir_outro_subdominio]').change(function () {
            if($(this).is(':checked')) {
                $('.dominio .input-prepend .add-on .www').hide();
                $('.dominio .campo-subdominio').css({'display': 'inline-block'});
                $('#id_subdominio').focus();
            } else {
                $('.dominio .input-prepend .add-on .www').show();
                $('.dominio .campo-subdominio').css({'display': 'none'});
                $('#id_dominio').focus();
                $('[name=subdominio]').val('');
            }
        });
    
        $('.adicionar_dominio_alternativo').click(function () {
            $('.dominio-adicional').toggle();
        });
    
        $('#id_dominio').keyup(function () {
            if($('#id_dominio').val().length > 2) {
                $('.alert-configuracao-dominio').slideDown();
            } else {
                $('.alert-configuracao-dominio').slideUp();
            }
        });

    
        $('#adicionarDominio, #adicionarDominioPrincipal').click(function () {

            var dominio = $('[name=dominio_adicional]').val();
            dominio_adicional = true;
            dominio_inicial_confirme = 'false';
            if (dominio == undefined) {
                var dominio = $('[name=dominio]').val();
                var subdominio = $('[name=subdominio]').val();
                if (subdominio) {
                    dominio = subdominio + '.' + dominio;
                } else {
                    /*
                    * dominio = 'www.' + dominio;
                    */
                }
                dominio_inicial_confirme = 'true';

                dominio_adicional = false;
            }
    
            if (!dominio_adicional) {

                var leu_instrucoes = $('[name=li_passos]').is(':checked');
                if (!leu_instrucoes) {
                    msg = 'Para adicionar um domínio na sua conta você deve ler e marcar que leu as instruções para ativação do domínio.';
                    show_modal_error(msg);
                    $('.alert-configuracao-dominio .alert').removeClass('alert-warning').addClass('alert-error');
                    $('.control-group.dominio').addClass('error');
                    return false;
                }
            }
    
            if (!validar_dominio(dominio)) {
                msg = 'O domínio que você tentou adicionar não é válido. Por favor corrija o domínio e tente novamente.';
                show_modal_error(msg)
            } else {

                
                msg = 'Adicionando o domínio alternativo na sua loja...';
                $.loader(msg, true)

                if (!dominio_adicional) {
                    setTimeout(function () {
                        location.reload()
                    }, 7000);
                }
              
                $.post('/admin/loja/dominio/adicionar', {dominio: dominio, dominio_inicial_confirme: dominio_inicial_confirme }, function(data) {

                    $.removeLoader();
                    if (data.status == 'ERRO') {
                        show_modal_error(data.mensagem);
                    } else {

                        if (!dominio_adicional) {
                            return false;
                        }
    
                        $('.lista-dominios-alternativos').show();
    
                        link_remover = $('<a>').attr('href', data.url_remover).addClass('btn btn-small').html('<i class="icon-trash"></i>&nbsp;');
                        link_definir_principal = $('<a>').attr('href', data.url_definir_principal).html('Definir como principal');
                        opcoes_adicionais = $('<div class="pull-right">').append(link_definir_principal).append(' &nbsp; ').append(link_remover);
    
                        $('#listaDominios').append($('<li>').html(dominio).append(opcoes_adicionais));
                        show_modal_success(data.mensagem);
                    }
    
                }, 'JSON');
            }
    
            return false
        });
    
        $('[name=dominio_adicional]').typeahead({
            items: 6,
            source: function (query) {
                // retira os espacos em brancos.
                if (/\s/.test(query)) {
                    $('[name=dominio_adicional]').val($('[name=dominio_adicional]').val().replace(/\s/, ""));
                }
                // nao faz nenhum sugestao quando o ja completar o dominio
                if (/(\.[a-z]*)$/.test(query)) {
                    return [];
                }
    
                var sufixDomains = [".com.br", ".com", ".net", '.net.br' ];
                var domains = [];
    
                for (i = 0; i<sufixDomains.length; i++) {
                    domains.push(query + sufixDomains[i]);
                }
    
                return domains;
            }
        });
    });
</script>
    
<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/dados/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><span>Configurações da loja</span></li>
    </ul>
</div>

<form action="<?php echo Router::url(); ?>" method="post" class="form-horizontal">
    <div class="row painel-loja painel-loja-configuracao">
        <div class="box">
            <div class="box-header">
                <h3>Configurações da loja</h3>
                <?php
                /*
                <h3 class="chave-api pull-right box-widget">Chave API: 2a50da61-0331-477f-ad7d-2efd58f7ecb3</h3>
                */

                ?>
                
            </div>
            <div class="box-content">
                <div class="control-group ">
                    <label class="control-label" for="id_manutencao">Loja em manutenção</label>
                    <div class="controls">
                        <div class="help-block">Substitui sua loja por uma página indicando que a mesma está em manutenção</div>
                        <select class="input-small" id="id_manutencao" name="manutencao">
                            <option value="True" <?php if (!(strcmp("True", $config['Shop']['manutencao']))) {echo 'selected="selected"';} ?>>Sim</option>
                            <option value="False" <?php if (!(strcmp("False", $config['Shop']['manutencao']))) {echo 'selected="selected"';} ?>>Não</option>
                        </select>
                    </div>
                </div>
                <hr/>

                <?php /* ?>                    
                

                <div class="control-group ">
                    <label class="control-label" for="id_habilitar_mobile">Versão mobile?</label>
                    <div class="controls">
                        <div class="help-block">Ativa a versão mobile para a loja</div>
                        <select class="input-small" id="id_habilitar_mobile" name="habilitar_mobile">
                            <option value="True" <?php if (!(strcmp("True", $config['Shop']['habilitar_mobile']))) {echo 'selected="selected"';} ?>>Sim</option>
                            <option value="False" <?php if (!(strcmp("False", $config['Shop']['habilitar_mobile']))) {echo 'selected="selected"';} ?>>Não</option>
                        </select>
                    </div>
                </div>
                <hr/>

                <?php */ ?>

                <div class="control-group">
                    <label for="id_modo" class="control-label">Usarei minha loja</label>
                    <div class="controls">
                        <select class="input-xxlarge" id="id_modo" name="modo">
                            <option value="loja" <?php if (!(strcmp("loja", $config['Shop']['modo']))) {echo 'selected="selected"';} ?>>Para venda de produtos</option>
                            <option value="catalogo_sem_preco" <?php if (!(strcmp("catalogo_sem_preco", $config['Shop']['modo']))) {echo 'selected="selected"';} ?>>Como um catálogo sem apresentar o preço dos produtos</option>
                            <option value="catalogo_com_preco" <?php if (!(strcmp("catalogo_com_preco", $config['Shop']['modo']))) {echo 'selected="selected"';} ?>>Como um catálogo, apresentando o preço dos produtos</option>
                            <option value="orcamento_com_preco" <?php if (!(strcmp("orcamento_com_preco", $config['Shop']['modo']))) {echo 'selected="selected"';} ?>>Como um catálogo com preço para solicitação de orçamento</option>
                            <option value="orcamento_sem_preco" <?php if (!(strcmp("orcamento_sem_preco", $config['Shop']['modo']))) {echo 'selected="selected"';} ?>>Como um catálogo sem preço para solicitação de orçamento</option>
                        </select>
                    </div>
                </div>
                <hr/>
                <div class="control-group ">
                    <label class="control-label" for="id_apelido">Subdomínio</label>
                    <div class="controls">
                        <div class="help-block">
                            <div class="alert alert-info">A URL da sua loja tem duas partes: um nome de subdomínio, escolhido
                                quando você configurou sua conta, seguido do domínio padrão. Você
                                pode mudar o nome do subdomínio na hora que quiser, mas fazer isso
                                pode ter consequências para o SEO de sua loja. Antes de prosseguir, <a href="http://vialoja.com.br/comunidade/hc/pt-br/articles/200383424" title="Suporte" target="_blank"><b>leia esse artigo</b></a> de suporte.
                            </div>
                        </div>
                        <div class="input-append">
                            <input class="span3" id="id_apelido" maxlength="32" name="dominio_apelido" type="text" />
                            <span class="add-on">.vialoja.com.br</span>  
                            <span><div class="verifica-apelido"><span id="apelido-result"></span></span>
                        </div>
                    </div>
                </div>
                <hr/>

                <a name="dominio-proprio"></a>
                <?php

                foreach ($result_dominio as $key => $verifica);

                if (isset($verifica['ShopDominio']['subdominio_plataforma']) 
                    && $verifica['ShopDominio']['subdominio_plataforma'] === 'False'):

                ?>
       
                <div id="dominio">
                    <div class="control-group  dominio mini">
                        <label class="control-label" for="id_dominio">Domínio próprio</label>
                        <div class="controls">
                            <div class="help-block">
                                <div class="alert alert-info">
                                    A configuração do domínio próprio é um processo que exige que você
                                    lojista tenha que se aventurar em campo técnico.
                                    Antes de iniciar, <a href="//suporte.lojaintegrada.com.br/hc/pt-br/articles/200383174" target="_blank"><b>leia nossas instruções</b></a>. Quando estiver pronto, preencha abaixo o campo com seu domínio seguindo cuidadosamente as intruções contidas no link anterior.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="control-group  lista-dominios-alternativos mini">
                        <div class="controls">
                            <div class="help-block">Domínios configurados</div>
                            <ul id="listaDominios">
                                <?php
                                foreach ($result_dominio as $key => $dominio):

                                if($key <= 0){

                                    $dominio_principal = $dominio['ShopDominio']['dominio'];
                                ?>
                                <li class="principal">
                                    <strong>
                                    <?php echo $dominio['ShopDominio']['dominio']; ?>
                                    </strong>
                                    <div class="pull-right">
                                        <span class="label label-success"><i class="icon-star icon-white"></i> Domínio principal</span>
                                    </div>
                                </li>

                                <?php
                                } else {
                                ?>
                                <li class="">
                                    <?php echo $dominio['ShopDominio']['dominio']; ?>
                                    <div class="pull-right">
                                        <a href="<?php echo VIALOJA_PAINEL ?>/loja/configuracao/dominio/principal/<?php echo $dominio['ShopDominio']['id_dominio']; ?>">Definir como principal</a>
                                        &nbsp;
                                        <a href="<?php echo VIALOJA_PAINEL ?>/loja/configuracao/dominio/remover/<?php echo $dominio['ShopDominio']['id_dominio']; ?>" class="btn btn-small"><i class="icon-trash"></i>&nbsp;</a>
                                    </div>
                                </li>
                                <?php
                                }

                                endforeach;
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="control-group adicionar-dominio-alternativo mini">
                        <div class="controls">
                            <button type="button" class="adicionar_dominio_alternativo btn btn-small"><i class="icon-plus"></i> Adicionar domínio alternativo</button>
                            <div class="help-block">Adicione mais domínios alternativos. Ex.: sualoja.com</div>
                        </div>
                    </div>
                    <div class="control-group dominio-adicional hide">
                        <div class="controls">
                            <input type="text" name="dominio_adicional"/>
                            <a href="#" class="btn btn-primary" id="adicionarDominio">Adicionar</a>
                        </div>
                    </div>
                    <div class="control-group alert-configuracao-dominio hide">
                        <div class="controls alert alert-warning" style="margin-bottom: 0;">
                            <label class="checkbox">
                            <input type="checkbox" name="li_passos" />
                            Li as instruções e estou ciente de meu domínio e meus e-mails podem  não funcionar caso não tenha seguido
                            <a href="//lojaintegrada.zendesk.com/entries/22630547" title="Configurações para dominio" target="_blank">as instruções</a> e que esta alteração pode demorar algumas horas para começar a funcionar.
                            </label>
                        </div>
                    </div>
                </div>
     
                <?php
                else :
                ?>

                <div id="dominio">
                    <div class="control-group  dominio mini">
                        <label class="control-label" for="id_dominio">Domínio próprio</label>
                        <div class="controls">
                            <div class="help-block">
                                <div class="alert alert-info">
                                    A configuração do domínio próprio é um processo que exige que você
                                    lojista tenha que se aventurar em campo técnico.
                                    Antes de iniciar, <a href="http://vialoja.com.br/comunidade/hc/pt-br/articles/200383174" target="_blank"><b>leia nossas instruções</b></a>. Quando estiver pronto, preencha abaixo o campo com seu domínio seguindo cuidadosamente as intruções contidas no link anterior.
                                </div>
                            </div>
                            <div class="input-prepend input">
                                <span class="add-on">http://<span class="www">www.</span></span>
                                <div class="campo-subdominio hide"><input class="input-mini" id="id_subdominio" name="subdominio" type="text" /><span class="add-on">.</span></div>
                                <input autocomplete="off" class="span4" id="id_dominio" maxlength="128" name="dominio" type="text" />
                            </div>


                        </div>
                    </div>
                    <div class="control-group mini">
                        <div class="controls definir-outro-subdominio">
                            <label class="checkbox">
                            <input type="checkbox" name="definir_outro_subdominio" id="definir_outro_subdominio"/>
                            Desejo definir um outro nome para o subdomínio. 
                            </label>
                        </div>
                    </div>
                    <div class="control-group alert-configuracao-dominio hide">
                        <div class="controls alert alert-warning" style="margin-bottom: 0;">
                            <label class="checkbox">
                            <input type="checkbox" name="li_passos" />
                            Li as instruções e estou ciente de meu domínio e meus e-mails podem  não funcionar caso não tenha seguido
                            <a href="//vialoja.zendesk.com/entries/22630547" title="Configurações para dominio" target="_blank">as instruções</a> e que esta alteração pode demorar algumas horas para começar a funcionar.
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <a href="#" class="btn btn-primary" id="adicionarDominioPrincipal">Adicionar domínio</a>
                        </div>
                    </div>
                </div>

                <?php
                endif;

                if (isset($dominio_principal) && !empty($dominio_principal)) {

                ?>
                
                <hr/>
                <div class="control-group">
                    <label for="preferencia_url_dominio" class="control-label">Domínio de sua preferência</label>
                    <div class="controls ">
                        <label class="radio">
                            <input <?php if (!(strcmp("undefined", $config['Shop']['preferencia_url_dominio']))) {echo 'checked="checked" ';} ?> name="preferencia_url_dominio" type="radio" value="undefined" />  Não definir um domínio de sua preferência</label>

                        <label class="radio">
                            <input <?php if (!(strcmp("on_www", $config['Shop']['preferencia_url_dominio']))) {echo 'checked="checked" ';} ?> name="preferencia_url_dominio" type="radio" value="on_www" /> Exibir URLs como <strong>www.<?php echo $dominio_principal; ?></strong></label>
                        <label class="radio">
                            <input <?php if (!(strcmp("off_www", $config['Shop']['preferencia_url_dominio']))) {echo 'checked="checked" ';} ?> name="preferencia_url_dominio" type="radio" value="off_www" />  Exibir URLs como <strong><?php echo $dominio_principal; ?></strong>
</label>
                    </div>
                </div>
                <?php
                }
                ?>

                <hr/>
                <div class="control-group ">
                    <label class="control-label" for="id_numero_minimo_pedido">Numeração dos pedidos</label>
                    <div class="controls">
                        <span class="help-block">
                        Caso sua loja já tenha números de pedidos registrados anteriormente, configure aqui qual será o número do próximo pedido.
                        Você também pode modificar o número inicial do pedido caso não queira iniciar com uma numeração muito baixa.
                        </span>
                        <p>
                            O próximo número de pedido da sua loja será: <strong><?php echo $config['Shop']['numero_pedido']+1; ?></strong>
                        </p>
                        <p>
                            Mudar para &nbsp; 
                            
                            <select class="input-medium" id="id_numero_minimo_pedido" name="numero_minimo_pedido">
                                <option value="" selected="selected">- Não alterar</option>
                                <option value="99">100</option>
                                <option value="249">250</option>
                                <option value="499">500</option>
                                <option value="999">1000</option>
                                <option value="1499">1500</option>
                                <option value="4999">5000</option>
                                <option value="9999">10000</option>
                                <option value="14999">15000</option>
                                <option value="19999">20000</option>
                                <option value="29999">30000</option>
                                <option value="39999">40000</option>
                                <option value="49999">50000</option>
                                <option value="59999">60000</option>
                                <option value="69999">70000</option>
                                <option value="79999">80000</option>
                                <option value="89999">90000</option>
                                <option value="99999">100000</option>
                            </select>
                        </p>
                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="id_pedido_valor_minimo">Valor mínimo do pedido</label>
                    <div class="controls">
                        <span class="help-block">Ao definir um valor mínimo, o seu cliente não poderá finalizar nenhum pedido com o valor menor que o definido. Caso não queira limitar o valor mínimo, deixe o campo em branco.</span>
                        <div class="input-prepend">
                            <span class="add-on">R$</span>
                            <input class="input-small" id="id_pedido_valor_minimo" name="pedido_valor_minimo" type="text" value="<?php 

                            if (isset($config['Shop']['pedido_valor_minimo'])) {
                                echo \Lib\Tools::convertToDecimalBR($config['Shop']['pedido_valor_minimo']);
                            }
                            ?>" />
                        </div>
                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="id_valor_produto_restrito">Valor do produto restrito</label>
                    <div class="controls">
                        <div class="help-block">Exibir o valor dos produtos apenas para usuários logados na loja.</div>
                        <select class="input-small" id="id_valor_produto_restrito" name="valor_produto_restrito">
                            <option value="False" <?php if (!(strcmp("False", $config['Shop']['valor_produto_restrito']))) {echo 'selected="selected"';} ?>>Não</option>
                            <option value="True" <?php if (!(strcmp("True", $config['Shop']['valor_produto_restrito']))) {echo 'selected="selected"';} ?>>Sim</option>
                        </select>
                    </div>
                </div>
                <hr/>

                <?php /* ?>     
                <div class="control-group ">
                    <label class="control-label" for="id_gerenciar_cliente">Gerenciar cadastro de clientes?</label>
                    <div class="controls">
                        <div class="help-block">O cliente irá precisar de uma aprovação posterior para completar o cadastro na loja.</div>
                        <select class="input-xlarge" id="id_gerenciar_cliente" name="gerenciar_cliente">
                            <option value="False" <?php if (!(strcmp("False", $config['Shop']['gerenciar_cliente']))) {echo 'selected="selected"';} ?>>Não gerenciar cadastro de clientes</option>
                            <option value="True" <?php if (!(strcmp("True", $config['Shop']['gerenciar_cliente']))) {echo 'selected="selected"';} ?>>Gerenciar cadastro de clientes</option>
                        </select>
                    </div>
                </div>
                <hr/>
                <?php */ ?>   


                <div class="control-group">
                    <label for="id_comentarios_produtos" class="control-label">Comentários dos produtos</label>
                    <div class="controls">
                        <div class="help-block">Opção para o cliente fazer comentários dentro da página do produto.</div>
                        <label class="radio">
                            <input <?php if (!(strcmp("False", $config['Shop']['comentarios_produtos']))) {echo 'checked="checked" ';} ?> name="comentarios_produtos" type="radio" value="False" /> Não permitir comentários em seus produtos</label>
                        <label class="radio">
                            <input <?php if (!(strcmp("True", $config['Shop']['comentarios_produtos']))) {echo 'checked="checked" ';} ?> name="comentarios_produtos" type="radio" value="True" /> Sistema de comentários do Facebook</label>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
                <button type="submit" id="processando" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar Alterações</button>
                <a href="<?php echo VIALOJA_PAINEL ?>/conta" class="btn"><i class="icon-remove"></i> Cancelar</a>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3>Outros recursos</h3>
        </div>
        <div class="box-content row config-outros-recursos">
            <div>
                <?php /* ?>
                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/exportar" class="btn"><i class="icon-list"></i> Exportar dados</a>
                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/token/listar" class="btn"><i class="icon-tag"></i> Tokens</a>
                 <?php */ ?>
                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/galeria/listar" class="btn"><i class="icon-image icon-custom"></i> Gerenciar meus arquivos</a>
            </div>
        </div>
    </div>
</div>


<div id="loading" class="modal hide">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h3 class="loading-text">Carregando...</h3>
        <img src="/admin/img/ajax-loader.gif" alt="Loading" />
      </div>
    </div>
  </div>
</div>

<div id="modal-error" class="modal hide">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="error-text"></h3>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Fechar</a>
      </div>
    </div>
  </div>
</div>

<div id="modal-success" class="modal hide">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="success-text"></h3>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Fechar</a>
      </div>
    </div>
  </div>
</div>
