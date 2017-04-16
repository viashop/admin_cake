<style>
    input[name='voltaria_a_usar'] {
    	margin-left: 10px !important;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
      primeira_confirmacao = false;
      segunda_confirmacao = false;
    
      $('#form-cancelar').submit(function() {
        primeira_confirmacao = $('[name=confirmacao]').is(':checked');
        if (primeira_confirmacao && segunda_confirmacao) {
          return true;
        } else if (!primeira_confirmacao) {
          alert('Você deve aceitar os termos de cancelamento.');
          $('#checkbox-confirmacao-cancelamento').addClass("alert-danger").removeClass("alert-info");
        } else if (!segunda_confirmacao) {
          $('#modal-cancelar-conta').modal();
        }
        return false;
      });
    
      $('#confirmar-cancelamento-conta').click(function() {
        segunda_confirmacao = true;
        $('#form-cancelar').submit();
      });
    });
</script>

<style type="text/css">
<!--
.pagina-cancelar h4 { font-weight: 600; color: #444; }
.pagina-cancelar .intro { font-size: 16px; color: #777; font-style: italic; margin: 0 0 20px; }
.pagina-cancelar .intro i { opacity: 0.7; margin: 4px 5px 0 0; }
.pagina-cancelar .custom-box h4 { font-size: 16px; }

.cancelar-motivos ul { margin: 0; }
.cancelar-motivos ul li { border-top: 1px solid #e3e3e3; }
.cancelar-motivos ul li:first-child { border: none; }
.cancelar-motivos ul li:hover { background-color: #f5f5f5; }
.cancelar-motivos ul li label { color: #666; line-height: 30px; margin: 0; display: block; }
.cancelar-motivos ul li input[type="radio"] { vertical-align: -10px; margin: 0 5px; }
.cancelar-motivos ul li input[type="checkbox"] { margin: -5px 5px 0 0; }
.outro-motivo { padding: 15px 0 0; }
.outro-motivo input[type="text"] { margin-left: 10px; }
.cancelar-motivos ul .outro-motivo:hover { background: none; }

.cancelar-sugestao em { display: block; font-size: 12px; color: #777; margin: 20px 0 0; font-weight: 600; }
.cancelar-sugestao textarea { margin: 14px 0 0; resize: none; }

.box-cancelamento { padding: 20px; background-color: #f5f5f5; border-left: 3px solid #d20000; border-radius: 4px; box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1); margin: 0 0 20px; }
.box-cancelamento h4 { font-size: 22px; font-style: italic; margin-bottom: 20px; }
.box-cancelamento ol li { margin: 0 0 10px; }
.box-cancelamento p { color: #666; display: inline; margin: 0; }

#checkbox-confirmacao-cancelamento .checkbox input[type="checkbox"] { margin: -5px 5px 0 0; }

.sem-topo {margin-top:0 !important; padding-top:0 !important; }
-->
</style>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/dados/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><span>Cancelar conta</span></li>
    </ul>
</div>

<form action="<?php echo Router::url(); ?>" method="post" class="form-horizontal" id="form-cancelar">
    <div class="pagina-cancelar">
        <div class="box">
            <div class="box-header">
                <h3>Cancelar conta</h3>
            </div>

            <div class="box-content">

                <p class="intro hide">
                    <i class="icon-notification icon-custom"></i> Para confirmar o cancelamento da sua loja virtual, diga-nos o motivo e leia atentamente os termos de cancelamento
                </p>

                <div class="row">
                    <div class="span12">
                        <div class="" style="margin: 10px 0 40px;">
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="cancelar-motivos">
                                        <h4>Porque está nos deixando?</h4>
                                        <ul>
                                            <li>
                                                <input type="radio" name="motivos" value="estou_desistindo_de_ter_loja_virtual" />Estou desistindo de ter Loja Virtual
                                            </li>
                                            <li>
                                            	<input type="radio" name="motivos" value="estou_migrando_para_outra_plataforma" />Estou migrando para outra plataforma
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="cancelar-sugestao">
                                        <h4>Comentário <small>opcional</small></h4>
                                        <textarea name="sugestao" rows="4" class="form-control"> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-box hide">
                    <label class="checkbox">
                    Voltaria a utilizar a ViaLoja ou indicaria a algum amigo?
                    <input type="checkbox" name="voltaria_a_usar" value="Sim">
                    </label>
                </div>
                <div class="box-cancelamento">
                    <h4>Termos de cancelamento</h4>
                    <ol>
                        <li>
                            <p>
                                Ao cancelar a sua loja, os dados permanecerão armazenados em nosso banco de dados por um período de 15 dias. A partir dai todas as informações serão apagadas definitivamente e não poderão ser recuperadas.
                            <p>
                        </li>
                        <li>
                            <p>
                                Se durante este período você acessar o Painel Administrativo, o cancelamento será desfeito e sua loja voltará a ficar ativa.
                            </p>
                        </li>
                        <li>
                            <p>
                                Todas as faturas pagas serão imediatamente finalizadas e não darão direito a reembolso, mesmo que o ciclo desta fatura ainda não tenha sido finalizado.
                            </p>
                        </li>
                    </ol>
                    <p>Para cancelar a sua conta você deve marcar a caixa de seleção abaixo informando que aceita todos os termos acima e depois clicar no botão.</p>
                </div>
                <div id="checkbox-confirmacao-cancelamento" class="alert alert-info">
                    <label class="checkbox">
                    <input type="checkbox" name="confirmacao" value="true" /> Eu aceito os termos de cancelamento.
                    </label>
                </div>
            </div>

            <?php if ($this->Session->read('cliente_nivel') == 5 ): ?>

            <div class="form-actions">

            	<button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-ok"></span> Sim, quero cancelar a minha conta
                </button> &nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;

	                <a class="btn btn-success" href="/admin">
	                	<span class="glyphicon glyphicon-remove"></span> Não, voltar para o painel de controle
	                </a>

	            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
	            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
	        </div>

	        <?php endif ?>

        </div>
    </div>
</form>

<div id='modal-cancelar-conta' class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Confirmação de cancelamento</h4>
            </div>
            <div class="modal-body">
                <p>
                    Tem certeza que deseja <strong>cancelar</strong> a sua conta?
                </p>
            </div>
            <div class="modal-footer text-left">
                <button type="button" class="btn btn-danger" id="confirmar-cancelamento-conta" data-dismiss="modal" aria-hidden="true">Sim, tenho certeza</button>
                <button type="button" class="btn btn-default" id="cancelar-cancelamento" data-dismiss="modal" aria-hidden="true">Não</button>
            </div>
        </div>
    </div>
</div>