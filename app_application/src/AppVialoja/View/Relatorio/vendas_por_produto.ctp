<style type="text/css">
            #globalContainer {padding:0;}
            td {white-space: nowrap;}
        </style>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#pedidos-por-produtos').dataTable({
                "sDom": "<'row-fluid header-datatable'<'span5'l><'span7'f>r>t<'row-fluid'<'span4'i><'span8'p>>",
                "aaSorting": [],
                "bPaginate": false,
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
            Relatório de Vendas por produto
        </h3>
    </div>
    <div class="box-content" style="overflow:auto;">
        <table cellpadding="0" cellspacing="0" border="0"  class="table table-bordered table-striped dataTable" id="pedidos-por-produtos">
            <thead>
                <tr>
                    <th>Mês / Ano</th>
                    <th>ID</th>
                    <th>Nome do Produto</th>
                    <th>Quantidade</th>
                    <th>Subtotal (R$)</th>
                    <th>Valor médio unitário (R$)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>04/2014</td>
                    <td>1150271</td>
                    <td>Fender Select Thinline Telecaster® with Gold Hardware</td>
                    <td>1</td>
                    <td>1.750,00</td>
                    <td>1.750,00</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="box-footer"></div>
</div>
<form action="/admin/relatorio/vendas/por_produto/baixar" method="POST">
    <button type="submit" class="btn btn-primary pull-right" >
    <input type="hidden" name='timedelta' value="60">
    <i class="icon-download icon-white"></i>
    Baixar dados
    </button>
    <input type='hidden' name='csrfmiddlewaretoken' value='5t0OutL51xGEFdPnAbOdLA7UEp1y8gBw' />
</form>