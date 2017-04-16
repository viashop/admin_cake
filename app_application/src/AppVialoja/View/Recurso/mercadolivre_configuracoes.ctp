<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><span>Configurações</span></li>
	</ul>
</div>
<div class="box mercadolivre-configuracoes">
	<div class="box-header">
		<h3>Configurações MercadoLivre</h3>
	</div>
	<form method='POST' action='/admin/recurso/mercadolivre/configuracoes' class='form-horizontal'>
		<div class="box-content">
			<div class="control-group">
				<label class="control-label">Relistar Automaticamente?</label>
				<div class="controls">
					<div class="help-block">Este recurso permite que quando um determinado anúncio expire, ele seja recadastrado automaticamente no MercadoLivre sem nenhuma interação sua.</div>
					<select class="input-small" id="id_relistar" name="relistar">
						<option value="True" selected="selected">Sim</option>
						<option value="False">Não</option>
					</select>
				</div>
			</div>
			<div class="control-group hide">
				<label class="control-label">Sincronizar automaticamente?</label>
				<div class="controls">
					<label for="id_sincronizar" class='checkbox'>
					<input id="id_sincronizar" name="sincronizar" type="checkbox" />
					Sincronizar automaticamente?
					</label>
				</div>
			</div>
			<div class="control-group hide">
				<div class="controls">
					<label for="id_valor_desconto" >
					Valor desconto
					</label>
					<input id="id_valor_desconto" name="valor_desconto" step="0.01" type="number" />
				</div>
			</div>
			<div class="control-group hide">
				<div class="controls">
					<label for="id_tipo_desconto" >
					Tipo desconto
					</label>
					<select id="id_tipo_desconto" name="tipo_desconto">
						<option value="nenhum" selected="selected">Sem desconto</option>
						<option value="frete_gratis">Frete Gratis</option>
						<option value="porcentagem">Porcentagem</option>
						<option value="fixo">Valor Fixo</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="id_assinatura" >
				Assinatura das respostas
				</label>
				<div class="controls">
					<span class="help-block">
					Mensagem de assinatura para as perguntas do MercadoLivre
					</span>
					<textarea cols="40" id="id_assinatura" name="assinatura" rows="10">
					</textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
				Email automático
				</label>
				<div class="controls">
					<span class="help-block" style="padding-bottom: 0;">
					O email automático de compra e qualificação enviado pelo MercadoLivre deve ser configurado diretamente do painel de controle do MercadoLivre, <a href="http://vialoja.com.br/comunidade/hc/pt-br/articles/20aa-Resposta-automática-no-MercadoLivre" target="_blank">clique aqui</a> e veja como configurá-lo.
					</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Desassociação</label>
				<div class="controls">
					<div class="help-block">Para desligar a integração do MercadoLivre, você deve desassociar sua conta. Clique no botão abaixo para proceder com esta desassociação.</div>
					<a href="#desassociar-ml" role="button" data-toggle="modal" class="btn btn-danger">Desassociar do MercadoLivre</a>
				</div>
			</div>
		</div>
		<div class="form-actions">
			<input type='hidden' name='csrfmiddlewaretoken' value='3ZBO88GAgG5TIPlw3PQrPuWte7csLAv3' />
			<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
			<a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre" class="btn"><i class="icon-remove"></i> Cancelar</a>
		</div>
	</form>
</div>
<div id="desassociar-ml" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3>Desassociar do MercadoLivre</h3>
	</div>
	<div class="modal-body">
		<p>Ao clicar em confirmar sua conta do MercadoLivre não estará mais vinculada com a Loja Integrada. <br />Você poderá integrar novamente a mesma conta ou uma outra a qualquer momento.</p>
	</div>
	<div class="modal-footer">
		<a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre/desinstalar" class="btn btn-danger"><i class="icon-ok icon-white"></i> Confirmar Desassociação</a>
		<a href="" class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</a>
	</div>
</div>