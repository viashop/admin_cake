
<script type="text/javascript">
    $(document).ready(function() {
        $('#tutorial').click(function(event) {
            event.preventDefault();
            $('.tutorial').slideToggle('normal');
        });
    });
</script>
        
<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><span>Seu MercadoLivre</span></li>
    </ul>
</div>
<div class="alert alert-block alert-error fade in">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h3 class="alert-heading">Atenção</h3>
    <p>Faltam dados cadastrais na sua conta do MercadoLivre, sem os quais não é possivel efetuar vendas.</p>
    <a target="_blank" class="btn btn-small" href="https://syi.mercadolivre.com.br/sell/sell"><i class="icon-edit"></i> Alterar dados cadastrais</a>
    <p>
        Se você já alterous os dados cadastrais de sua conta clique no botão abaixo
    </p>
    <p>
        <a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/reativar" class="btn btn-small btn-primary">
        <i class="icon-white icon-ok"></i>
        Verificar dados cadastrais
        </a>
    </p>
</div>
<div class='box mercadolivre'>
    <div class='box-header'>
        <h3>Seu cadastro no MercadoLivre</h3>
    </div>
    <div class='box-content row'>
        <div class="span3">
            <img src='/admin/img/mercadolivre.jpg' alt='Logo MercadoLivre' class='pull-left' />
        </div>
        <div class='span9'>
            <table class='table'>
                <tr>
                    <td>Nome</td>
                    <td>
                        WILLIAM SILVA DUARTE
                    </td>
                </tr>
                <tr>
                    <td>Apelido</td>
                    <td>WSDUARTE</td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td>wsduarte@outlook.com</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <!--<a href="#tutorial-video" title="Tutorial de configuração" class="btn btn-small pull-right" data-toggle="modal"><i class="icon-facetime-video"></i> Tutorial</a>-->
                        <a href="http://perfil.mercadolivre.com.br/WSDUARTE" title="Ir para seu perfil do MercadoLivre" class="btn btn-small btn-info" target="_blank">Ir para seu perfil do MercadoLivre</a>
                        <a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/configuracoes" title="Configuração da integração" class="btn btn-small">Configuração da integração</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="box">
    <div class="box-header">
        <h3>Resumo da integração</h3>
    </div>
    <div class="box-content row resumo">
        <div class="span6 text-align-center">
            <h3>Produtos</h3>
            <h1>1</h1>
            <p>integrado</p>
            <a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/produtos/listar" class="btn  btn-small">Ver Produto</a>
        </div>
        <div class="span6 text-align-center">
            <h3>Perguntas</h3>
            <h1>4</h1>
            <p>pendentes</p>
            <a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/perguntas/listar" title="" class="btn  btn-small">Ver Pergunta</a>
        </div>
    </div>
</div>

<div id="tutorial-video" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <h3>Tutorial de configuração da integração</h3>
	</div>
	<div class="modal-body">
	    <div class="text-align-center"><iframe width="530" height="298" src="//www.youtube.com/embed/vIEtEnr_5m0?rel=0" frameborder="0" allowfullscreen></iframe></div>
	    <script type="text/javascript">
	        $('#tutorial-video').on('hidden', function() {
	            var src;
	            src = $('#tutorial-video iframe').attr('src');
	            $('#tutorial-video iframe').attr('src', '');
	            $('#tutorial-video iframe').attr('src', src);
	        });
	    </script>
	</div>
	<div class="modal-footer">
	    <a href="" class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Fechar</a>
	</div>
</div>