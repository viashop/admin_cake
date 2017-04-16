<!--
<div class="alert alert-success">
    <a class="close" data-dismiss="alert">×</a>
    <h4>A cobrança foi cancelada com sucesso. Caso este boleto seja pago o
sistema não identificará o pagamento automaticamente, caso tenha
alguma dúvida entre em contato conosco.</h4>
</div>

<div class="alert alert-success">
    <a class="close" data-dismiss="alert">×</a>
    <h4>O pagamento desta cobrança está sendo executado. Assim que ele for finalizado você receberá uma mensagem por email.</h4>
</div>

<div class="alert alert-error">
    <a class="close" data-dismiss="alert">×</a>
    <h4>Esta cobrança não pode ser paga.</h4>
</div>
-->

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/conta/uso"><i class="icon-charging icon-custom"></i> Meu plano</a> <span class="bread-separator">-</span></li>
        <li><span>Dados de fatura</span></li>
    </ul>
</div>

<?php
if (isset($verifica_cobranca)) {
    if ($verifica_cobranca == 'A_VENCER') {
        echo '<div class="alert alert-warning">
            <h3>
                Você tem uma cobrança que está próximo de vencer.
            </h3>
            <p>Verifique a lista de cobranças abaixo.</p>
        </div>';
    } else if ($verifica_cobranca == 'VENCIDO') {
        echo '<div class="alert alert-error">
            <h3>
                Você tem uma cobrança que está vencida, evite bloqueio de sua loja.
            </h3>
            <p>Verifique a lista de cobranças abaixo.</p>
        </div>';
    }
}

?>


<div class="row form-horizontal">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Dados de fatura</h3>
        </div>
        <div class="box-content dados-fatura">
            <div class="row-fluid">
                <div class="span6">
                    <h3>Forma de pagamento</h3>
                    <div class="info-box">
                        <span class="icone-container"><i class="icon-charging icon-big icon-white icon-custom"></i></span>
                        <p>
                            <strong>
                                <?php
                                if (isset($shop_conta['ShopConta']['forma_pagamento'])) {

                                    echo $this->requestAction(
                                        array(
                                            'controller'      => 'FormaPagamentoShop',
                                            'action'          => 'getFormaPagamentoId',
                                            'forma_pagamento' => $shop_conta['ShopConta']['forma_pagamento']
                                        )
                                    );

                                } else {
                                    echo 'Boleto bancário';
                                }
                                ?>
                            </strong>
                        </p>
                    </div>
                </div>
                <div class="span6">
                    <h3>Responsável pela loja</h3>
                    <div class="info-box">
                        <span class="icone-container"><i class="icon-users icon-big icon-white icon-custom"></i></span>

                        <?php
                        echo '<p>'. $shop['Shop']['loja_nome_responsavel'] .' &nbsp; <strong>&lt;'. $shop['Shop']['email'] .'&gt;</strong></p>';
                        ?>

                    </div>
                </div>
            </div>
            <hr />
            <div class="control-group">
                <h3>Histórico de faturas</h3>
                <div>
                    <table class="table table-bordered table-striped table-hover table-condensed table-cobrancas">
                        <thead>
                            <tr>
                                <th class="text-align-center">
                                    <span rel="tooltip" data-original-title="Identificador único da cobrança.">
                                    ID
                                    </span>
                                </th>
                                <th class="text-align-center">
                                    <span rel="tooltip" data-original-title="Número de referência para as formas de pagamento, as cobranças gratuitas não tem número de referência.">
                                    Referência
                                    </span>
                                </th>
                                <th>Período de validade ou<br>Data de compra</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Situação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($res_fatura as $key => $fatura):
                            ?>
                        	<tr>
                                <td class="text-align-center">
                                    <?php
                                    if ($fatura['ShopFatura']['situacao'] == '4') {
                                    ?>

                                        <span rel="tooltip" data-original-title="Aguardando."><i class="icon-time"></i>
                                        <?php echo $fatura['ShopFatura']['id_fatura'];?>
                                        </span>

                                    <?php
                                    } else if ($fatura['ShopFatura']['situacao'] == '5'
                                        && $fatura['ShopFatura']['id_plano'] == $shop['Shop']['id_plano'] ) {
                                    ?>

                                        <span rel="tooltip" data-original-title="Cobrança ativa."><i class="icon-ok"></i>
                                        <?php echo $fatura['ShopFatura']['id_fatura'];?>
                                        </span>

                                    <?php
                                    } else {
                                        echo $fatura['ShopFatura']['id_fatura'];
                                    ?>

                                    <?php } ?>

                                </td>
                                <td class="text-align-center">
                                    <?php

                                    if (isset($fatura['ShopFatura']['referencia'])
                                        && !empty($fatura['ShopFatura']['referencia'])) {
                                        echo $fatura['ShopFatura']['referencia'];
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo \Lib\Tools::formatToDate( $fatura['ShopFatura']['data_mes_inicial'] );
                                    ?>
                                    até
                                    <?php
                                    echo \Lib\Tools::formatToDate($fatura['ShopFatura']['data_mes_final']);
                                    ?>
                                </td>
                                <td>
                                    Plano <?php echo $fatura['ShopFatura']['id_plano'];?>
                                </td>
                                <td>
                                    R$ <?php echo \Lib\Tools::convertToDecimalBR($fatura['ShopFatura']['valor']);?>
                                </td>
                                <td>

                                    <?php
                                    echo $this->requestAction(
                                        array(
                                                'controller' => 'SituacaoFatura',
                                                'action' => 'getSituacaoId',
                                                'id' => $fatura['ShopFatura']['situacao']
                                        )
                                    );
                                    ?>

                                </td>
                                <td>

                                    <?php
                                    if ($fatura['ShopFatura']['situacao'] == '2') {

                                        echo sprintf('<a class="btn btn-small btn-primary" href="/admin/conta/pagar/%d">
                                            <i class="icon-barcode icon-white"></i>
                                            Efetuar pagamento
                                        </a>', $fatura['ShopFatura']['id_fatura']);

                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination pagination-sm no-margin pull-left" style="margin: 0">
                    <ul>
                        <?php
                            echo $this->Paginator->numbers( array( 'modulus' => '2', 'tag' => 'li', 'first'=>'Início', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a', 'last'=>'Último'  ) );
                        ?>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>
<?php
/*
<div id="retencao-imposto" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Retenção de IRRF</h3>
    </div>
    <div class="modal-body">
        <p>
            Será necessário recolher de Imposto de Renda Retido na Fonte (IRRF),
            de acordo com o Regulamento do Imposto de Renda (RIR/1999).
        </p>
        <p>
            Valor que deverá ser retido para este pagamento: <strong>R$ <span id="valor-irrf"></span></strong>.
        </p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal" >Ok</a>
    </div>
</div>
<!-- /Full width content box -->
*/ ?>