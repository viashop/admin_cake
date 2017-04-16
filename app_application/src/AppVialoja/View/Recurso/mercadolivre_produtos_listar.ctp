
<script type="text/javascript">
    var scroll_para_elemento = function(elemento) {
        $('html, body').animate({
            scrollTop: $(elemento).offset().top - 45
        }, 1000);
    };
    var dots = 0;
    function type() {
        if(dots < 3) {
            $('.animacao-processando').append('.');
            dots++;
        } else {
            $('.animacao-processando').html('');
            dots = 0;
        }
    }
    
    $(document).ready(function(){
        // Validacao da edicao do preco na listagem de produtos.
        if(window.location.hash) {
            if($(window.location.hash).length > 0) {
                var hash_nova = window.location.hash.replace('#', '');
                scroll_para_elemento(window.location.hash);
    
                $(window.location.hash).fancybox().trigger('click');
            }
        }
        $('body').on('click', '.edicao-preco .editar-preco', function () {
            $(this).parents('.edicao-preco').find('.preco-fechado').hide();
            $(this).parents('.edicao-preco').find('.preco-edicao').show();
            event.preventDefault();
        });
        if ($('.animacao-processando').length > 0) {
            setInterval (type, 600);
        }
        $('.editar_preco_filho').click(function(event) {
            event.preventDefault();
    
            var modal_html = $('#editarpreco .modal-body');
            var href = $(this).attr('href');
            $.get(href, function(data) {
                modal_html.html(data);
                $('#editarpreco').modal('show');
            })
        });
        $('.loading a').click(function() {
            event.preventDefault();
            var integracao = $(this).data('integracao');
            window.location.href += '#' + integracao;
            location.reload();
            return false;
        });
        $('body').on('click', '.edicao-preco .salva-preco', function (event) {
            $('.edicao-preco .preco-edicao').hide();
            $('.edicao-preco .preco-fechado').show();
            var price = $(this).parents('.preco-edicao').find('input').val();
            var that = $(this);
            var produto_id = $(this).parents('tr').attr('id');
            var url = '/admin/recurso/mercadolivre/produtos/editar.json';
            $.post(url, {produto_id: produto_id, price: price}, function(data) {
                if (data == 'ERRO') {
                    alert('Erro ao alterar o preço do produto');
                }else {
                    that.parents('td').find('.preco-fechado .valor').html('R$ ' + formatar_decimal(price));
                }
            });
            event.preventDefault();
        });
    
        
    
        $('.mudar_status').click(function(event) {
            var produto_id = $(this).parents('tr').attr('id');
            var status = $(this).data('status');
            var that = $(this);
            var url = '/admin/recurso/mercadolivre/produtos/editar.json';
            $.post(url, {produto_id: produto_id, status: status}, function(data) {
                var data = $.parseJSON(data);
                alert(data.mensagem);
                if (data.status == 'SUCESSO') {
                    that.parents('td').find('span.status_ml').html(data.novo_status);
                }
    
    
            });
            event.preventDefault();
        });
        $('[rel=fancybox]').fancybox();
    });
</script>
    

<style type="text/css">
    
.table {
    font-size: 13px;
}

</style>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="./"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><span>Produtos</span></li>
    </ul>
</div>

<div class="mercadolivre mercadolivre-produtos-listar">

    <div class="box">
        <div class="box-header">
            <h3>Resumo da integração</h3>
        </div>
        <div class="box-content row resumo">
            <div class="span6 text-align-center">
                <h3>Produtos</h3>
                <h1>1</h1>
                <p>integrado</p>
                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/produtos/listar" class="btn btn-info btn-small">Ver Produto</a>
            </div>
            <div class="span6 text-align-center">
                <h3>Perguntas</h3>
                <h1>0</h1>
                <p>pendentes</p>
                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/perguntas/listar" title="" class="btn  btn-small">Ver Pergunta</a>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3>Histórico de integrações</h3>
        </div>
        <div class="box-content">
            <table class="table">
                <tr>
                    <th>Data da integração</th>
                    <th>Tipo anúncio</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>
                        <a id="NTuvv5t9Tpy6pIl4OA1tAA" class="integracao_detalhar" data-fancybox-type="iframe"  href="/admin/recurso/mercadolivre/integracao/NTuvv5t9Tpy6pIl4OA1tAA/detalhar" rel="fancybox">
                        2014-03-31T18:31:38.282447
                        </a>
                    </td>
                    <td>Produtos selecionados</td>
                    <td>Integrado</td>
                </tr>
                <tr>
                    <td>
                        <a id="YyYknNqAQj-rR2tGb0WUtA" class="integracao_detalhar" data-fancybox-type="iframe"  href="/admin/recurso/mercadolivre/integracao/YyYknNqAQj-rR2tGb0WUtA/detalhar" rel="fancybox">
                        2014-04-04T17:04:29.334621
                        </a>
                    </td>
                    <td>Produtos selecionados</td>
                    <td>Integrado</td>
                </tr>
            </table>
        </div>
        <div class="box-footer"></div>
    </div>
    <div class="box box-visible">
        <div class="box-header">
            <h3>Produtos integrados</h3>
        </div>
        <div class="box-content">
            <a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/produtos/integrar" class="btn btn-small btn-primary btn-integrarproduto">
            <i class="icon-retweet icon-white"></i>
            Integrar novo produto no MercadoLivre
            </a>
            <table class='table table-produto table-generic-list'>
                <tr>
                    <th>Produto</th>
                    <th>Código ML</th>
                    <th>Status anúncio</th>
                    <th>Preço ML</th>
                    <th>Estoque</th>
                </tr>
                <tr id="MLB551844629" class=' ativo '>
                    <td>
                        Coronado Bass Produto Com Duas C...
                        <p>
                            <small>
                            Produto simples
                            </small>
                        </p>
                    </td>
                    <td class='nome'>
                        <a href="http://produto.mercadolivre.com.br/MLB-551844629-coronado-bass-produto-com-duas-cores-pretopreto-_JM" target="_blank">
                        MLB551844629
                        </a>
                    </td>
                    <td>
                        Em processamento
                    </td>
                    <td class="edicao-preco">
                        <div class="preco-fechado">
                            <span class="valor">R$ 499,80</span>
                            <a href="#" title="Editar preço" class="editar-preco"><i class="icon-edit"></i></a>
                        </div>
                        <div class="preco-edicao" style="display: none;">
                            <div class="input-prepend">
                                <span class="add-on">R$</span>
                                <input type="text" name="valor" class="input-price"  value="499,80"/>
                            </div>
                            <a href="#" title="Salvar preço" class="salva-preco"><i class="icon-ok"></i></a>
                        </div>
                    </td>
                    <td>
                        1
                    </td>
                </tr>
            </table>
        </div>
        <div class="box-footer">
        </div>
        <div class="modal hide fade" id="editarpreco">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Editar atributos</h3>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
    </div>

</div>