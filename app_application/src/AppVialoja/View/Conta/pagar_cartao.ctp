<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/conta/dados/editar"><i class="icon-briefcase"></i> Minha loja</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/conta/uso"><i class="icon-charging icon-custom"></i> Meu plano</a> <span class="bread-separator">-</span></li>
        <li><span>Pagar uma cobrança</span></li>
    </ul>
</div>
<div class="row">
    <form action="<?php echo Router::url(); ?>" method="post">
        <div class="box">
            <div class="box-header">
                <h3>Pagar cobrança</h3>
            </div>
            <div class="box-content">
                <div class="row-fluid">
                    <div class="span9">
                        <p>
                            Identificador único da cobrança: <strong>566167</strong><br/>
                            Número de referência da cobrança: <strong>103212</strong>
                        </p>
                    </div>
                    <div class="span3">
                        <p class="text-align-right">
                            <small style="line-height: 1.2em;">
                            Caso queira cancelar esta cobrança <br/>
                            para emitir outra, use o botão abaixo:
                            </small>
                            <a style="margin-top: 10px" href="/admin/cobranca/566167/cancelar" class="btn btn-small btn-danger"><i class="icon-white icon-remove"></i> Cancelar cobrança</a>
                        </p>
                    </div>
                </div>
                <hr/>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="30%"><small>Descrição</small></th>
                            <th><small>Data de referência</small></th>
                            <th><small>Processamento</small></th>
                            <th class="text-align-right"><small>Desconto</small></th>
                            <th class="text-align-right"><small>Valor</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Plano Plano 2</td>
                            <td>de 01/07/2014 até 31/07/2014</td>
                            <td>01/07/2014</td>
                            <td class="text-align-right">-</td>
                            <td class="text-align-right">R$ 29,00</td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="pull-right" style="margin-top: -20px">
                    <small>Valor total:</small> R$ 29,00
                </h3>
                <div class="clear"></div>
                <hr/>
                <div>
                    <h4 style="margin-bottom: 10px;">Este valor será pago via cartão de crédito</h4>
                    <p>
                        Cartão de crédito que será usado para pagamento:<br/>
                        <img src="/admin/img/cartoes-de-credito/diners_club.png" />
                        <strong>DINERS_CLUB</strong> com final 3011-******-3331
                    </p>
                    <input type="hidden" name="cartao_credito_id" value="3056" />
                    <div class="actions" style="margin-top: 10px;">
                        <input type='hidden' name='csrfmiddlewaretoken' value='ZAzj04tJMmjaQxwEhUkqdR4KRLpFZ3fk' />
                        <button type="submit" class="btn btn-primary btn-big"><i class="icon icon-white icon-ok"></i> Efetuar pagamento</button>
                        <a href="<?php echo VIALOJA_PAINEL ?>/cobranca" class="btn"><i class="icon-remove"></i> Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /Full width content box -->
    <div class="box">
        <div class="box-header">
            <h3>Histórico de transações</h3>
        </div>
        <div class="box-content">
            <div class="alert alert-error">
                <h4>Não conseguimos efetuar o pagamento com o seu cartão de crédito</h4>
                <p>
                    Serão executadas outras 2 tentativas de cobrança em seu cartão de crédito. Entre em contato com sua operadora de cartão de crédito para verificar qual foi o erro apresentado. Caso queira, você também pode trocar de cartão <a href="<?php echo VIALOJA_PAINEL ?>/conta/editar">clicando aqui</a>.
                </p>
                <p>
                    <strong>A próxima tentativa será realizada em 6 horas, 35 minutos.</strong>
                </p>
            </div>
            <h4>Foi feita 1 transação para esta cobrança</h4>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Data e hora</th>
                        <th>Final do cartão de crédito</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td>8471</td>
                        <td>01/07/2014 17:17</td>
                        <td>3331</td>
                        <td>Não autorizada</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>