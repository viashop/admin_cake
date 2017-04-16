<!-- primeira fase -->


<script type="text/javascript">
	$(document).ready(function(){
		$('.instrucoes-facebook').click(function(event) {
			event.preventDefault();
			$('.tutorial').slideToggle('normal');
		});
	
		if ($('#id_li_msg').is(':checked')) {
			$('.btn-instalar').removeAttr('disabled');
		}
	
		$('#id_li_msg').click(function () {
			if ($('#id_li_msg').is(':checked')) {
				$('.btn-instalar').removeAttr('disabled');
			} else {
				$('.btn-instalar').attr('disabled', 'disabled');
			}
		});
	
		$('.btn-instalar').click(function () {
			if ($(this).attr('disabled')) {
				return false;
			}
		});
	
		if($('.table-loja-facebook > tbody > tr').hasClass('ativo')) {
			$('.table-loja-facebook > tbody > tr').each(function() {
				if(!$(this).hasClass('ativo')) {
					$(this).hide();
				}
			});
		}
	
	});
</script>
       
<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
		<li><span>Loja no Facebook</span></li>
	</ul>
</div>
<div class="box">
	<div class="box-header">
		<h3 class="pull-left">Loja no Facebook</h3>
	</div>
	<div class="box-content  row">
		<div class="alert alert-warning">
			<h4>Siga atentamente nossas instruções para criar sua loja no Facebook</h4>
			<p>
				Será necessário que você tenha uma fanpage da loja no Facebook, só então será possível prosseguir. Caso não tenha uma fanpage, <a href="https://www.facebook.com/pages/create.php" title="Fanpage" target="_blank">clique aqui</a> e crie agora</a>.
			</p>
			<p>
				<label class="checkbox"><input type="checkbox" name="li_msg" id="id_li_msg" /> Sim, já tenho uma fanpage no Facebook.</label>
			</p>
		</div>
		<a class='btn btn-success btn-instalar' href='/admin/recurso/facebook/instalar' disabled="disabled">
		<i class="icon-ok icon-white"></i> Instalar Aplicativo 
		</a>
	</div>
</div>
<div id='modal-facebook' class="modal hide">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Criar Página</h3>
	</div>
	<div class="modal-body">
		<h4>Instruções</h4>
		<p>
			Na janela que abrir crie sua página no Facebook, e quando estiver tudo pronto volte para o painel de controle para continuar a configuração da sua loja no Facebook.
		</p>
		<img style="border: 3px solid #EEE;" src='/admin/img/facebook-nova-pagina.jpg' akt='Nova página Facebook' />
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</button>
		<a target='_blank' href='https://www.facebook.com/pages/create.php' class="btn btn-primary"><i class="icon-plus icon-white"></i> Criar página</a>
	</div>
</div>
<div class="tutorial hide">
	<i class="icon-tutorial icon-tutorial-step">01</i>
	<img src='/admin/img/facebook-wizard/login.jpg' alt="Login facebook" />
	<div class='footer'>
		<p>
			Clique no botão de instalar o aplicativo, você sera levado ao site do Facebook, onde se necessário efetuar o
			login.
		</p>
	</div>
</div>
<div class="tutorial hide">
	<i class="icon-tutorial icon-tutorial-step">02</i>
	<img src='/admin/img/facebook-wizard/instalar.jpg' alt="Login facebook" />
	<div class='footer'>
		<p>
			Clique em "Ir para o aplicativo" para poder usar o aplicativo
		</p>
	</div>
</div>
<div class="tutorial hide">
	<i class="icon-tutorial icon-tutorial-step">03</i>
	<img src='/admin/img/facebook-wizard/auth.jpg' alt="Login facebook" />
	<div class='footer'>
		<p>
			Clique em "Permitir" e pronto!
		</p>
	</div>
</div>






<!-- 2ª fase -->


<script type="text/javascript">
	$(document).ready(function(){
		$('.instrucoes-facebook').click(function(event) {
			event.preventDefault();
			$('.tutorial').slideToggle('normal');
		});
	
		if ($('#id_li_msg').is(':checked')) {
			$('.btn-instalar').removeAttr('disabled');
		}
	
		$('#id_li_msg').click(function () {
			if ($('#id_li_msg').is(':checked')) {
				$('.btn-instalar').removeAttr('disabled');
			} else {
				$('.btn-instalar').attr('disabled', 'disabled');
			}
		});
	
		$('.btn-instalar').click(function () {
			if ($(this).attr('disabled')) {
				return false;
			}
		});
	
		if($('.table-loja-facebook > tbody > tr').hasClass('ativo')) {
			$('.table-loja-facebook > tbody > tr').each(function() {
				if(!$(this).hasClass('ativo')) {
					$(this).hide();
				}
			});
		}
	
	});
</script>


<div class="alert alert-success">
	<a class="close" data-dismiss="alert">×</a>
	<h4>Página do Facebook removida com sucesso.</h4>
</div>
<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
		<li><span>Loja no Facebook</span></li>
	</ul>
</div>
<div class="box">
	<div class="box-header">
		<h3 class="pull-left">Loja no Facebook</h3>
	</div>
	<div class="box-content table-content row">
		<table class='table table-produto table-generic-list table-striped table-loja-facebook'>
			<tbody>
				<tr class=''>
					<td>
						<table class="table table-produto table-generic-list">
							<tr>
								<td width="50">
									<a target='_blank' href='https://www.facebook.com/cadefone' >
									<img src='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn2/t1.0-1/p50x50/7542_1441917326024584_1405663374_t.png' alt='CadeFone' />
									</a>
								</td>
								<td>
									<strong>
									CadeFone
									</strong>
									<br />
									<small>Bem-vindo ao CadeFone.com
									www.cadefone.com.br
									Guia de telefones e endereços de comércios e indústrias.</small>
								</td>
								<td class="text-align-right">
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="span2"><b>Status:</b> Desativada</div>
									<a class="btn btn-small" href="/admin/recurso/facebook/1432871693595814/associar" data-toggle="modal">
									<i class="icon-ok "></i> Associar a esta fanpage
									</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class=''>
					<td>
						<table class="table table-produto table-generic-list">
							<tr>
								<td width="50">
									<a target='_blank' href='https://www.facebook.com/pages/Cuilx-BR/203333776513595' >
									<img src='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash3/t1.0-1/p50x50/1381510_203411296505843_1463458982_t.jpg' alt='Cuilx BR' />
									</a>
								</td>
								<td>
									<strong>
									Cuilx BR
									</strong>
									<br />
									<small>Bem-vindo ao Cuilx
									www.cuilx.com.br
									Guia de telefones, mapas, ceps e endereços de comércios e indústrias.
									</small>
								</td>
								<td class="text-align-right">
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="span2"><b>Status:</b> Desativada</div>
									<a class="btn btn-small" href="/admin/recurso/facebook/203333776513595/associar" data-toggle="modal">
									<i class="icon-ok "></i> Associar a esta fanpage
									</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class=''>
					<td>
						<table class="table table-produto table-generic-list">
							<tr>
								<td width="50">
									<a target='_blank' href='https://www.facebook.com/pages/vialoja/564186876992925' >
									<img src='https://fbcdn-profile-a.akamaihd.net/static-ak/rsrc.php/v2/yg/r/LjGkeBM0ISt.png' alt='vialoja' />
									</a>
								</td>
								<td>
									<strong>
									vialoja
									</strong>
									<br />
									<small>Shopping Virtual</small>
								</td>
								<td class="text-align-right">
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="span2"><b>Status:</b> Desativada</div>
									<a class="btn btn-small" href="/admin/recurso/facebook/564186876992925/associar" data-toggle="modal">
									<i class="icon-ok "></i> Associar a esta fanpage
									</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class=''>
					<td>
						<table class="table table-produto table-generic-list">
							<tr>
								<td width="50">
									<a target='_blank' href='https://www.facebook.com/yndica' >
									<img src='https://fbcdn-profile-a.akamaihd.net/static-ak/rsrc.php/v2/yg/r/LjGkeBM0ISt.png' alt='Yndica' />
									</a>
								</td>
								<td>
									<strong>
									Yndica
									</strong>
									<br />
									<small>Yndica - Todo dia uma dica diferente</small>
								</td>
								<td class="text-align-right">
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="span2"><b>Status:</b> Desativada</div>
									<a class="btn btn-small" href="/admin/recurso/facebook/369701819840120/associar" data-toggle="modal">
									<i class="icon-ok "></i> Associar a esta fanpage
									</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<a href="<?php echo VIALOJA_PAINEL ?>/recurso/facebook/desinstalar" class="btn btn-danger">
<i class="icon-remove icon-white"></i>
Remover aplicativo
</a>
<div id='modal-facebook' class="modal hide">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Criar Página</h3>
	</div>
	<div class="modal-body">
		<h4>Instruções</h4>
		<p>
			Na janela que abrir crie sua página no Facebook, e quando estiver tudo pronto volte para o painel de controle para continuar a configuração da sua loja no Facebook.
		</p>
		<img style="border: 3px solid #EEE;" src='/admin/img/facebook-nova-pagina.jpg' akt='Nova página Facebook' />
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</button>
		<a target='_blank' href='https://www.facebook.com/pages/create.php' class="btn btn-primary"><i class="icon-plus icon-white"></i> Criar página</a>
	</div>
</div>
<div class="tutorial hide">
	<i class="icon-tutorial icon-tutorial-step">01</i>
	<img src='/admin/img/facebook-wizard/login.jpg' alt="Login facebook" />
	<div class='footer'>
		<p>
			Clique no botão de instalar o aplicativo, você sera levado ao site do Facebook, onde se necessário efetuar o
			login.
		</p>
	</div>
</div>
<div class="tutorial hide">
	<i class="icon-tutorial icon-tutorial-step">02</i>
	<img src='/admin/img/facebook-wizard/instalar.jpg' alt="Login facebook" />
	<div class='footer'>
		<p>
			Clique em "Ir para o aplicativo" para poder usar o aplicativo
		</p>
	</div>
</div>
<div class="tutorial hide">
	<i class="icon-tutorial icon-tutorial-step">03</i>
	<img src='/admin/img/facebook-wizard/auth.jpg' alt="Login facebook" />
	<div class='footer'>
		<p>
			Clique em "Permitir" e pronto!
		</p>
	</div>
</div>





<!-- 3ª fase -->










<script type="text/javascript">
    $(document).ready(function(){
        $('.instrucoes-facebook').click(function(event) {
            event.preventDefault();
            $('.tutorial').slideToggle('normal');
        });
    
        if ($('#id_li_msg').is(':checked')) {
            $('.btn-instalar').removeAttr('disabled');
        }
    
        $('#id_li_msg').click(function () {
            if ($('#id_li_msg').is(':checked')) {
                $('.btn-instalar').removeAttr('disabled');
            } else {
                $('.btn-instalar').attr('disabled', 'disabled');
            }
        });
    
        $('.btn-instalar').click(function () {
            if ($(this).attr('disabled')) {
                return false;
            }
        });
    
        if($('.table-loja-facebook > tbody > tr').hasClass('ativo')) {
            $('.table-loja-facebook > tbody > tr').each(function() {
                if(!$(this).hasClass('ativo')) {
                    $(this).hide();
                }
            });
        }
    
    });
</script>
       
<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><span>Loja no Facebook</span></li>
    </ul>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="pull-left">Loja no Facebook</h3>
    </div>
    <div class="box-content table-content row">
        <table class='table table-produto table-generic-list table-striped table-loja-facebook'>
            <tbody>
                <tr class='ativo'>
                    <td>
                        <table class="table table-produto table-generic-list">
                            <tr>
                                <td width="50">
                                    <a target='_blank' href='https://www.facebook.com/cadefone' >
                                    <img src='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn2/t1.0-1/p50x50/7542_1441917326024584_1405663374_t.png' alt='CadeFone' />
                                    </a>
                                </td>
                                <td>
                                    <strong>
                                    CadeFone
                                    </strong>
                                    <br />
                                    <small>Bem-vindo ao CadeFone.com
                                    www.cadefone.com.br
                                    Guia de telefones e endereços de comércios e indústrias.</small>
                                </td>
                                <td class="text-align-right">
                                    <a class="btn btn-small btn-info" target='_blank' href='http://facebook.com/1432871693595814?sk=app_529364653742273'>
                                    <i class="icon-search icon-white"></i> Ir para loja no Facebook
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="span2"><b>Status:</b> Ativada</div>
                                    <a href="<?php echo VIALOJA_PAINEL ?>/recurso/facebook/10586/desativar" title="Desativar loja no Facebook" class="btn btn-small">Desvincular desta fanpage</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class=''>
                    <td>
                        <table class="table table-produto table-generic-list">
                            <tr>
                                <td width="50">
                                    <a target='_blank' href='https://www.facebook.com/pages/Cuilx-BR/203333776513595' >
                                    <img src='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash3/t1.0-1/p50x50/1381510_203411296505843_1463458982_t.jpg' alt='Cuilx BR' />
                                    </a>
                                </td>
                                <td>
                                    <strong>
                                    Cuilx BR
                                    </strong>
                                    <br />
                                    <small>Bem-vindo ao Cuilx
                                    www.cuilx.com.br
                                    Guia de telefones, mapas, ceps e endereços de comércios e indústrias.
                                    </small>
                                </td>
                                <td class="text-align-right">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="span2"><b>Status:</b> Desativada</div>
                                    <a class="btn btn-small" href="#modal-facebook-ativar-203333776513595" data-toggle="modal">
                                    <i class="icon-ok"></i> Associar a esta fanpage
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class=''>
                    <td>
                        <table class="table table-produto table-generic-list">
                            <tr>
                                <td width="50">
                                    <a target='_blank' href='https://www.facebook.com/pages/vialoja/564186876992925' >
                                    <img src='https://fbcdn-profile-a.akamaihd.net/static-ak/rsrc.php/v2/yg/r/LjGkeBM0ISt.png' alt='vialoja' />
                                    </a>
                                </td>
                                <td>
                                    <strong>
                                    vialoja
                                    </strong>
                                    <br />
                                    <small>Shopping Virtual</small>
                                </td>
                                <td class="text-align-right">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="span2"><b>Status:</b> Desativada</div>
                                    <a class="btn btn-small" href="#modal-facebook-ativar-564186876992925" data-toggle="modal">
                                    <i class="icon-ok"></i> Associar a esta fanpage
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class=''>
                    <td>
                        <table class="table table-produto table-generic-list">
                            <tr>
                                <td width="50">
                                    <a target='_blank' href='https://www.facebook.com/yndica' >
                                    <img src='https://fbcdn-profile-a.akamaihd.net/static-ak/rsrc.php/v2/yg/r/LjGkeBM0ISt.png' alt='Yndica' />
                                    </a>
                                </td>
                                <td>
                                    <strong>
                                    Yndica
                                    </strong>
                                    <br />
                                    <small>Yndica - Todo dia uma dica diferente</small>
                                </td>
                                <td class="text-align-right">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="span2"><b>Status:</b> Desativada</div>
                                    <a class="btn btn-small" href="#modal-facebook-ativar-369701819840120" data-toggle="modal">
                                    <i class="icon-ok"></i> Associar a esta fanpage
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div id='modal-facebook' class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Criar Página</h3>
    </div>
    <div class="modal-body">
        <h4>Instruções</h4>
        <p>
            Na janela que abrir crie sua página no Facebook, e quando estiver tudo pronto volte para o painel de controle para continuar a configuração da sua loja no Facebook.
        </p>
        <img style="border: 3px solid #EEE;" src='/admin/img/facebook-nova-pagina.jpg' akt='Nova página Facebook' />
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</button>
        <a target='_blank' href='https://www.facebook.com/pages/create.php' class="btn btn-primary"><i class="icon-plus icon-white"></i> Criar página</a>
    </div>
</div>
<div id='modal-facebook-ativar-203333776513595' class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Ativar Página</h3>
    </div>
    <div class="modal-body">
        <p>
            <strong>
            Atenção
            </strong>
            <br />
            Já existe uma página ativa, caso prossiga a mesma será desativada.
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Sair</button>
        <a href="<?php echo VIALOJA_PAINEL ?>/recurso/facebook/203333776513595/associar" class="btn btn-primary">Ativar</a>
    </div>
</div>
<div id='modal-facebook-ativar-564186876992925' class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Ativar Página</h3>
    </div>
    <div class="modal-body">
        <p>
            <strong>
            Atenção
            </strong>
            <br />
            Já existe uma página ativa, caso prossiga a mesma será desativada.
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Sair</button>
        <a href="<?php echo VIALOJA_PAINEL ?>/recurso/facebook/564186876992925/associar" class="btn btn-primary">Ativar</a>
    </div>
</div>
<div id='modal-facebook-ativar-369701819840120' class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Ativar Página</h3>
    </div>
    <div class="modal-body">
        <p>
            <strong>
            Atenção
            </strong>
            <br />
            Já existe uma página ativa, caso prossiga a mesma será desativada.
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Sair</button>
        <a href="<?php echo VIALOJA_PAINEL ?>/recurso/facebook/369701819840120/associar" class="btn btn-primary">Ativar</a>
    </div>
</div>
<div class="tutorial hide">
    <i class="icon-tutorial icon-tutorial-step">01</i>
    <img src='/admin/img/facebook-wizard/login.jpg' alt="Login facebook" />
    <div class='footer'>
        <p>
            Clique no botão de instalar o aplicativo, você sera levado ao site do Facebook, onde se necessário efetuar o
            login.
        </p>
    </div>
</div>
<div class="tutorial hide">
    <i class="icon-tutorial icon-tutorial-step">02</i>
    <img src='/admin/img/facebook-wizard/instalar.jpg' alt="Login facebook" />
    <div class='footer'>
        <p>
            Clique em "Ir para o aplicativo" para poder usar o aplicativo
        </p>
    </div>
</div>
<div class="tutorial hide">
    <i class="icon-tutorial icon-tutorial-step">03</i>
    <img src='/admin/img/facebook-wizard/auth.jpg' alt="Login facebook" />
    <div class='footer'>
        <p>
            Clique em "Permitir" e pronto!
        </p>
    </div>
</div>

