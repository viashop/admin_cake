<script type="text/javascript" src="/admin/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admin/js/zeroclipboard/ZeroClipboard.min.js"></script>
<script type="text/javascript">
jQuery.fn.dataTableExt.oApi.fnSetFilteringDelay = function(oSettings, iDelay) {
    var _that = this;

    if (iDelay === undefined) {
        iDelay = 250;
    }

    this.each(function(i) {
        $.fn.dataTableExt.iApiIndex = i;
        var
            $this = this,
            oTimerId = null,
            sPreviousSearch = null,
            anControl = $('input', _that.fnSettings().aanFeatures.f);

        anControl.unbind('keyup').bind('keyup', function() {
            var $$this = $this;

            if (sPreviousSearch === null || sPreviousSearch != anControl.val()) {
                window.clearTimeout(oTimerId);
                sPreviousSearch = anControl.val();
                oTimerId = window.setTimeout(function() {
                    $.fn.dataTableExt.iApiIndex = i;
                    _that.fnFilter(anControl.val());
                }, iDelay);
            }
        });

        return this;
    });
    return this;
};

$(document).ready(function() {

    produtos_vinculados = [<?php echo $id_vinculados; ?>];

    /* Cria um arrai com os valores de todos os checkboxes na coluna. */
    $.fn.dataTableExt.afnSortData['dom-checkbox'] = function(oSettings, iColumn) {
        return $.map(oSettings.oApi._fnGetTrNodes(oSettings), function(tr, i) {
            return $('td:eq(' + iColumn + ') input', tr).prop('checked') ? '1' : '0';
        });
    }

    var oTable;
    oTable = $('#table-produto').dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "/admin/recurso/produto/listar/json/datatable",
        "aaSorting": [
            [0, 'desc']
        ],
        "fnCreatedRow": function(tr) {
            var obj = $(tr);
            var input = obj.find('input');

            var produto_id = parseInt(input.val());
            if (produtos_vinculados.indexOf(produto_id) > -1) {
                input.attr('checked', 'checked');
            } else {
                input.removeAttr('checked');
            }
        },
        "aoColumns": [{
                "sSortDataType": "dom-checkbox",
                "bSearchable": false
            },
            null,
            null,
            null
        ],
        "oLanguage": {
            "sProcessing": "Processando...",
            "sLengthMenu": "Mostrar _MENU_ produtos",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "&laquo; Anterior",
                "sNext": "Seguinte &raquo;",
                "sLast": "Último"
            }
        }
    }).fnSetFilteringDelay();

    // Check no input dentro do td.check_box
    $('#table-produto .check_box').click(function() {
        $('input', this).attr('checked', 'checked');
    });

    var url_xml_copiada = null;
    $('#copyButton').click(function(event) {
    	url_xml_copiada = true;
    	alert('URL copiada');
    });


    $('#main-form').submit(function(event) {
        var ativo = $('#AtivacaoXML').val();
        event.preventDefault();

        var id_comparador = '<?php echo $id; ?>';

        /*=============================================
        =    Verifica se a url foi copiada           =
        =============================================*/    
        
        if (url_xml_copiada !== true) {

	        $.post(
	            "/admin/recurso/xml/editar/json/" + id_comparador, {
	                produtos: produtos_vinculados,
	                ativo: ativo,
	                todos_os_produtos: $('#id_todos_os_produtos_0').is(':checked')
	            },

	            function(data) {
	                if (data.resposta.estado === "SUCESSO") {
	                    window.location.reload();
	                } else {
	                    alert(data.resposta.mensagem);
	                }
	            }, 'JSON');

        };

    });


    $('#table-produto').on('click', '.produto_id', function(event) {
        var produto_id = parseInt($(this).val());
        var indice = $.inArray(produto_id, produtos_vinculados);
        if (indice > -1) {
            delete produtos_vinculados[indice]
        } else {
            produtos_vinculados.push(produto_id);
        }
    });

    $('input[name="todos_os_produtos"]').change(function() {
        if (this.value === "False") {
            $('.escolher-produtos').slideDown();
        } else {
            $('.escolher-produtos').slideUp();
        }
    });

    if ($('#id_todos_os_produtos_0').is(':checked')) {
        $('.escolher-produtos').slideUp();
    } else {
        $('.escolher-produtos').slideDown();
    }

    var clip = new ZeroClipboard($("#copyButton"), {
        moviePath: '/admin/js/zeroclipboard/ZeroClipboard.swf'
    });

    clip.on('mouseout', function() {
        $('#global-zeroclipboard-html-bridge').tooltip('destroy');
        $('#global-zeroclipboard-html-bridge').tooltip({
            'title': 'Clique para copiar',
        }).tooltip('show');
    });

    clip.on('noFlash', function() {
        $(this).hide();
    });

    clip.on('complete', function() {
        $('#global-zeroclipboard-html-bridge').tooltip('destroy');
        $('#global-zeroclipboard-html-bridge').tooltip({
            'title': 'Copiado',
        }).tooltip('show');
    });

    $('#global-zeroclipboard-html-bridge').tooltip({
        'title': 'Clique para copiar',
    }).tooltip('show');


    $('[data-toggle="tooltip"]').tooltip();

    $('.input-copy').click(function() {
        $(this).select();
    });

});
</script>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="#"><i class="icon-graph icon-custom"></i>Marketing</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/xml/listar"><i class="icon-check"></i> Comparadores de preço</a> <span class="bread-separator">-</span></li>
		<li><span>Editar comparador</span></li>
	</ul>
</div>

<div class= "xml xml-editar">

	<div class="alert alert-info">
		<div class="title">
			<h4 class="pull-left">Informações do comparador</h4>
			<a href="" title="" class="pull-right hide">Não ver mais esta mensagem</a>
		</div>
		<p>
			Selecione os produtos da sua loja que você quer que apareçam no comprador.
			Os produtos indicados serão colocados no arquivo XML.
		</p>
	</div>
	<form id='main-form' action="<?php echo Router::url(); ?>" method="post" enctype="multipart/form-data">
		<div class="box">
			<div class="box-header">
				<h3 class="pull-left">Produtos para <?php echo $nome; ?></h3>
			</div>
			<div class="box-content">
				<p><b>Defina os produtos da loja que serão anunciados no comparador</b></p>
				<div class="control-group list-choice-products ">
					<ul id="id_todos_os_produtos">
						<?php
						if (!isset($todos_os_produtos)) {
							$todos_os_produtos = 'False';
						}
						?>
						<li><label for="id_todos_os_produtos_0"><input <?php if (!(strcmp("True", $todos_os_produtos))) {echo 'checked="checked"';} ?> id="id_todos_os_produtos_0" name="todos_os_produtos" type="radio" value="True" /> Anunciar todos os produtos da Loja</label></li>
						<li><label for="id_todos_os_produtos_1"><input <?php if (!(strcmp("False", $todos_os_produtos))) {echo 'checked="checked"';} ?>  id="id_todos_os_produtos_1" name="todos_os_produtos" type="radio" value="False" /> Anunciar apenas os produtos da lista</label></li>
					</ul>
				</div>
				<div class="escolher-produtos hide">
					<hr/>
					<h2>Produtos relacionados</h2>
					<table class="table table-bordered table-striped" id="table-produto">
						<thead>
							<tr>
								<th width="15">&nbsp;</th>
								<th width="250">Nome do produto</th>
								<th width="60">Valor</th>
								<th width="10">Estoque</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="clear"></div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary" onclick="$('#AtivacaoXML').val('True');">Salvar Alterações</button>
			</div>
		</div>
		<?php
		if (isset($total_xml) && $total_xml ==0) {
		?>
		<div class="box">
			<div class="box-header">
				<h3>Geração de XML do <?php echo $nome; ?></h3>
			</div>
			<div class="box-content text-align-center box-gerar-url">
				<button type="button" class="btn btn-large btn-primary" id="DesativaXML" onclick="$('#AtivacaoXML').val('True'); $('form').submit();">
					Gerar URL</a>
			</div>
		</div>
		<?php
		} else {
		?>
		<div class="box box-link-xml">
	        <div class="box-header">
	            <h3>Link do XML</h3>
	        </div>
	        <div class="box-content">
	            <div>
	                <input type="text" value="<?php echo $url_xml; ?>" class="input-xxlarge input-copy" id="inputCopy" readonly="readonly"/>
	                <button id="copyButton" data-clipboard-target="inputCopy" title="" class="btn btn-small">Copiar</button>
	            </div>
	        </div>
	        <div class="form-actions">
	            <a href="<?php echo VIALOJA_PAINEL ?>/recurso/xml/url/alterar/<?php echo $id; ?>" class="btn" data-toggle="tooltip" title="Ao gerar uma nova URL voc&ecirc; dever&aacute; atualizar no comparador."><i class="icon-refresh"></i> Gerar nova URL</a>
	            <button type="button" class="btn btn-danger" id="DesativaXML" onclick="$('#AtivacaoXML').val('False'); $('form').submit();">
	                Desativar URL</a>
	        </div>
	    </div>
	    <?php
		}
		?>
		<input type="hidden" name="ativo" value="" id="AtivacaoXML" />
	</form>

</div>
