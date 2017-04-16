<style type="text/css">
    #globalContainer {padding:0;}
    td {white-space: nowrap;}
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('#pedidos-por-data').dataTable({
        "sDom": "<'row-fluid header-datatable'<'span5'l><'span7'f>r>t<'row-fluid'<'span4'i><'span8'p>>",
        "bPaginate": false,
        "aaSorting": [],
        "oLanguage": {
            "sProcessing":   "Processando...",
            "sLengthMenu":   "Mostrar _MENU_ registros",
            "sZeroRecords":  "Não foram encontrados resultados",
            "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
            "sInfoPostFix":  "",
            "sSearch":       "Buscar:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Seguinte",
                "sLast":     "Último"
            }
        }
    });
    });
</script>

<div class="box">
    <div class="box-header">
        <h3>
            Relatório de Vendas por data
        </h3>
    </div>
    <div class="box-content" style="overflow:auto;">
        <table cellpadding="0" cellspacing="0" border="0"  class="table table-bordered table-striped dataTable" id="pedidos-por-data">
            <thead>
                <tr>
                    <th>Dia</th>
                    <th>Pedidos</th>
                    <th>Pedidos finalizados</th>
                    <th>Subtotal finalizados (R$)</th>
                    <th>Envio finalizados (R$)</th>
                    <th>Descontos finalizados (R$)</th>
                    <th>Total finalizados (R$)</th>
                    <th>Pedidos não finalizados</th>
                    <th>Subtotal não finalizados (R$)</th>
                    <th>Envios não finalizados (R$)</th>
                    <th>Descontos não finalizados (R$)</th>
                    <th>Total não finalizados (R$)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>10/04/2014</td>
                    <td>1</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>1</td>
                    <td>1750,00</td>
                    <td>17,40</td>
                    <td>0</td>
                    <td>1767,40</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="box-footer"></div>
</div>
<form action="/admin/relatorio/vendas/por_data/baixar" method="POST">
    <button type="submit" class="btn btn-primary pull-right" >
    <input type="hidden" name='timedelta' value="7">
    <i class="icon-download icon-white"></i>
    Baixar dados
    </button>
    <input type='hidden' name='csrfmiddlewaretoken' value='5t0OutL51xGEFdPnAbOdLA7UEp1y8gBw' />
</form>