
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
    <div class="box mercadolivre">
        <div class="box-header">
        </div>
        <div class="box-content habilitar-integracao row">
            <div class="span3 logo-head">
                <span class="text">Integração com</span>
                <img src='/admin/img/mercadolivre_mini.jpg' alt='Logo Mercado Livre' />
            </div>
            <div class="span9 descr">
                <p>
                    Para integrar sua loja ao MercadoLivre é bastante simples, você precisa apenas de um cadastro nele.
                    Clique no botão abaixo para associar sua loja ao MercadoLivre.
                </p>
            </div>
            <!--<div class="span9 descr">
                <a href="#tutorial-video" data-toggle="modal" class="pull-right"><img src="/admin/img/tutorial-mercadolivre.png" alt="" /></a>
                <p>
                    Para integrar sua loja ao MercadoLivre é bastante simples, você precisa apenas de um cadastro nele.
                    Clique no botão abaixo para associar sua loja ao MercadoLivre.
                </p>
                </div>-->
            <div class="fluxo-integracao">
                <div class="left">
                    <div class="content">
                        <span class="tit"><strong>Produtos e Estoque</strong><br />Integrados no Mercado Livre</span>
                        <div class="inner">
                            <div class="logo-integrada"><img src="/admin/img/logo-lojaintegrada.png" alt="Loja Integrada" /></div>
                            <div class="text">Cadastre seus produtos no MercadoLivre através de nossa integração e tenha um gerenciamento simples e efetivo. </div>
                            <div class="logo-ml"><img src='/admin/img/mercadolivre-horiz.png' alt='Logo Mercado Livre' /></div>
                        </div>
                        <span class="tit"><strong>Vendas no mercado livre</strong><br />Gerenciadas na ViaLoja Shopping</span>
                    </div>
                </div>
                <div class="right">
                    <div class="content">
                        <span class="tit"><strong>Respostas às perguntas</strong><br />integradas ao mercado livre</span>
                        <div class="inner">
                            <div class="text">Para facilitar seu gerenciamento, você poderá responder as perguntas diretamente neste ambiente, agilizando todo o processo de conclusão de sua venda.</div>
                            <div class="logo-integrada"><img src="/admin/img/logo-lojaintegrada.png" alt="Loja Integrada" /></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/instalar" title="" class="btn-large btn-primary">Habilitar integração</a>
            </div>
            <div class='clear-fix'></div>
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
