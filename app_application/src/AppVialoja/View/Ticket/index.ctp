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
                                'Suporte',
                                '/ticket',
                                array('title' => 'Ticket')
                            );
                            ?>
                            <span class="divider"></span>
                        </li>
                        <li>
                            <?php
                            echo $this->Html->link(
                                'Tickets de suporte',
                                '/ticket/clientearea',
                                array('title' => 'Tickets de suporte')
                            );
                            ?>
                            <span class="divider"></span>
                        </li>
                        <li class="active">Ver tickets</li>
                    </ul>

                    <div class="row">
                        <div class="col-md-12">

                            <?php

                            if ( ! \Respect\Validation\Validator::notBlank()->validate( $this->Session->flash() ) ) {

                                echo '<div class="alert alert-info alert-dismissable">
                                    <i class="fa fa-info"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <b>Atenção!</b> O prazo de resposta é de até 24 horas, podendo demorar mais se o ticket necessitar da atenção de um administrador ou de outros setores, como o setor de pagamentos ou de desenvolvedores.
                                </div>';

                            }
                            ?>

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

                                    <form action="" method="post">

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


                                                echo $this->Session->read('cliente_email') ;

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
                                                    <span class="col-xs-9"><input id="inputWarning" required placeholder="Título da mensagem" class="form-control col-xs-3" type="text" name="assunto" value="<?php

                                                    if ( ! isset($ticket->status)) {
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
                                                        <select name="prioridade" class="form-control" required>
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
                                                <td colspan="2"><textarea class="form-control" rows="10" name="mensagem" required placeholder="Mensagem ..."><?php

                                                if ( ! isset($ticket->status)) {
                                                    echo \Lib\Tools::getValue("mensagem");
                                                }

                                                ?></textarea></td>
                                            </tr>

                                            <tr>
                                                <td td class="bg-gray" style="text-align:right; font-weight: bold;">Anexo</td>
                                                <td><input type="file" id="file">

                                                    <!--<input type="file" name="data[Ticket][file][]" id="TicketFile" multiple="multiple" accept="image/*" />!-->
                                            <p class="help-block">(Extensões de arquivos permitidas: .jpg, .gif, .jpeg, .png)</p></td>
                                            </tr>

                                        </table>
                                        <div class="box-footer">
                                            <button type="submit" title="Enviar ticket" class="btn btn-primary">Enviar ticket</button>
                                        </div>

                                        <input type="hidden" name="add" value="add">

                                        <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
                                        <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />

                                    </form>

                                    <?php
                                    } else {
                                    ?>
                                    <ul>
                                        <li>
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
