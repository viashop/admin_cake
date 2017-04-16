<div id="footer">
    <a href="<?php echo VIALOJA_HTTP_HOST ;?>" class="footer-logo"><img src="<?php echo CDN_IMG . "vialoja/logos/admin/default-footer.png" ?>" alt="ViaLoja Shopping" /></a>
    <ul class="footer-menu">
        <li><a href="<?php echo VIALOJA_TERMO_USO ;?>" target="_blank">Termos de uso</a></li>
        <li><a href="<?php echo VIALOJA_POLITICA_PRIVACIDADE ;?>" target="_blank">Política de privacidade</a></li>
        <li><a href="<?php echo VIALOJA_FALE_CONOSCO ;?>" target="_blank">Fale conosco</a></li>
    </ul>
    <p>
        <?php echo VIALOJA_RAZAO_SOCIAL; ?>
        <br />
        Todos os direitos reservados © <?php echo date('Y');?>
    </p>
</div>
<?php
/*
<div id='modal-ajuda' class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Ajuda?</h3>
    </div>
    <div class="modal-body">
        <p>
            Esta precisando de ajuda? <strong>Clique no botão de ajuda abaixo</strong>
            e entre no sistema de suporte da <strong>Loja Integrada</strong>,
            lá você vai encontrar tutoriais, perguntas frequentes e um formulário
            de contato, caso precisa tirar uma dúvida via o formulário de contato
            não se esqueça de informar o nome da sua loja
            <small class="muted">nome_da_loja.vialoja.com.br</small> para
            agializar o antedimento.
        </p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">
        <i class="icon-remove"></i>
        Fechar
        </a>
        <a href="http://vialoja.com.br/comunidade/" target="_blank" class="btn btn-primary">
        <i class="icon-question-sign icon-white"></i>
        Obter ajuda
        </a>
    </div>
</div>
<div id="loading" class="hide modal">
    <h3 class="loading-text">Carregando...</h3>
    <img src="/admin/img/ajax-loader.gif" alt="Loading" />
</div>
<div id="modal-error" class="hide modal">
    <h3 class="error-text"></h3>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">
        <i class="icon-remove"></i>
        Fechar
        </a>
    </div>
</div>
<div id="modal-success" class="hide modal">
    <h3 class="success-text"></h3>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">
        <i class="icon-remove"></i>
        Fechar
        </a>
    </div>
</div>
<div id="modal-video" class="hide modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3></h3>
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer hide">
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Fechar</button>
    </div>
</div>
<div id="modal-notificacoes" class="hide modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Central de Notificações</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span4">
                <div class="ultimas-notificacoes">
                    <h4>Ultimas notificações</h4>
                    <ul id="listaNotificacao" class="notificacoes-menu">
                        <li class="n001">
                            <a href="#n001" data-toggle="tab"><span><b>Novo editor de banners</b> vidis litro abertis. Consetis adipiscings elitis. Pra lá.</span> <span class="data text-right">16/01/14</span></a>
                        </li>
                        <li class="n002">
                            <a href="#n002" data-toggle="tab"><span><b>Configurar tema</b> Consetis adipiscings elitis. Pra lá , depois divoltis...</span><span class="data text-right">14/01/14</span></a>
                        </li>
                        <li class="n003">
                            <a href="#n003" data-toggle="tab"><span><b>Layout mobile.</b> Pra lá , depois divoltis porris paradis.</span><span class="data text-right">11/01/14</span></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tab"><span>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá </span><span class="data text-right">06/01/14</span></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tab"><span>Depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum.</span><span class="data text-right">02/01/14</span></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tab"><span>Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso.</span><span class="data text-right">23/01/13</span></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tab"><span>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá </span><span class="data text-right">22/01/13</span></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tab"><span>depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz.</span><span class="data text-right">16/01/13</span></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tab"><span>Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso.</span><span class="data text-right">06/01/13</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="span8">
                <div id="tabNotificacao" class="notificacoes-conteudo tab-content">
                    <div class="tab-pane active in" id="n001">
                        <h2 class="titulo-notificacao"><small class="data">16/01/14</small> <span>Novo editor de banners</span></h2>
                        <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                        <p>Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis. Pellentesque laoreet mé vel lectus scelerisque interdum cursus velit auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac mauris lectus, non scelerisque augue. Aenean justo massa.</p>
                        <p>Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui.</p>
                        <p> Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis.</p>
                        <p>Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui.</p>
                        <p> Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis.</p>
                    </div>
                    <div class="tab-pane" id="n002">
                        <h2 class="titulo-notificacao"><small class="data">14/01/14</small><span>Configurar Tema</span></h2>
                        <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                        <p>Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis. Pellentesque laoreet mé vel lectus scelerisque interdum cursus velit auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac mauris lectus, non scelerisque augue. Aenean justo massa.</p>
                    </div>
                    <div class="tab-pane" id="n003">
                        <h2 class="titulo-notificacao"><small class="data">13/01/14</small><span>Layout Mobile</span></h2>
                        <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                        <p>Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Fechar</button>
    </div>
</div>
<div id="modal-alerta" class="hide modal">
    <div class="modal-header">
        <span class="data pull-right">16/01/14</span>
        <h3 class="titulo-alerta">Comunicado importante!</h3>
    </div>
    <div class="modal-body">
        <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.
        </p>
    </div>
    <div class="modal-footer">
        <label><input type="checkbox" id="confirmarAlerta" />Li e estou ciente do comunicado.</label>
        <button class="btn btn-danger fechar-alerta hide" data-dismiss="modal" aria-hidden="true">Fechar</button>
    </div>
</div>

*/
?>