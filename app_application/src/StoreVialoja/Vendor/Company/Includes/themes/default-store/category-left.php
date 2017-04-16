<?php
if (\Lib\Validate::isNotNull($GLOBALS['lista_categorias_left'])) : 
?>
<div class="category-left col-lg-3 col-sm-3 col-xs-12">
	<div id="ves-verticalmenu" class="block ves-verticalmenu highlighted hidden-xs hidden-sm">
		<div class="block-title">
			<span>Categorias</span>	
			<span class="shapes round">
			<em class="shapes bottom"></em>
			</span>
		</div>
		<div class="block-content">
			<div class="navbar navbar-inverse">
				<div id="verticalmenu" class="verticalmenu" role="navigation">
					<div class="navbar">
						<a href="javascript:;" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<ul class="nav navbar-nav verticalmenu">

								<?php echo $GLOBALS['lista_categorias_left']; ?>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif ?>