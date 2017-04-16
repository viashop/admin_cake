<div class="box">
	<div class="box-header">
		<h3>
			Remover aplicativo do Facebook?
		</h3>
	</div>
	<div class="box-content">
		<form action="/admin/recurso/facebook/desinstalar" method="POST">
			<p>
				Você realmente deseja remover o aplicativo facebook?
			</p>
			<p>
				<button type="submit" class="btn btn-danger">Sim</button>
				<a href="<?php echo VIALOJA_PAINEL ?>/recurso/facebook" class="btn">Não</a>
			</p>
			<input type="hidden" name="confirmacao" id="id_confirmacao" value="desinstalar" />
			<input type='hidden' name='csrfmiddlewaretoken' value='sRhsr7ZB9wGAmavYHaaKhutp2UfkL1C0' />
		</form>
	</div>
	<div class="box-header"></div>
</div>