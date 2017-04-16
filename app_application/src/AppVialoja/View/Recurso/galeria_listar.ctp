<style type="text/css">

	.input-group {
	  position: relative;
	  display: table;
	  border-collapse: separate;
	}

	.input-group .form-control {
	  position: relative;
	  z-index: 2;
	  float: left;
	  width: 100%;
	  margin-bottom: 0;
	}

	.input-group-addon,
	.input-group-btn,
	.input-group .form-control {
	  display: table-cell;
	}
	.input-group-addon:not(:first-child):not(:last-child),
	.input-group-btn:not(:first-child):not(:last-child),
	.input-group .form-control:not(:first-child):not(:last-child) {
	  border-radius: 0;
	}
	.input-group-addon,
	.input-group-btn {
	  width: 1%;
	  white-space: nowrap;
	  vertical-align: middle;

	}

	.input-group .form-control:first-child,
	.input-group-addon:first-child,
	.input-group-btn:first-child > .btn,
	.input-group-btn:first-child > .btn-group > .btn,
	.input-group-btn:first-child > .dropdown-toggle,
	.input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle),
	.input-group-btn:last-child > .btn-group:not(:last-child) > .btn {
	  border-bottom-right-radius: 0;
	  border-top-right-radius: 0;
	}
	.input-group-addon:first-child {
	  border-right: 0;
	}
	.input-group .form-control:last-child,
	.input-group-addon:last-child,
	.input-group-btn:last-child > .btn,
	.input-group-btn:last-child > .btn-group > .btn,
	.input-group-btn:last-child > .dropdown-toggle,
	.input-group-btn:first-child > .btn:not(:first-child),
	.input-group-btn:first-child > .btn-group:not(:first-child) > .btn {
	  border-bottom-left-radius: 0;
	  border-top-left-radius: 0;
	}
	.input-group-addon:last-child {
	  border-left: 0;
	}
	.input-group-btn {
	  position: relative;
	  font-size: 0;
	  white-space: nowrap;

	}
	.input-group-btn > .btn {
	  position: relative;
	}
	.input-group-btn > .btn + .btn {
	  margin-left: -1px;
	}
	.input-group-btn > .btn:hover,
	.input-group-btn > .btn:focus,
	.input-group-btn > .btn:active {
	  z-index: 2;
	}
	.input-group-btn:first-child > .btn,
	.input-group-btn:first-child > .btn-group {
	  margin-right: -1px;
	}
	.input-group-btn:last-child > .btn,
	.input-group-btn:last-child > .btn-group {
	  margin-left: -1px;

	}

    .exemplo_html, .exemplo_css { padding-top: 10px; }
    .exemplo_html textarea, .exemplo_css textarea { font-family: monospace; }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('[rel~=tooltip]').tooltip();
        $('.select_all_click').click(function(){
            $(this).select();
        });
        $('.mostrar_exemplo_html').click(function() {
            $(this).parents('td').children('.exemplo_html').slideToggle();
            $(this).parents('td').children('.exemplo_css').slideUp();
        });
        $('.mostrar_exemplo_css').click(function() {
            $(this).parents('td').children('.exemplo_css').slideToggle();
            $(this).parents('td').children('.exemplo_html').slideUp();
        });
    })
</script>


<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/dados/editar"><i class="icon-briefcase"></i> Minha loja</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/galeria/listar"><i class="icon-custom icon-image"></i> Mídia</a> <span class="bread-separator">-</span></li>
        <li><span>Listar arquivos de mídia</span></li>
    </ul>
</div>

<div class="box">
    <div class="box-header">
        <h3>Arquivos</h3>
        <div class="box-widget pull-right">
            <a href="<?php echo VIALOJA_PAINEL ?>/recurso/galeria/upload" class="btn btn-primary"><span class="glyphicon glyphicon-upload"></span> Enviar um arquivo</a>
        </div>
    </div>

    <?php
    $total = $this->Paginator->counter(array('format' => '%count%'));

    if ($total <=0) {
    ?>

    <div class="box-content">
                
        <p class="text-center">
            Ainda não existe nenhum arquivo cadastrado.
        </p>
        <p class="text-center">
            <a href="<?php echo VIALOJA_PAINEL ?>/recurso/galeria/upload" class="btn btn-primary"><span class="glyphicon glyphicon-upload"></span> Enviar um arquivo</a>
        </p>
        
    </div>
    <?php
    } else {
    ?>

    <div class="box-content table-content">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center" style="padding-left:20px;">Amostra</th>
                    <th>Nome e URL</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($result as $key => $dados) {

                echo '<tr>' .PHP_EOL;

                    if ($dados['ShopArquivo']['tipo'] == 'img') {
                    ?>

                    <td width="12%" class="text-center">
                        <div style="min-width: 64px; min-height: 64px;">

                            <?php
                            if (file_exists($diretorio . $dados['ShopArquivo']['nome'])) {
                            ?>
                            <img src="<?php echo $arquivo .'small/'. $dados['ShopArquivo']['nome']; ?>" style="max-width: 64px; max-height: 64px; margin: 0 auto;" />

                            <?php
                            } else {
                                echo '<h3>ERRO</h3>' . PHP_EOL;
                            }
                            ?>
                        </div>
                    </td>

                    <td class="arquivo-<?php echo $dados['ShopArquivo']['id_arquivo']; ?>">
                        <p>
                            <strong><span class="glyphicon glyphicon-file"></span> <a href="<?php echo $arquivo . $dados['ShopArquivo']['nome']; ?>"><?php echo $dados['ShopArquivo']['nome']; ?></a></strong>
                        </p>
                        <div class="input-group">
                            <input class="select_all_click form-control" type="text" value="<?php echo $arquivo . $dados['ShopArquivo']['nome']; ?>" title="Para copiar, clique no campo uma vez, clique com o botão direito sobre o texto e depois clique em Copiar." rel="tooltip" />
                            <div class="input-group-btn">
                                <a href="javascript:;" class="mostrar_exemplo_html btn btn-default" title="Gera a tag &lt;img&gt; para esta arquivo." rel="tooltip">&lt;img&gt;</a>
                                <a href="javascript:;" class="mostrar_exemplo_css btn btn-default" title="Gera código CSS para esta arquivo." rel="tooltip">CSS</a>
                                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/galeria/remover/<?php echo $dados['ShopArquivo']['id_arquivo']; ?>" class="btn btn-default" title="Remover." rel="tooltip">&nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;</a>
                            </div>
                        </div>
                        <div class="exemplo_html none">
                            <textarea class="select_all_click form-control" rows="2">&lt;img src="<?php echo $arquivo . $dados['ShopArquivo']['nome']; ?>" alt="Texto alternativo para a imagem."&gt;</textarea>
                            <br>
                            <p class="well well-sm"><span class="label label-important">IMPORTANTE</span> &nbsp;Você deve trocar o conteúdo do atributo <span class="label label-default">alt</span> para um texto que descreva o que é a imagem.</p>
                        </div>
                        <div class="exemplo_css none">
                            <textarea class="select_all_click form-control" rows="2">seletor { background-image: url('<?php echo $arquivo . $dados['ShopArquivo']['nome']; ?>'); }</textarea>
                            <br>
                            <p class="well well-sm"><span class="label label-important">IMPORTANTE</span> &nbsp;Você deve trocar o nome <span class="label label-default">seletor</span> pelo elemento que você deseja aplicar a imagem de fundo.</p>
                        </div>
                    </td>

                    <?php
                    } else {
                    ?>

                    <td width="12%" class="text-center" style="padding-left:20px;">
                        <div style="min-width: 64px; min-height: 64px;">

                            <?php
                            if (!file_exists($diretorio . $dados['ShopArquivo']['nome'])) {
                                echo '<h3>ERRO</h3>' . PHP_EOL;
                            } else {
                            
                                echo '<h3>' . PHP_EOL;

                                if ($dados['ShopArquivo']['tipo'] == 'css') {
                                    echo 'CSS';
                                } elseif ($dados['ShopArquivo']['tipo'] == 'js') {
                                    echo 'JS';
                                } elseif ($dados['ShopArquivo']['tipo'] == 'pdf') {
                                    echo 'PDF';
                                }

                                echo '</h3>' . PHP_EOL;

                            }
                            ?>
                        </div>
                    </td>                   

                    <td class="arquivo-<?php echo $dados['ShopArquivo']['id_arquivo']; ?>">
                        <p>
                            <strong><span class="glyphicon glyphicon-file"></span> <a href="<?php echo $arquivo . $dados['ShopArquivo']['nome']; ?>"><?php echo $dados['ShopArquivo']['nome']; ?></a></strong>
                        </p>
                        <div class="input-group">
                            <input class="select_all_click form-control" type="text" value="<?php echo $arquivo . $dados['ShopArquivo']['nome']; ?>" title="Para copiar, clique no campo uma vez, clique com o botão direito sobre o texto e depois clique em Copiar." rel="tooltip" />
                            <div class="input-group-btn">
                                <a href="<?php echo $arquivo . $dados['ShopArquivo']['nome']; ?>" target="_blank" class="btn btn-default" title="Fazer download." rel="tooltip">&nbsp;<span class="glyphicon glyphicon-download"></span>&nbsp;</a>
                                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/galeria/remover/<?php echo $dados['ShopArquivo']['id_arquivo']; ?>" class="btn btn-default" title="Remover." rel="tooltip">&nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;</a>
                            </div>
                        </div>
                    </td>

                    <?php
                    }

                echo '</tr>' .PHP_EOL;

                }
                ?>

            </tbody>
        </table>

        <?php
        if ($total > $limite) {
        ?>

        <div class="row-fluid">
        
            <div class="span11" style="margin:20px">
                <div class="pagination pagination-sm no-margin pull-right" >
                    <ul>
                        <?php 
                            echo $this->Paginator->numbers( array( 'modulus' => '2', 'tag' => 'li', 'first'=>'Início', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a', 'last'=>'Último'  ) );
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <?php
        }
        ?>


    </div>

    <?php 
    } //end tota; 
    ?>

</div>
<div class="row">
</div>