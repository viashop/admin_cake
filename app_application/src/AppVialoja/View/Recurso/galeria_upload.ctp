<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/dados/editar"><i class="icon-briefcase"></i> Minha loja</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/galeria/listar"><i class="icon-custom icon-image"></i> Mídia</a> <span class="bread-separator">-</span></li>
        <li><span>Enviar um arquivo</span></li>
    </ul>
</div>
<form action="<?php echo Router::url(); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
    <div class="box">
        <div class="box-header">
            <h3>Enviar arquivo</h3>
        </div>
        <div class="box-content">
            <div class="alert alert-info">
                <p>
                    Use este formulário para enviar um arquivo para o servidor. Os arquivos que forem enviados através deste formulário servirão para ser usados dentro da descrição do produto, conteúdo das páginas e personalização do tema.
                </p>
                <p>
                    Tipos de arquivo permitidos: <strong>JPG</strong>, <strong>PNG</strong>, <strong>GIF</strong>, <strong>CSS</strong>, <strong>JS</strong> e <strong>PDF</strong>.<br/>
                    Tamanho máximo permitido: <strong>1 MB</strong>.
                </p>
            </div>
            <div class="form-group">
                <label for="arquivo" class="control-label span3"><strong>Arquivo</strong></label>
                <div class="span9">
                    <input type="file" name="arquivo" accept="image/*, .pdf, .js, .css" />
                </div>
            </div>

            <div class="form-group">
                <label for="arquivo" class="control-label span3"></label>
                <div class="span9">
                     <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-upload"></span> Enviar arquivo</button>
                    <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
					<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
                </div>
            </div>
   
        </div>
    </div>
</form>
<!-- /Full width content box -->