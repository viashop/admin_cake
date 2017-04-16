<style type="text/css">
	
.mercadolivre-perguntas .responder { margin-right: 36px; }

.mercadolivre-perguntas .remover { margin-right: 36px; }

</style>

<script type='text/javascript'>
	$(document).ready(function(){
		$('#mostrar_tudo').change(function(event){
			event.preventDefault();
			$('.pergunta.respondida').slideToggle('fast');
		}).change();
		$('.mostrar-responder-pergunta').click(function(event){
			event.preventDefault();
			$(this).parent().find('.responder-pergunta').show('normal');
			$(this).hide();
		});
		$('a.calcular-frete').click(function(event){
			event.preventDefault();
			$(this).parent().find('div.calcular-frete').slideToggle();
			$(this).parent().find('.id_cep').focus();
		});
		$('.inserir-cep').click(function(event){
			event.preventDefault();
			var url = '/admin/recurso/mercadolivre/calcular/frete';
			var cep = $(this).parent().find('.id_cep').val();
			var textarea = $(this).parents('li').find('textarea');
			var input_cep = $(this).parent().parent();
			if(cep == '') {
				return false;
			}
			var produto = $(this).data('item');
			$.post(url, {referencia: produto, cep: cep}, function(data) {
				textarea.val(textarea.val() + data);
				input_cep.hide('normal');
			});
		});
		$('.sugestao-frete').click(function(event) {
			event.preventDefault();
			var url = '/admin/recurso/mercadolivre/calcular/frete';
			var cep = $(this).data('cep');
			var item = $(this).data('item');
			var that = $(this);
			$.get(url, {cep: cep, referencia: item}, function(data) {
				var input = that.parents('.resposta').find('textarea');
				var antigo =  input.val();
				input.val(data + antigo);
			});
		});
		$('.id_cep').mask('99999-999', {
			completed: function(event){
				$(this).parent().find('.inserir-cep').removeClass('disabled');
			}
		});
		$('a.responder').click(function(event){
			event.preventDefault();
			var botao = $(this);
			var resposta = $(this).parents('li').find('textarea').val();
			var pergunta_id = $(this).parents('li').attr('id');
			var url = '/admin/recurso/mercadolivre/perguntas/resposta/';
			$.post(url, {pergunta_id: pergunta_id, resposta:resposta}, function(data){
				var dados = $.parseJSON(data);
				if (dados.status == 'erro'){
					alert(dados.message);
					// console.log(dados);
				}else{
					// escondendo, já respondemos!
					botao.parents('li').hide('normal', function(){
						var p = botao.parents('li');
						botao.parents('li').html('<strong class="alert alert-info">Pergunta respondida com sucesso!</strong>')
						p.show('normal');
					});
				}
			});
	
		})
	});
</script>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><span>Perguntas</span></li>
	</ul>
</div>
<div class="mercadolivre mercadolivre-perguntas">
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
				<a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/perguntas/listar" title="" class="btn btn-info btn-small">Ver Pergunta</a>
			</div>
		</div>
	</div>
	<div class="box">
		<div class="box-header">
			<h3>Perguntas Pendentes</h3>
		</div>
		<div class="box-content">
			<ul class="lista-perguntas">
				<li id="None" class="pergunta ">
					<div class="pergunta-header">
						<h3>None - Código None</h3>
						<a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/perguntas/1/deletar" title="Remover pergunta" class="pull-right remover">Remover pergunta<i class="icon-trash" ></i></a>
					</div>
					<div>
						Em  None</small>
						<p class="pergunta">
							None
						</p>
						<div class="resposta">
							<textarea rows="3" 
								maxlength='1000'></textarea>
							<div class="">
								<a href="#" title="" class="btn pull-right responder">Enviar resposta</a>
							</div>
						</div>
					</div>
				</li>
				<li id="None" class="pergunta ">
					<div class="pergunta-header">
						<h3>None - Código None</h3>
						<a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/perguntas/1/deletar" title="Remover pergunta" class="pull-right remover">Remover pergunta<i class="icon-trash" ></i></a>
					</div>
					<div>
						Em  None</small>
						<p class="pergunta">
							None
						</p>
						<div class="resposta">
							<textarea rows="3" 
								maxlength='1000'></textarea>
							<div class="">
								<a href="#" title="" class="btn pull-right responder">Enviar resposta</a>
							</div>
						</div>
					</div>
				</li>
				<li id="None" class="pergunta ">
					<div class="pergunta-header">
						<h3>None - Código None</h3>
						<a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/perguntas/1/deletar" title="Remover pergunta" class="pull-right remover">Remover pergunta<i class="icon-trash" ></i></a>
					</div>
					<div>
						Em  None</small>
						<p class="pergunta">
							None
						</p>
						<div class="resposta">
							<textarea rows="3" 
								maxlength='1000'></textarea>
							<div class="">
								<a href="#" title="" class="btn pull-right responder">Enviar resposta</a>
							</div>
						</div>
					</div>
				</li>
				<li id="None" class="pergunta ">
					<div class="pergunta-header">
						<h3>None - Código None</h3>
						<a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/perguntas/1/deletar" title="Remover pergunta" class="pull-right remover">Remover pergunta<i class="icon-trash" ></i></a>
					</div>
					<div>
						Em  None</small>
						<p class="pergunta">
							None
						</p>
						<div class="resposta">
							<textarea rows="3" 
								maxlength='1000'></textarea>
							<div class="">
								<a href="#" title="" class="btn pull-right responder">Enviar resposta</a>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
<div>