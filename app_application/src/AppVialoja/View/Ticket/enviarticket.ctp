                    <ul class="breadcrumb">
                        <li>
                            <?php
                            echo $this->Html->link(
                                'Home',
                                '/',
                                array('title' => 'Home')
                            );
                            ?>    
                            <span class="divider"></span>
                        </li>
                        <li>

                            <?php
                            echo $this->Html->link(
                                'Tickets de Suporte',
                                '/ticket',
                                array('title' => 'Ticket')
                            );
                            ?>
                            <span class="divider"></span>
                        </li>
                        <li class="active">Listar tickets</li>
                    </ul>

                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $this->Session->flash(); ?>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <h5>Se você não conseguir encontrar a solução para seu problema em nossa Base de Conhecimento, envie um ticket de Suporte para o departamento selecionado abaixo.</h5>
                            </div>
                            <div class="box">

                                <div class="box-body">

                                    <?php
                                    if ( \Lib\Tools::getValue('step' ) ) {
                                    ?>

                                    <form action="<?php echo Router::url(); ?>" method="post" enctype="multipart/form-data">

                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="bg-gray" style="width:160px; text-align:right; font-weight: bold;">Nome</td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php

                                                 echo $this->Session->read('cliente_nome'); 
                                                 ?></td>
                                            </tr>
                                            <tr>
                                                <td td class="bg-gray" style="text-align:right; font-weight: bold;">E-mail</td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php 

                                                    echo $this->Session->read('cliente_email');

                                                 ?></td>
                                            </tr>

                                            <tr>
                                                <td td class="bg-gray" style="text-align:right; font-weight: bold;">Departamento</td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php

                                                if ( \Lib\Tools::getValue('deptid' ) ) {

                                                    $deptid = \Lib\Tools::getValue('deptid');

                                                    switch ($deptid) {
                                                        case 1:
                                                            echo 'Suporte';
                                                            echo '<input type="hidden" name="departamento_id" value="1">';
                                                            break;
                                                        case 2:
                                                            echo 'Comercial';
                                                            echo '<input type="hidden" name="departamento_id" value="2">';
                                                            break;
                                                        case 3:
                                                            echo 'Financeiro';
                                                            echo '<input type="hidden" name="departamento_id" value="3">';
                                                            break;
                                                        default: 
                                                            echo 'Suporte';
                                                            echo '<input type="hidden" name="departamento_id" value="1">';
                                                            break;    

                                                    }
                                                }

                                                ?></td>
                                            </tr>

                                            <tr>
                                                <td td class="bg-gray" style="text-align:right; font-weight: bold;">Assunto</td>
                                                <td>
                                                    <span class="col-xs-9"><input id="inputWarning" placeholder="Título da mensagem" class="form-control col-xs-3" type="text" name="assunto" value="<?php 

                                                    if(isset($erro)){
                                                        echo \Lib\Tools::getValue("assunto"); 
                                                    }
                                                     ?>" >
                                                    </span>
                                                    </td>
                                            </tr>

                                            <tr>
                                                <td td class="bg-gray" style="text-align:right; font-weight: bold;">Prioridade</td>
                                                <td>
                                                    <span class="col-xs-3">
                                                        <select name="prioridade" class="form-control">
                                                            <option value="0">Baixa</option>
                                                            <option value="1" selected="selected">Média</option>
                                                            <option value="2">Alta</option>
                                                        </select>
                                                    </span>
                                                </td>
                                            </tr>
                                            <!--
                                            <tr>
                                                <td td class="bg-gray" style="text-align:right; font-weight: bold;">Serviço Relacionado</td>
                                                <td>
                                                    <span class="col-xs-5">
                                                        <select class="form-control">
                                                            <option selected="selected">loja.vialoja.com.br</option>
                                                        </select>
                                                    </span>
                                                </td>
                                            </tr>
                                            -->

                                            <tr class="bg-gray">
        <!-- Bootstrap WYSIHTML5 -->
                                                <td colspan="2">
                                                    <label>&nbsp<i class="fa fa-edit"></i> &nbsp;Descrição completa</label>
                                                    <textarea class="form-control" id="editor_ckeditor" rows="10" name="mensagem" placeholder="Descrição completa"><?php

                                                if(isset($erro)){
                                                    echo \Lib\Tools::htmlentitiesUTF8( \Lib\Tools::getValue("mensagem") );
                                                }    


                                                ?></textarea></td>
                                            </tr>

                                            <tr>
                                                <td td class="bg-gray" style="text-align:right; font-weight: bold;">Anexo</td>
                                                <td>
                                                    <input type="hidden" name="_method" value="POST"/></div>
                                                    <input type="file" name="data[Ticket][file][]" id="TicketFile" multiple="multiple" accept="image/*" />

                                            <p class="help-block">(Extensões de arquivos permitidas: .jpg, .gif, .jpeg, .png)<br />Você pode adicionar até <strong>5</strong>  imagens 
com tamanho máximo de <strong>2MB</strong> cada.</p></td>
                                            </tr>

                                        </table>
                                        <div class="box-footer">
                                            <button id="processando" type="submit" title="Enviar ticket" class="btn btn-primary">Enviar ticket</button>
                                        </div>

                                        <input type="hidden" name="add" value="add">

                                        <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
                                        <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />

                                    </form>

                                    <?php
                                    } else {
                                    ?>
                                    <ul style="font-size:23px;">
                                        <li >
                                            <?php
                                            echo $this->Html->link(
                                                'Suporte',
                                                '/ticket/enviarticket/?step=2&deptid=1',
                                                array('title' => 'Suporte')
                                            );
                                            ?>
                                        </li>

                                        <li>
                                            <?php
                                            echo $this->Html->link(
                                                'Comercial',
                                                '/ticket/enviarticket/?step=2&deptid=2',
                                                array('title' => 'Comercial')
                                            );
                                            ?>
                                        </li>

                                        <li>
                                            <?php
                                            echo $this->Html->link(
                                                'Financeiro',
                                                '/ticket/enviarticket/?step=2&deptid=3',
                                                array('title' => 'Financeiro')
                                            );
                                            ?>
                                        </li>

                                    </ul>
                                    <?php
                                    }
                                    ?>

                                </div><!-- /.box-body -->

                            </div><!-- /.box -->

                        </div><!-- /.col -->
                    </div><!-- /.row -->