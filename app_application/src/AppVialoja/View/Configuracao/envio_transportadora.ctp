<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar"><i class="icon-road"></i> Formas de envio</a> <span class="bread-separator">-</span></li>
        <li><span>Configurar transportadora</span></li>
    </ul>
</div>
<div class="box">
    <div class="box-header">
        <h3>
            Forma de envio Transportadora
        </h3>
    </div>
    <form id="formulario_transportadora" action="<?php echo Router::url(); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal" >
        <div class="box-content">

            <div class="form-horizontal">
            <div class="row-fluid">
                <div class="span3">
                    <div class="thumbnail">
                        <img src="/admin/img/formas-de-envio/transportadora-logo.png" />
                    </div>
                </div>
                <div class="span7 text-align-left">
                    <h3>
                        TRANSPORTADORA
                    </h3>
                </div>
            </div>
            <hr />
            <div class="control-group">
                <label for="id_ativo" class="control-label">Ativado &nbsp;&nbsp;&nbsp;</label>
                <select class="input-small" id="id_ativo" name="ativo">
                     <option value="True" <?php if (!(strcmp("True", $envio_ativo))) { echo 'selected="selected"';} ?>>Sim</option>
                     <option value="False" <?php if (!(strcmp("False", $envio_ativo))) { echo 'selected="selected"';} ?>>Não</option>
                </select>
            </div>

            <div class="alert alert-info">
                <p>
                    O preenchimento de uma tabela de transportadora geralmente é trabalhoso e demorado, para facilitar, adotamos o método de preenchimento através de uma planilha Excel. Você deverá baixar nossa tabela modelo e preenche-la com os dados da sua transportadora.
                </p>
                <p>
                    Preencha a tabela atentamente e envie através do campo abaixo. Sempre que fazer o carregamento de uma tabela, a anterior será removida. Certifique-se de enviar a tabela completa.
                </p>
                <p>
                    <strong>
                        O campo AD Valorem não está sendo calculado. Campo de controle para o lojista.
                    </strong>
                </p>
            </div>

            </div>
            <div class="control-group">
                <div class="controls">
                    <a href="<?php echo VIALOJA_PAINEL ?>/arquivo/transportadora/tabela-modelo.xls" title="Baixar tabela modelo"><i class="icon-custom icon-file"></i> Baixar tabela modelo</a>
                </div>
            </div>
            <div class="control-group ">
                <label for="id_tabela" class="control-label">Tabela (Máx. 5 MB)</label>
                <div class="controls">
                    <input id="id_tabela" name="arquivo" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                </div>
            </div>
        </div>

        <?php
         if (isset($faixas) && count($faixas) > 0) {

           $link_apagar = true;

        ?>

        <div class="box-content">

            <hr/>
            <h5><i>Você já tem uma tabela enviada com <?php echo count($faixas); ?> faixas de CEP diferentes. Abaixo segue a primeira linha de cada faixa de CEP.</i></h5>
            <br />

            <table class="table table-generic-list">
                <thead>
                    <tr>
                        <th>Região</th>
                        <th>Faixa inicial</th>
                        <th>Faixa final</th>
                        <th>Peso inicial</th>
                        <th>Peso final</th>
                        <th>Valor</th>
                        <th>Prazo entrega</th>
                        <th>Kilograma adicional</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($faixas as $key => $faixa) {

                    $created = $faixa['ShopEnvioTransportadora']['created'];
                    $timestamp = strtotime($created);

                    ?>
                    <tr>
                        <td><?php echo $faixa['ShopEnvioTransportadora']['regiao']; ?></td>
                        <td><?php echo $faixa['ShopEnvioTransportadora']['cep_inicio']; ?></td>
                        <td><?php echo $faixa['ShopEnvioTransportadora']['cep_fim']; ?></td>
                        <td><?php echo \Lib\Tools::convertToDecimalBR( $faixa['ShopEnvioTransportadora']['peso_inicial'], 3); ?></td>
                        <td><?php echo \Lib\Tools::convertToDecimalBR( $faixa['ShopEnvioTransportadora']['peso_final'], 3); ?></td>
                        <td>R$ <?php echo \Lib\Tools::convertToDecimalBR($faixa['ShopEnvioTransportadora']['valor']); ?></td>
                        <td><?php

                        $prazo = $faixa['ShopEnvioTransportadora']['prazo_entrega'];

                        if ( $prazo <= 1) {
                            printf('%s dia', $prazo);
                        } else {
                            printf('%s dias', $prazo);
                        }; ?></td>
                        <td><?php

                        if (!empty($faixa['ShopEnvioTransportadora']['kg_adicional'])) {
                            echo 'R$ '. \Lib\Tools::convertToDecimalBR( $faixa['ShopEnvioTransportadora']['kg_adicional'] );
                        }


                        ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td colspan="7">Data da última atualização:
                            <strong rel='tooltip' data-original-title="<?php echo \Lib\Tools::formatToDate( $created ); ?>"><?php echo \Lib\FormatarTempo::formatar( $timestamp ); ?></strong></td>
                        <td colspan="3" class="text-right"><a href="<?php echo VIALOJA_PAINEL ?>/arquivo/transportadora/envio/<?php echo $id_envio ?>/exportar" class="pull-right"><i class="icon-custom icon-file"></i>Baixar sua tabela completa</a></td>
                    </tr>
                </tfoot>
            </table>

    </div>
    <?php
    }
    ?>

    <div class="form-actions text-right">
        <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
        <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />

        <?php
        if (isset($link_apagar)) {
          echo '<a href="#modalAviso" data-toggle="modal" class="btn btn-link">Apagar dados de envio desta transportadora</a>';
        }
        ?>
        <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar" class="btn">Cancelar</a>
        <input type="submit" class="btn btn-primary" id="processando" value="Salvar alterações" />
    </div>

    <div class="box-footer"></div>

</div>

<?php
if (isset($link_apagar)) {
?>

<!-- Modal -->
<div id="modalAviso" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalAvisoLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="modalAvisoLabel">Apagando dados da transportadora</h3>
  </div>
  <div class="modal-body">
    <p>Todas as regiões, CEPs e preço serão apagadas desta transportadora.
      <br /><br />
      Por precaução, faça um backup de sua planilha <a id="download" href="javascript:;">clicando aqui.</a></p>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Desisto, quero manter meus dados.</button>
    <a id="apagar" href="javascript:;" class="btn btn-danger">Quero apagar!</a>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#apagar').click(function(){
         window.location.href = '<?php echo VIALOJA_PAINEL ?>/arquivo/transportadora/envio/<?php echo $id_envio ?>/remover';
    });

    $('#download').click(function(){
       window.location.href = '<?php echo VIALOJA_PAINEL ?>/arquivo/transportadora/envio/<?php echo $id_envio ?>/exportar';
    });
})
</script>

<?php
}
?>
