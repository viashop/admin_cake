<style type="text/css">
<!--
input[type="checkbox"]{
    margin-top: -5px !important;
}

.help-block {
    margin-top: -8px !important;
}

.facil_paypal{
    margin-left: 180px;
}
-->
</style>

<?php if ($this->request->params['pass']['2']==1): ?>
   
<script type="text/javascript">
    $(document).ready(function() {
        $('#id_mostrar_parcelamento').change(function(event) {
            $('#parcelamento').stop().slideToggle();
            $('.control-group.maximo_parcelas, .control-group.parcelas_sem_juros').stop().slideToggle();
            $('#configuracao-parcelamento').stop().slideToggle();
            $('.alert-gateway').stop().slideToggle();
        });
    
    
        $('[data-toggle=popover]').popover({'trigger': 'hover'});
    
    
        var parcelas = [];
        for (i = 0; i < $('#id_maximo_parcelas option').length; i++) {
            parcelas[i] = parseInt($('#id_maximo_parcelas option')[i].value);
        }
    
    
        $('#id_maximo_parcelas').change( function (event) {
            var parcela_selecionada    = parseInt($('#id_maximo_parcelas').val());
    
            // Desativa parcelas do parcelas_sem_juros baseado no numero maximo de parcela.
            $('#id_parcelas_sem_juros option').removeAttr('disabled');
            for (i = 1; i <= parcelas.length; i++) {
                if (parcela_selecionada != 0 && parcela_selecionada != parseInt(parcelas[parcelas.length -1])) {
                    $('#id_parcelas_sem_juros option')[0].setAttribute('disabled', 'disabled');
                    $('#id_parcelas_sem_juros option[value="' + parcela_selecionada + '"]').attr('selected', 'true');
                }
                if (parcela_selecionada > 0 && parcela_selecionada < parcelas[i]) {
                    $('#id_parcelas_sem_juros option')[i].setAttribute('disabled', 'disabled');
                }
            }
    
            renovar_simulacao('maximo');
        });
    
    
        $('#id_parcelas_sem_juros').change( function (event) {
            renovar_simulacao('sem_juros');
        });
    
    
        // Esconde ou mostra as parcelas no simulacao de parcelamento.
        function renovar_simulacao(quem_chama) {
            $('#parcelas .parcela, #parcelas .parcela-sem-juros').hide();
    
            var parcela_selecionada    = parseInt($('#id_maximo_parcelas').val()),
                parcela_sj_selecionada = parseInt($('#id_parcelas_sem_juros').val());
    
            for (i = 1; i <= parcelas.length; i++) {
                if (parcela_selecionada == 0) {
                    if (quem_chama == 'maximo') {
                        $('#parcelas .parcela-sem-juros').hide();
                        $('#parcelas .parcela').show();
                    } else {
                        $('#parcelas .parcela').show();
                        var tmp_length = $('#parcelas .parcela-sem-juros:visible').length;
                        for (j = 1; j <= tmp_length; j++) {
                            $('#parcelas .parcela.p-' + j).hide();
                        }
                    }
                }
                else if (parcela_selecionada >= parcelas[i]) {
                    $('#parcelas .parcela.p-' + parcelas[i]).show();
                    $('#parcelas .parcela-sem-juros.p-' + parcelas[i]).hide();
                }
    
                if (parcela_sj_selecionada == 0) {
                    $('#parcelas .parcela-sem-juros').show();
                    $('#parcelas .parcela').hide();
                }
                else if (parcela_sj_selecionada >= parcelas[i] ) {
                    $('#parcelas .parcela.p-' + parcelas[i]).hide();
                    $('#parcelas .parcela-sem-juros.p-' + parcelas[i]).show();
                }
            }
        }
        renovar_simulacao();
    
    
        $('#formPagamentoEditar').submit(function() {
            if($('#id_li_msg').length && !$('#id_li_msg').is(':checked') && $('#id_ativo').val() != 'False') {
                $('#modal-error .error-text').html('Você precisa confirmar que leu e seguiu os passos.');
                jQuery.removeLoader();
                $('#modal-error').modal('show');
                return false;
            }
    /*
            if($('#li_msg').length && !$('#li_msg').is(':checked')) {
                $('.aviso-li-msg').remove();
                $('#mainContent').prepend('<div class="alert alert-error aviso-li-msg"><a class="close" data-dismiss="alert">×</a> <h4>Você precisa confirmar a leitura dos passos.</h4></div>');
                return false;
            }
    */
        });
    
        
    });
</script>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar"><i class="icon-custom icon-dollar"></i> Formas de pagamento</a> <span class="bread-separator">-</span></li>
        <li><span>Configurando formas de pagamento</span></li>
    </ul>
</div>
<div class="row config-pagamento-editar">
    <form class="form-horizontal" action="/admin/configuracao/pagamento/1/configuracao/editar" method="post" id="formPagamentoEditar">
        <div class="box">
            <div class="box-header">
                <h3 class="pull-left">Forma de pagamento PagSeguro</h3>
            </div>
            <div class="box-content">
                <div class="control-group">
                    <div class="controls">
                        <img src="/admin/img/formas-de-pagamento/pagseguro-logo.png" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Pagamento ativo?</label>
                    <div class="controls">
                        <select class="input-small" id="id_ativo" name="ativo">
                            <option value="True">Sim</option>
                            <option value="False" selected="selected">Não</option>
                        </select>
                    </div>
                </div>
                <div class="convite-cadastro">
                    Ainda não tem conta no PagSeguro?<br/>
                    <a href="//pagseguro.uol.com.br/" title="Criar conta PagSeguro" class="btn btn-info btn-mini" target="_blank">cadastre-se</a>
                </div>
                <div id="forma-pagamento-corpo" class="">
                    <div class="control-group" style="margin-bottom: 0">
                        <div class="controls">
                            <div class="alert alert-danger">
                                <p>
                                    Se você não estiver conseguindo instalar a aplicação, por favor clique no botão abaixo, remova a aplicação e depois tente novamente.
                                </p>
                                <p>
                                    <a target="_blank" href="https://pagseguro.uol.com.br/aplicacao/listarAutorizacoes.jhtml" class="btn btn-danger">
                                    <i class="icon-trash icon-white"></i>
                                    Remover aplicação
                                    </a>
                                </p>
                            </div>
                            <div class="alert alert-error alert-block" id="">
                                <h4>O aplicativo do PagSeguro ainda não está instalado</h4>
                                <p>Para você conseguir efetuar vendas através do PagSeguro, instale o aplicativo clicando no botão abaixo.</p>
                                <p><a class="btn btn-primary" href="/admin/configuracao/pagamento/pagseguro/aplicacao/instalar"><i class="icon-ok icon-white"></i> Instalar aplicativo do PagSeguro</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"></div>
                        <div class="controls">
                            <div class="alert alert-info alert-block">
                                <h4>Siga atentamente nossas instruções para que o pagamento funcione corretamente.</h4>
                                <ol>
                                    <li>Clique no botão <strong>Instalar aplicativo do PagSeguro</strong> nesta página.</li>
                                    <li>Entre em sua conta no <a href="//pagseguro.uol.com.br/acesso.jhtml" title="Login no PagSeguro" target="_blank">PagSeguro</a>;</li>
                                    <li>Tenha uma conta no PagSeguro do tipo <b>Conta Vendedor</b> para prosseguir. <a href="//pagseguro.uol.com.br/account/viewDetails.jhtml" target="_blank">Clique aqui</a> para fazer esta mudança caso sua conta não seja deste tipo;</li>
                                    <li>Entre no menu <b>Preferências -> Frete</b> e depois marque a opção <strong>Frete adicional com valor fixo</strong> e coloque o valor de <strong>R$ 0,00 reais</strong> e clique em <strong>CONFIRMAR</strong> no final da página</strong>.</li>
                                </ol>
                                <p style="margin-left:28px;">
                                    <small style="line-height:1.2em;">
                                    * A integração com o PagSeguro gera custos de operação que são repassados para a Loja Integrada pelo PagSeguro (0,5%). Porém isso não altera o valor da taxa cobrada às lojas pelo PagSeguro pelas transações, 4,79%.
                                    </small>
                                </p>
                                <br />
                                <div>
                                    <label class="checkbox">
                                    <input id="id_li_msg" name="li_msg" type="checkbox" />Li e segui todos os passos.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <input type='hidden' name='csrfmiddlewaretoken' value='sRhsr7ZB9wGAmavYHaaKhutp2UfkL1C0' />
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
                <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
            </div>
        </div>
    </form>
</div>


<?php elseif ($this->request->params['pass']['2']==2): ?>

<!-- configuração bcash -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#id_mostrar_parcelamento').change(function(event) {
			$('#parcelamento').stop().slideToggle();
			$('.control-group.maximo_parcelas, .control-group.parcelas_sem_juros').stop().slideToggle();
			$('#configuracao-parcelamento').stop().slideToggle();
			$('.alert-gateway').stop().slideToggle();
		});
	
	
		$('[data-toggle=popover]').popover({'trigger': 'hover'});
	
	
		var parcelas = [];
		for (i = 0; i < $('#id_maximo_parcelas option').length; i++) {
			parcelas[i] = parseInt($('#id_maximo_parcelas option')[i].value);
		}
	
	
		$('#id_maximo_parcelas').change( function (event) {
			var parcela_selecionada    = parseInt($('#id_maximo_parcelas').val());
	
			// Desativa parcelas do parcelas_sem_juros baseado no numero maximo de parcela.
			$('#id_parcelas_sem_juros option').removeAttr('disabled');
			for (i = 1; i <= parcelas.length; i++) {
				if (parcela_selecionada != 0 && parcela_selecionada != parseInt(parcelas[parcelas.length -1])) {
					$('#id_parcelas_sem_juros option')[0].setAttribute('disabled', 'disabled');
					$('#id_parcelas_sem_juros option[value="' + parcela_selecionada + '"]').attr('selected', 'true');
				}
				if (parcela_selecionada > 0 && parcela_selecionada < parcelas[i]) {
					$('#id_parcelas_sem_juros option')[i].setAttribute('disabled', 'disabled');
				}
			}
	
			renovar_simulacao('maximo');
		});
	
	
		$('#id_parcelas_sem_juros').change( function (event) {
			renovar_simulacao('sem_juros');
		});
	
	
		// Esconde ou mostra as parcelas no simulacao de parcelamento.
		function renovar_simulacao(quem_chama) {
			$('#parcelas .parcela, #parcelas .parcela-sem-juros').hide();
	
			var parcela_selecionada    = parseInt($('#id_maximo_parcelas').val()),
				parcela_sj_selecionada = parseInt($('#id_parcelas_sem_juros').val());
	
			for (i = 1; i <= parcelas.length; i++) {
				if (parcela_selecionada == 0) {
					if (quem_chama == 'maximo') {
						$('#parcelas .parcela-sem-juros').hide();
						$('#parcelas .parcela').show();
					} else {
						$('#parcelas .parcela').show();
						var tmp_length = $('#parcelas .parcela-sem-juros:visible').length;
						for (j = 1; j <= tmp_length; j++) {
							$('#parcelas .parcela.p-' + j).hide();
						}
					}
				}
				else if (parcela_selecionada >= parcelas[i]) {
					$('#parcelas .parcela.p-' + parcelas[i]).show();
					$('#parcelas .parcela-sem-juros.p-' + parcelas[i]).hide();
				}
	
				if (parcela_sj_selecionada == 0) {
					$('#parcelas .parcela-sem-juros').show();
					$('#parcelas .parcela').hide();
				}
				else if (parcela_sj_selecionada >= parcelas[i] ) {
					$('#parcelas .parcela.p-' + parcelas[i]).hide();
					$('#parcelas .parcela-sem-juros.p-' + parcelas[i]).show();
				}
			}
		}
		renovar_simulacao();
	
	
		$('#formPagamentoEditar').submit(function() {
			if($('#id_li_msg').length && !$('#id_li_msg').is(':checked') && $('#id_ativo').val() != 'False') {
				$('#modal-error .error-text').html('Você precisa confirmar que leu e seguiu os passos.');
				jQuery.removeLoader();
				$('#modal-error').modal('show');
				return false;
			}
	/*
			if($('#li_msg').length && !$('#li_msg').is(':checked')) {
				$('.aviso-li-msg').remove();
				$('#mainContent').prepend('<div class="alert alert-error aviso-li-msg"><a class="close" data-dismiss="alert">×</a> <h4>Você precisa confirmar a leitura dos passos.</h4></div>');
				return false;
			}
	*/
		});
	
		 
		$('#id_ativo').change(function() {
			var self = $(this);
			if (self.val() == 'True') {
				$('#forma-pagamento-corpo').slideDown();
			} else {
				$('#forma-pagamento-corpo').slideUp();
			}
		}).change();
		
	});
</script>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar"><i class="icon-custom icon-dollar"></i> Formas de pagamento</a> <span class="bread-separator">-</span></li>
		<li><span>Configurando formas de pagamento</span></li>
	</ul>
</div>
<div class="row config-pagamento-editar">
	<form class="form-horizontal" action="/admin/configuracao/pagamento/2/configuracao/editar" method="post" id="formPagamentoEditar">
		<div class="box">
			<div class="box-header">
				<h3 class="pull-left">Forma de pagamento Bcash</h3>
			</div>
			<div class="box-content">
				<div class="control-group">
					<div class="controls">
						<img src="/admin/img/formas-de-pagamento/pagamento_digital-logo.png" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Pagamento ativo?</label>
					<div class="controls">
						<select class="input-small" id="id_ativo" name="ativo">
							<option value="True">Sim</option>
							<option value="False" selected="selected">Não</option>
						</select>
					</div>
				</div>
				<div class="convite-cadastro">
					Ainda não tem conta no Bcash?<br/>
					<a href="//www.bcash.com.br/" title="Criar conta Bcash" class="btn btn-info btn-mini" target="_blank">cadastre-se</a>
				</div>
				<div id="forma-pagamento-corpo" class="hide">
					<div class="control-group    usuario">
						<label class="control-label" for="id_usuario">Seu e-mail no Bcash</label>
						<div class="controls">
							<input class="span5" id="id_usuario" maxlength="128" name="usuario" type="text" />
						</div>
					</div>
					<div class="control-group    token">
						<label class="control-label" for="id_token">Sua chave de acesso</label>
						<div class="controls">
							<input class="span5" id="id_token" maxlength="32" name="token" type="text" />
						</div>
					</div>
					<div class="control-group ">
						<div class="controls">
							<label class="checkbox">
							<input id="id_mostrar_parcelamento" name="mostrar_parcelamento" type="checkbox" />
							Marque para mostrar o parcelamento na listagem dos produtos e na página do produto.
							</label>
						</div>
					</div>
					<div class="controls hide" id="configuracao-parcelamento">
						<h4>Configuração do parcelamento</h4>
						<div class="control-group">
							<div class="alert alert-error alert-gateway" style="margin-bottom: 0; display: none;">Para que o parcelamento funciona corretamente durante o pagamento do pedido, é necessário configurá-lo também no <b>Bcash</b>.
							</div>
						</div>
						<div class="control-group   hide maximo_parcelas">
							<label class="control-label" for="id_maximo_parcelas">Máximo de parcelas</label>
							<div class="controls">
								<select id="id_maximo_parcelas" name="maximo_parcelas">
									<option value="0">Todas</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
								</select>
								<p class="help-block">Quantidade máxima de parcelas para esta forma de pagamento.</p>
							</div>
						</div>
						<div class="control-group   hide parcelas_sem_juros">
							<label class="control-label" for="id_parcelas_sem_juros">Parcelas sem juros</label>
							<div class="controls">
								<select id="id_parcelas_sem_juros" name="parcelas_sem_juros">
									<option value="0">Todas</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
								</select>
								<p class="help-block">Numero de parcelas sem juros para esta forma de pagamento.</p>
							</div>
						</div>
						<div id="parcelamento" class="hide">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab-pagamento_digital" title="Parcelas Bcash" data-toggle="tab"><img src="/admin/img/formas-de-pagamento/pagamento_digital-logo.png" alt="Logomarca Bcash" /></a>
								</li>
								<li>
									<h4>Simulação de parcelamento <small>Igual ao que será mostrado na sua loja.</small></h4>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab-pagamento_digital">
									<div id="parcelas" class="itens-&lt;itertools.izip_longest object at 0xa492730&gt;">
										<ul class="pull-left">
											<li class="parcela p-1" style="display: none;">
												<p><b>1x</b> de  <b class="text-error">R$ 1.000,00</b></p>
											</li>
											<li class="parcela-sem-juros p-1" style="display: none;">
												<p><b>1x</b> de  <b class="text-error">R$ 1.000,00</b> sem juros</p>
											</li>
											<li class="parcela p-2" style="display: none;">
												<p><b>2x</b> de  <b class="text-error">R$ 520,10</b></p>
											</li>
											<li class="parcela-sem-juros p-2" style="display: none;">
												<p><b>2x</b> de  <b class="text-error">R$ 500,00</b> sem juros</p>
											</li>
											<li class="parcela p-3" style="display: none;">
												<p><b>3x</b> de  <b class="text-error">R$ 353,64</b></p>
											</li>
											<li class="parcela-sem-juros p-3" style="display: none;">
												<p><b>3x</b> de  <b class="text-error">R$ 333,00</b> sem juros</p>
											</li>
											<li class="parcela p-4" style="display: none;">
												<p><b>4x</b> de  <b class="text-error">R$ 270,50</b></p>
											</li>
											<li class="parcela-sem-juros p-4" style="display: none;">
												<p><b>4x</b> de  <b class="text-error">R$ 250,00</b> sem juros</p>
											</li>
											<li class="parcela p-5" style="display: none;">
												<p><b>5x</b> de  <b class="text-error">R$ 220,71</b></p>
											</li>
											<li class="parcela-sem-juros p-5" style="display: none;">
												<p><b>5x</b> de  <b class="text-error">R$ 200,00</b> sem juros</p>
											</li>
											<li class="parcela p-6" style="display: none;">
												<p><b>6x</b> de  <b class="text-error">R$ 187,58</b></p>
											</li>
											<li class="parcela-sem-juros p-6" style="display: none;">
												<p><b>6x</b> de  <b class="text-error">R$ 166,00</b> sem juros</p>
											</li>
										</ul>
										<ul class="pull-left">
											<li class="parcela p-7" style="display: none;">
												<p><b>7x</b> de  <b class="text-error">R$ 163,98</b></p>
											</li>
											<li class="parcela-sem-juros p-7" style="display: none;">
												<p><b>7x</b> de  <b class="text-error">R$ 142,00</b> sem juros</p>
											</li>
											<li class="parcela p-8" style="display: none;">
												<p><b>8x</b> de  <b class="text-error">R$ 146,34</b></p>
											</li>
											<li class="parcela-sem-juros p-8" style="display: none;">
												<p><b>8x</b> de  <b class="text-error">R$ 125,00</b> sem juros</p>
											</li>
											<li class="parcela p-9" style="display: none;">
												<p><b>9x</b> de  <b class="text-error">R$ 132,67</b></p>
											</li>
											<li class="parcela-sem-juros p-9" style="display: none;">
												<p><b>9x</b> de  <b class="text-error">R$ 111,00</b> sem juros</p>
											</li>
											<li class="parcela p-10" style="display: none;">
												<p><b>10x</b> de  <b class="text-error">R$ 121,78</b></p>
											</li>
											<li class="parcela-sem-juros p-10" style="display: none;">
												<p><b>10x</b> de  <b class="text-error">R$ 100,00</b> sem juros</p>
											</li>
											<li class="parcela p-11" style="display: none;">
												<p><b>11x</b> de  <b class="text-error">R$ 112,91</b></p>
											</li>
											<li class="parcela-sem-juros p-11" style="display: none;">
												<p><b>11x</b> de  <b class="text-error">R$ 90,00</b> sem juros</p>
											</li>
											<li class="parcela p-12" style="display: none;">
												<p><b>12x</b> de  <b class="text-error">R$ 105,56</b></p>
											</li>
											<li class="parcela-sem-juros p-12" style="display: none;">
												<p><b>12x</b> de  <b class="text-error">R$ 83,00</b> sem juros</p>
											</li>
										</ul>
										<ul class="pull-left">
											<li class="parcela p-13" style="display: none;">
												<p><b>13x</b> de  <b class="text-error">R$ 99,38</b></p>
											</li>
											<li class="parcela-sem-juros p-13" style="display: none;">
												<p><b>13x</b> de  <b class="text-error">R$ 76,00</b> sem juros</p>
											</li>
											<li class="parcela p-14" style="display: none;">
												<p><b>14x</b> de  <b class="text-error">R$ 94,12</b></p>
											</li>
											<li class="parcela-sem-juros p-14" style="display: none;">
												<p><b>14x</b> de  <b class="text-error">R$ 71,00</b> sem juros</p>
											</li>
											<li class="parcela p-15" style="display: none;">
												<p><b>15x</b> de  <b class="text-error">R$ 89,59</b></p>
											</li>
											<li class="parcela-sem-juros p-15" style="display: none;">
												<p><b>15x</b> de  <b class="text-error">R$ 66,00</b> sem juros</p>
											</li>
											<li class="parcela p-16" style="display: none;">
												<p><b>16x</b> de  <b class="text-error">R$ 85,66</b></p>
											</li>
											<li class="parcela-sem-juros p-16" style="display: none;">
												<p><b>16x</b> de  <b class="text-error">R$ 62,00</b> sem juros</p>
											</li>
											<li class="parcela p-17" style="display: none;">
												<p><b>17x</b> de  <b class="text-error">R$ 82,23</b></p>
											</li>
											<li class="parcela-sem-juros p-17" style="display: none;">
												<p><b>17x</b> de  <b class="text-error">R$ 58,00</b> sem juros</p>
											</li>
											<li class="parcela p-18" style="display: none;">
												<p><b>18x</b> de  <b class="text-error">R$ 79,21</b></p>
											</li>
											<li class="parcela-sem-juros p-18" style="display: none;">
												<p><b>18x</b> de  <b class="text-error">R$ 55,00</b> sem juros</p>
											</li>
										</ul>
										<ul class="pull-left">
											<li class="parcela p-19" style="display: none;">
												<p><b>19x</b> de  <b class="text-error">R$ 76,53</b></p>
											</li>
											<li class="parcela-sem-juros p-19" style="display: none;">
												<p><b>19x</b> de  <b class="text-error">R$ 52,00</b> sem juros</p>
											</li>
											<li class="parcela p-20" style="display: none;">
												<p><b>20x</b> de  <b class="text-error">R$ 74,15</b></p>
											</li>
											<li class="parcela-sem-juros p-20" style="display: none;">
												<p><b>20x</b> de  <b class="text-error">R$ 50,00</b> sem juros</p>
											</li>
											<li class="parcela p-21" style="display: none;">
												<p><b>21x</b> de  <b class="text-error">R$ 72,03</b></p>
											</li>
											<li class="parcela-sem-juros p-21" style="display: none;">
												<p><b>21x</b> de  <b class="text-error">R$ 47,00</b> sem juros</p>
											</li>
											<li class="parcela p-22" style="display: none;">
												<p><b>22x</b> de  <b class="text-error">R$ 70,12</b></p>
											</li>
											<li class="parcela-sem-juros p-22" style="display: none;">
												<p><b>22x</b> de  <b class="text-error">R$ 45,00</b> sem juros</p>
											</li>
											<li class="parcela p-23" style="display: none;">
												<p><b>23x</b> de  <b class="text-error">R$ 68,41</b></p>
											</li>
											<li class="parcela-sem-juros p-23" style="display: none;">
												<p><b>23x</b> de  <b class="text-error">R$ 43,00</b> sem juros</p>
											</li>
											<li class="parcela p-24" style="display: none;">
												<p><b>24x</b> de  <b class="text-error">R$ 66,86</b></p>
											</li>
											<li class="parcela-sem-juros p-24" style="display: none;">
												<p><b>24x</b> de  <b class="text-error">R$ 41,00</b> sem juros</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label"></div>
						<div class="controls">
							<div class="alert alert-info alert-block">
								<h4>Siga atentamente nossas instruções para que o pagamento funcione corretamente.</h4>
								<ol>
									<li>Preencha o campo <strong>Seu email no Bcash</strong> com seu email de cadastro no Bcash;</li>
									<li>Entre em sua conta no <a href="//www.bcash.com.br/" title="Criar conta no Bcash" target="_blank">Bcash</a>;</li>
									<li>Entre no menu <strong>Ferramentas -> Código de Integração</strong> e copie <strong>Sua Chave acesso</strong> e cole no campo <b>Sua Chave acesso</b> nesta página;</li>
									<li>Na mesma página onde você adquiriu a Sua Chave acesso, tem um campo chamado <strong>URL de retorno da sua loja</strong>, preencha com <b>http://casaclanels.vialoja.com.br/pagamentodigital/notificacao</b> e deixe o campo <strong>URL de aviso da sua loja</strong> em branco.</li>
								</ol>
								<div>
									<label class="checkbox">
									<input id="id_li_msg" name="li_msg" type="checkbox" />Li e segui todos os passos.
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<input type='hidden' name='csrfmiddlewaretoken' value='sRhsr7ZB9wGAmavYHaaKhutp2UfkL1C0' />
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
				<a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
			</div>
		</div>
	</form>
</div>

<?php elseif ($this->request->params['pass']['2']==3): ?>


<!-- paypal -->


<script type="text/javascript">
	$(document).ready(function() {
		$('#id_mostrar_parcelamento').change(function(event) {
			$('#parcelamento').stop().slideToggle();
			$('.control-group.maximo_parcelas, .control-group.parcelas_sem_juros').stop().slideToggle();
			$('#configuracao-parcelamento').stop().slideToggle();
			$('.alert-gateway').stop().slideToggle();
		});
	
	
		$('[data-toggle=popover]').popover({'trigger': 'hover'});
	
	
		var parcelas = [];
		for (i = 0; i < $('#id_maximo_parcelas option').length; i++) {
			parcelas[i] = parseInt($('#id_maximo_parcelas option')[i].value);
		}
	
	
		$('#id_maximo_parcelas').change( function (event) {
			var parcela_selecionada    = parseInt($('#id_maximo_parcelas').val());
	
			// Desativa parcelas do parcelas_sem_juros baseado no numero maximo de parcela.
			$('#id_parcelas_sem_juros option').removeAttr('disabled');
			for (i = 1; i <= parcelas.length; i++) {
				if (parcela_selecionada != 0 && parcela_selecionada != parseInt(parcelas[parcelas.length -1])) {
					$('#id_parcelas_sem_juros option')[0].setAttribute('disabled', 'disabled');
					$('#id_parcelas_sem_juros option[value="' + parcela_selecionada + '"]').attr('selected', 'true');
				}
				if (parcela_selecionada > 0 && parcela_selecionada < parcelas[i]) {
					$('#id_parcelas_sem_juros option')[i].setAttribute('disabled', 'disabled');
				}
			}
	
			renovar_simulacao('maximo');
		});
	
	
		$('#id_parcelas_sem_juros').change( function (event) {
			renovar_simulacao('sem_juros');
		});
	
	
		// Esconde ou mostra as parcelas no simulacao de parcelamento.
		function renovar_simulacao(quem_chama) {
			$('#parcelas .parcela, #parcelas .parcela-sem-juros').hide();
	
			var parcela_selecionada    = parseInt($('#id_maximo_parcelas').val()),
				parcela_sj_selecionada = parseInt($('#id_parcelas_sem_juros').val());
	
			for (i = 1; i <= parcelas.length; i++) {
				if (parcela_selecionada == 0) {
					if (quem_chama == 'maximo') {
						$('#parcelas .parcela-sem-juros').hide();
						$('#parcelas .parcela').show();
					} else {
						$('#parcelas .parcela').show();
						var tmp_length = $('#parcelas .parcela-sem-juros:visible').length;
						for (j = 1; j <= tmp_length; j++) {
							$('#parcelas .parcela.p-' + j).hide();
						}
					}
				}
				else if (parcela_selecionada >= parcelas[i]) {
					$('#parcelas .parcela.p-' + parcelas[i]).show();
					$('#parcelas .parcela-sem-juros.p-' + parcelas[i]).hide();
				}
	
				if (parcela_sj_selecionada == 0) {
					$('#parcelas .parcela-sem-juros').show();
					$('#parcelas .parcela').hide();
				}
				else if (parcela_sj_selecionada >= parcelas[i] ) {
					$('#parcelas .parcela.p-' + parcelas[i]).hide();
					$('#parcelas .parcela-sem-juros.p-' + parcelas[i]).show();
				}
			}
		}
		renovar_simulacao();
	
	
		$('#formPagamentoEditar').submit(function() {
			if($('#id_li_msg').length && !$('#id_li_msg').is(':checked') && $('#id_ativo').val() != 'False') {
				$('#modal-error .error-text').html('Você precisa confirmar que leu e seguiu os passos.');
				jQuery.removeLoader();
				$('#modal-error').modal('show');
				return false;
			}
	/*
			if($('#li_msg').length && !$('#li_msg').is(':checked')) {
				$('.aviso-li-msg').remove();
				$('#mainContent').prepend('<div class="alert alert-error aviso-li-msg"><a class="close" data-dismiss="alert">×</a> <h4>Você precisa confirmar a leitura dos passos.</h4></div>');
				return false;
			}
	*/
		});
	
		 
		$('#id_ativo').change(function() {
			var self = $(this);
			if (self.val() == 'True') {
				$('#forma-pagamento-corpo').slideDown();
			} else {
				$('#forma-pagamento-corpo').slideUp();
			}
		}).change();
		
	});
</script>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar"><i class="icon-custom icon-dollar"></i> Formas de pagamento</a> <span class="bread-separator">-</span></li>
		<li><span>Configurando formas de pagamento</span></li>
	</ul>
</div>
<div class="row config-pagamento-editar">
	<form class="form-horizontal" action="/admin/configuracao/pagamento/3/configuracao/editar" method="post" id="formPagamentoEditar">
		<div class="box">
			<div class="box-header">
				<h3 class="pull-left">Forma de pagamento PayPal</h3>
			</div>
			<div class="box-content">

				<div class="control-group">
					<div class="controls">
						<img src="/admin/img/formas-de-pagamento/paypal-logo.png" />
					</div>
				</div>
                <hr />

                <div class="control-group facil_paypal">
                    <h3>É seguro. É fácil. É PayPal</h3>
                    <p>São mais de 140 milhões de clientes no mundo todo comprando com segurança e facilidade.</p>
                    <p>Saiba mais <a href="https://www.paypal.com/br/webapps/mpp/accept-payments-online" target="_blank">aqui</a></p>

                </div>

                <hr />

				<div class="control-group">
					<label class="control-label">Pagamento ativo?</label>
					<div class="controls">
						<select class="input-small" id="id_ativo" name="ativo">
							<option value="True" selected="selected">Sim</option>
							<option value="False">Não</option>
						</select>
					</div>
				</div>
				<div class="convite-cadastro">
					Ainda não tem conta no PayPal?<br/>
					<a href="http://www.paypal.com.br/" title="Criar conta no PayPal" class="btn btn-info btn-mini" target="_blank">cadastre-se</a>
				</div>

				<div id="forma-pagamento-corpo" class="">
                    <hr />
					<div class="control-group    usuario">
						<label class="control-label" for="id_usuario">Seu usuário Paypal</label>
						<div class="controls">
							<input class="span6" id="id_usuario" maxlength="128" name="usuario" type="text" />
						</div>
					</div>
                    <hr />
                    <div class="control-group    usuario">
                        <label class="control-label" for="id_usuario">Valor mínimo</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">R$</span>
                                <input class="input-price" style="width:100px;" id="id_xxx_valor" name="xxx_valor" type="text" value="" />
                                <p class="help-block">Informe o valor mínimo para exibir esta forma de pagamento.</p>

                            </div>

                        </div>
                    </div>

                    <hr />
                    <div class="control-group    usuario">
                        <label class="control-label" for="id_usuario">Valor mínimo da parcela</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">R$</span>
                                <input class="input-price" style="width:100px;" id="id_xxx_valor" name="xxx_valor" type="text" value="" />
                                
                            </div>

                        </div>
                    </div>

                    <hr>
                   
					<div class="control-group ">
						<div class="controls">
							<label class="checkbox">
							<input id="id_mostrar_parcelamento" name="mostrar_parcelamento" type="checkbox" />
							Marque para mostrar o parcelamento na listagem dos produtos e na página do produto.
							</label>
						</div>
					</div>
					<div class="controls hide" id="configuracao-parcelamento">
						<h4>Configuração do parcelamento</h4>
						<div class="control-group">
							<div class="alert alert-error alert-gateway" style="margin-bottom: 0; display: none;">Para que o parcelamento funciona corretamente durante o pagamento do pedido, é necessário configurá-lo também no <b>PayPal</b>.
							</div>
						</div>
						<div class="control-group   hide maximo_parcelas">
							<label class="control-label" for="id_maximo_parcelas">Máximo de parcelas</label>
							<div class="controls">
								<select id="id_maximo_parcelas" name="maximo_parcelas">
									<option value="0">Todas</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select>
								<p class="help-block">Quantidade máxima de parcelas para esta forma de pagamento.</p>
							</div>
						</div>
						<div class="control-group   hide parcelas_sem_juros">
							<label class="control-label" for="id_parcelas_sem_juros">Parcelas sem juros</label>
							<div class="controls">
								<select id="id_parcelas_sem_juros" name="parcelas_sem_juros">
									<option value="0">Todas</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select>
								<p class="help-block">Numero de parcelas sem juros para esta forma de pagamento.</p>
							</div>
						</div>
						<div id="parcelamento" class="hide">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab-paypal" title="Parcelas PayPal" data-toggle="tab"><img src="/admin/img/formas-de-pagamento/paypal-logo.png" alt="Logomarca PayPal" /></a>
								</li>
								<li>
									<h4>Simulação de parcelamento <small>Igual ao que será mostrado na sua loja.</small></h4>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab-paypal">
									<div id="parcelas" class="itens-&lt;itertools.izip_longest object at 0x7612a48&gt;">
										<ul class="pull-left">
											<li class="parcela p-1" style="display: none;">
												<p><b>1x</b> de  <b class="text-error">R$ 1.000,00</b></p>
											</li>
											<li class="parcela-sem-juros p-1" style="display: none;">
												<p><b>1x</b> de  <b class="text-error">R$ 1.000,00</b> sem juros</p>
											</li>
											<li class="parcela p-2" style="display: none;">
												<p><b>2x</b> de  <b class="text-error">R$ 527,50</b></p>
											</li>
											<li class="parcela-sem-juros p-2" style="display: none;">
												<p><b>2x</b> de  <b class="text-error">R$ 500,00</b> sem juros</p>
											</li>
											<li class="parcela p-3" style="display: none;">
												<p><b>3x</b> de  <b class="text-error">R$ 353,33</b></p>
											</li>
											<li class="parcela-sem-juros p-3" style="display: none;">
												<p><b>3x</b> de  <b class="text-error">R$ 333,00</b> sem juros</p>
											</li>
											<li class="parcela p-4" style="display: none;">
												<p><b>4x</b> de  <b class="text-error">R$ 266,25</b></p>
											</li>
											<li class="parcela-sem-juros p-4" style="display: none;">
												<p><b>4x</b> de  <b class="text-error">R$ 250,00</b> sem juros</p>
											</li>
										</ul>
										<ul class="pull-left">
											<li class="parcela p-5" style="display: none;">
												<p><b>5x</b> de  <b class="text-error">R$ 215,00</b></p>
											</li>
											<li class="parcela-sem-juros p-5" style="display: none;">
												<p><b>5x</b> de  <b class="text-error">R$ 200,00</b> sem juros</p>
											</li>
											<li class="parcela p-6" style="display: none;">
												<p><b>6x</b> de  <b class="text-error">R$ 180,83</b></p>
											</li>
											<li class="parcela-sem-juros p-6" style="display: none;">
												<p><b>6x</b> de  <b class="text-error">R$ 166,00</b> sem juros</p>
											</li>
											<li class="parcela p-7" style="display: none;">
												<p><b>7x</b> de  <b class="text-error">R$ 156,43</b></p>
											</li>
											<li class="parcela-sem-juros p-7" style="display: none;">
												<p><b>7x</b> de  <b class="text-error">R$ 142,00</b> sem juros</p>
											</li>
											<li class="parcela p-8" style="display: none;">
												<p><b>8x</b> de  <b class="text-error">R$ 138,12</b></p>
											</li>
											<li class="parcela-sem-juros p-8" style="display: none;">
												<p><b>8x</b> de  <b class="text-error">R$ 125,00</b> sem juros</p>
											</li>
										</ul>
										<ul class="pull-left">
											<li class="parcela p-9" style="display: none;">
												<p><b>9x</b> de  <b class="text-error">R$ 123,89</b></p>
											</li>
											<li class="parcela-sem-juros p-9" style="display: none;">
												<p><b>9x</b> de  <b class="text-error">R$ 111,00</b> sem juros</p>
											</li>
											<li class="parcela p-10" style="display: none;">
												<p><b>10x</b> de  <b class="text-error">R$ 112,50</b></p>
											</li>
											<li class="parcela-sem-juros p-10" style="display: none;">
												<p><b>10x</b> de  <b class="text-error">R$ 100,00</b> sem juros</p>
											</li>
											<li class="parcela p-11" style="display: none;">
												<p><b>11x</b> de  <b class="text-error">R$ 102,72</b></p>
											</li>
											<li class="parcela-sem-juros p-11" style="display: none;">
												<p><b>11x</b> de  <b class="text-error">R$ 90,00</b> sem juros</p>
											</li>
											<li class="parcela p-12" style="display: none;">
												<p><b>12x</b> de  <b class="text-error">R$ 94,58</b></p>
											</li>
											<li class="parcela-sem-juros p-12" style="display: none;">
												<p><b>12x</b> de  <b class="text-error">R$ 83,00</b> sem juros</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<input type='hidden' name='csrfmiddlewaretoken' value='sRhsr7ZB9wGAmavYHaaKhutp2UfkL1C0' />
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
				<a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
			</div>
		</div>
	</form>
</div>

<?php elseif ($this->request->params['pass']['2']==5): ?>

<!-- mercado pago -->



<script type="text/javascript">
	$(document).ready(function() {
		$('#id_mostrar_parcelamento').change(function(event) {
			$('#parcelamento').stop().slideToggle();
			$('.control-group.maximo_parcelas, .control-group.parcelas_sem_juros').stop().slideToggle();
			$('#configuracao-parcelamento').stop().slideToggle();
			$('.alert-gateway').stop().slideToggle();
		});
	
	
		$('[data-toggle=popover]').popover({'trigger': 'hover'});
	
	
		var parcelas = [];
		for (i = 0; i < $('#id_maximo_parcelas option').length; i++) {
			parcelas[i] = parseInt($('#id_maximo_parcelas option')[i].value);
		}
	
	
		$('#id_maximo_parcelas').change( function (event) {
			var parcela_selecionada    = parseInt($('#id_maximo_parcelas').val());
	
			// Desativa parcelas do parcelas_sem_juros baseado no numero maximo de parcela.
			$('#id_parcelas_sem_juros option').removeAttr('disabled');
			for (i = 1; i <= parcelas.length; i++) {
				if (parcela_selecionada != 0 && parcela_selecionada != parseInt(parcelas[parcelas.length -1])) {
					$('#id_parcelas_sem_juros option')[0].setAttribute('disabled', 'disabled');
					$('#id_parcelas_sem_juros option[value="' + parcela_selecionada + '"]').attr('selected', 'true');
				}
				if (parcela_selecionada > 0 && parcela_selecionada < parcelas[i]) {
					$('#id_parcelas_sem_juros option')[i].setAttribute('disabled', 'disabled');
				}
			}
	
			renovar_simulacao('maximo');
		});
	
	
		$('#id_parcelas_sem_juros').change( function (event) {
			renovar_simulacao('sem_juros');
		});
	
	
		// Esconde ou mostra as parcelas no simulacao de parcelamento.
		function renovar_simulacao(quem_chama) {
			$('#parcelas .parcela, #parcelas .parcela-sem-juros').hide();
	
			var parcela_selecionada    = parseInt($('#id_maximo_parcelas').val()),
				parcela_sj_selecionada = parseInt($('#id_parcelas_sem_juros').val());
	
			for (i = 1; i <= parcelas.length; i++) {
				if (parcela_selecionada == 0) {
					if (quem_chama == 'maximo') {
						$('#parcelas .parcela-sem-juros').hide();
						$('#parcelas .parcela').show();
					} else {
						$('#parcelas .parcela').show();
						var tmp_length = $('#parcelas .parcela-sem-juros:visible').length;
						for (j = 1; j <= tmp_length; j++) {
							$('#parcelas .parcela.p-' + j).hide();
						}
					}
				}
				else if (parcela_selecionada >= parcelas[i]) {
					$('#parcelas .parcela.p-' + parcelas[i]).show();
					$('#parcelas .parcela-sem-juros.p-' + parcelas[i]).hide();
				}
	
				if (parcela_sj_selecionada == 0) {
					$('#parcelas .parcela-sem-juros').show();
					$('#parcelas .parcela').hide();
				}
				else if (parcela_sj_selecionada >= parcelas[i] ) {
					$('#parcelas .parcela.p-' + parcelas[i]).hide();
					$('#parcelas .parcela-sem-juros.p-' + parcelas[i]).show();
				}
			}
		}
		renovar_simulacao();
	
	
		$('#formPagamentoEditar').submit(function() {
			if($('#id_li_msg').length && !$('#id_li_msg').is(':checked') && $('#id_ativo').val() != 'False') {
				$('#modal-error .error-text').html('Você precisa confirmar que leu e seguiu os passos.');
				jQuery.removeLoader();
				$('#modal-error').modal('show');
				return false;
			}
	/*
			if($('#li_msg').length && !$('#li_msg').is(':checked')) {
				$('.aviso-li-msg').remove();
				$('#mainContent').prepend('<div class="alert alert-error aviso-li-msg"><a class="close" data-dismiss="alert">×</a> <h4>Você precisa confirmar a leitura dos passos.</h4></div>');
				return false;
			}
	*/
		});
	
		 
		$('#id_ativo').change(function() {
			var self = $(this);
			if (self.val() == 'True') {
				$('#forma-pagamento-corpo').slideDown();
			} else {
				$('#forma-pagamento-corpo').slideUp();
			}
		}).change();
		
	});
</script>
 

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar"><i class="icon-custom icon-dollar"></i> Formas de pagamento</a> <span class="bread-separator">-</span></li>
		<li><span>Configurando formas de pagamento</span></li>
	</ul>
</div>
<div class="row config-pagamento-editar">
	<form class="form-horizontal" action="/admin/configuracao/pagamento/4/configuracao/editar" method="post" id="formPagamentoEditar">
		<div class="box">
			<div class="box-header">
				<h3 class="pull-left">Forma de pagamento MercadoPago</h3>
			</div>
			<div class="box-content">
				<div class="control-group">
					<div class="controls">
						<img src="/admin/img/formas-de-pagamento/mercado_pago-logo.png" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Pagamento ativo?</label>
					<div class="controls">
						<select class="input-small" id="id_ativo" name="ativo">
							<option value="True">Sim</option>
							<option value="False" selected="selected">Não</option>
						</select>
					</div>
				</div>
				<div class="convite-cadastro">
					Ainda não tem conta no MercadoPago?<br/>
					<a href="//registration-br.mercadopago.com/registration-mp?mode=mp" title="Criar conta MercadoPago" class="btn btn-info btn-mini" target="_blank">cadastre-se</a>
				</div>
				<div id="forma-pagamento-corpo" class="hide">
					<div class="control-group    usuario">
						<label class="control-label" for="id_usuario">Credencial - Client_id</label>
						<div class="controls">
							<input class="span5" id="id_usuario" maxlength="128" name="usuario" type="text" />
						</div>
					</div>
					<div class="control-group    senha">
						<label class="control-label" for="id_senha">Credencial - Client_secret</label>
						<div class="controls">
							<input class="span5" id="id_senha" maxlength="128" name="senha" type="text" />
						</div>
					</div>
					<div class="control-group ">
						<div class="controls">
							<label class="checkbox">
							<input id="id_mostrar_parcelamento" name="mostrar_parcelamento" type="checkbox" />
							Marque para mostrar o parcelamento na listagem dos produtos e na página do produto.
							</label>
						</div>
					</div>
					<div class="controls hide" id="configuracao-parcelamento">
						<h4>Configuração do parcelamento</h4>
						<div class="control-group">
							<div class="alert alert-error alert-gateway" style="margin-bottom: 0; display: none;">
								Para que o parcelamento funciona corretamente durante o pagamento do pedido, é necessário configurá-lo também no <b>MercadoPago</b>.
								<p>
									As opções de parcelamento para o MercadoPago são:
									<strong>1, 3, 6, 9, 12, 15 e 24 vezes.</strong>
								</p>
							</div>
						</div>
						<div class="control-group   hide maximo_parcelas">
							<label class="control-label" for="id_maximo_parcelas">Máximo de parcelas</label>
							<div class="controls">
								<select id="id_maximo_parcelas" name="maximo_parcelas">
									<option value="0">Todas</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="12">12</option>
									<option value="15">15</option>
									<option value="18">18</option>
									<option value="24">24</option>
								</select>
								<p class="help-block">Quantidade máxima de parcelas para esta forma de pagamento.</p>
							</div>
						</div>
						<div class="control-group   hide parcelas_sem_juros">
							<label class="control-label" for="id_parcelas_sem_juros">Parcelas sem juros</label>
							<div class="controls">
								<select id="id_parcelas_sem_juros" name="parcelas_sem_juros">
									<option value="0">Todas</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="12">12</option>
									<option value="15">15</option>
									<option value="18">18</option>
									<option value="24">24</option>
								</select>
								<p class="help-block">Numero de parcelas sem juros para esta forma de pagamento.</p>
							</div>
						</div>
						<div id="parcelamento" class="hide">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab-mercado_pago" title="Parcelas MercadoPago" data-toggle="tab"><img src="/admin/img/formas-de-pagamento/mercado_pago-logo.png" alt="Logomarca MercadoPago" /></a>
								</li>
								<li>
									<h4>Simulação de parcelamento <small>Igual ao que será mostrado na sua loja.</small></h4>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab-mercado_pago">
									<div id="parcelas" class="itens-&lt;itertools.izip_longest object at 0x7f85a0112c00&gt;">
										<ul class="pull-left">
											<li class="parcela p-1" style="display: none;">
												<p><b>1x</b> de  <b class="text-error">R$ 1.000,00</b></p>
											</li>
											<li class="parcela-sem-juros p-1" style="display: none;">
												<p><b>1x</b> de  <b class="text-error">R$ 1.000,00</b> sem juros</p>
											</li>
											<li class="parcela p-2" style="display: none;">
												<p><b>2x</b> de  <b class="text-error">R$ 515,10</b></p>
											</li>
											<li class="parcela-sem-juros p-2" style="display: none;">
												<p><b>2x</b> de  <b class="text-error">R$ 500,00</b> sem juros</p>
											</li>
											<li class="parcela p-3" style="display: none;">
												<p><b>3x</b> de  <b class="text-error">R$ 346,70</b></p>
											</li>
											<li class="parcela-sem-juros p-3" style="display: none;">
												<p><b>3x</b> de  <b class="text-error">R$ 333,00</b> sem juros</p>
											</li>
											<li class="parcela p-4" style="display: none;">
												<p><b>4x</b> de  <b class="text-error">R$ 262,50</b></p>
											</li>
											<li class="parcela-sem-juros p-4" style="display: none;">
												<p><b>4x</b> de  <b class="text-error">R$ 250,00</b> sem juros</p>
											</li>
										</ul>
										<ul class="pull-left">
											<li class="parcela p-5" style="display: none;">
												<p><b>5x</b> de  <b class="text-error">R$ 212,10</b></p>
											</li>
											<li class="parcela-sem-juros p-5" style="display: none;">
												<p><b>5x</b> de  <b class="text-error">R$ 200,00</b> sem juros</p>
											</li>
											<li class="parcela p-6" style="display: none;">
												<p><b>6x</b> de  <b class="text-error">R$ 178,50</b></p>
											</li>
											<li class="parcela-sem-juros p-6" style="display: none;">
												<p><b>6x</b> de  <b class="text-error">R$ 166,00</b> sem juros</p>
											</li>
											<li class="parcela p-9" style="display: none;">
												<p><b>9x</b> de  <b class="text-error">R$ 122,50</b></p>
											</li>
											<li class="parcela-sem-juros p-9" style="display: none;">
												<p><b>9x</b> de  <b class="text-error">R$ 111,00</b> sem juros</p>
											</li>
											<li class="parcela p-10" style="display: none;">
												<p><b>10x</b> de  <b class="text-error">R$ 111,20</b></p>
											</li>
											<li class="parcela-sem-juros p-10" style="display: none;">
												<p><b>10x</b> de  <b class="text-error">R$ 100,00</b> sem juros</p>
											</li>
										</ul>
										<ul class="pull-left">
											<li class="parcela p-12" style="display: none;">
												<p><b>12x</b> de  <b class="text-error">R$ 94,50</b></p>
											</li>
											<li class="parcela-sem-juros p-12" style="display: none;">
												<p><b>12x</b> de  <b class="text-error">R$ 83,00</b> sem juros</p>
											</li>
											<li class="parcela p-15" style="display: none;">
												<p><b>15x</b> de  <b class="text-error">R$ 77,80</b></p>
											</li>
											<li class="parcela-sem-juros p-15" style="display: none;">
												<p><b>15x</b> de  <b class="text-error">R$ 66,00</b> sem juros</p>
											</li>
											<li class="parcela p-18" style="display: none;">
												<p><b>18x</b> de  <b class="text-error">R$ 66,60</b></p>
											</li>
											<li class="parcela-sem-juros p-18" style="display: none;">
												<p><b>18x</b> de  <b class="text-error">R$ 55,00</b> sem juros</p>
											</li>
											<li class="parcela p-24" style="display: none;">
												<p><b>24x</b> de  <b class="text-error">R$ 52,10</b></p>
											</li>
											<li class="parcela-sem-juros p-24" style="display: none;">
												<p><b>24x</b> de  <b class="text-error">R$ 41,00</b> sem juros</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label"></div>
						<div class="controls">
							<div class="alert alert-info alert-block">
								<h4>Siga atentamente nossas instruções para que o pagamento funcione corretamente.</h4>
								<ol>
									<li>Entre em sua conta do <a href="http://www.mercadopago.com/mp-brasil/" title="Login MercadoPago" target="+">MercadoPago</a>;</li>
									<li>Acesse o link <a href="//www.mercadopago.com/mlb/ferramentas/aplicacoes" title="" target="_blank">https://www.mercadopago.com/mlb/ferramentas/aplicacoes</a>;</li>
									<li>Pegue os dados <b>Client_id</b> e <b>Cliente_secret</b> e preencha nos campos de mesmo nome nesta página;</li>
									<li>Acesse o link <a href="//www.mercadopago.com/mlb/ferramentas/notificacoes" title="" target="_blank">https://www.mercadopago.com/mlb/ferramentas/notificacoes</a> e no campo <b>chamado URL para notificação</b> preencha com <b>http://casaclanels.vialoja.com.br/mercadopago/notificacao</b>.</li>
								</ol>
								<div>
									<label class="checkbox">
									<input id="id_li_msg" name="li_msg" type="checkbox" />Li e segui todos os passos.
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
                <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
				<a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
			</div>
		</div>
	</form>
</div>
    
<?php endif ?>
