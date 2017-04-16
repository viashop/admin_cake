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
    <li>

        <?php

        if ( $this->Session->read('cliente_nivel') <= 5 ) {

            echo $this->Html->link(
                'Listar tickets',
                '/ticket/clientearea',
                array('title' => 'Ticket')
            );

        } else {

            echo $this->Html->link(
                'Listar tickets',
                '/ticket/adminarea',
                array('title' => 'Ticket')
            );

        }

        ?>
        <span class="divider"></span>
    </li>
    <li class="active">Visualizar ticket</li>
</ul>
<!-- row -->
<div class="row">
    <div class="col-md-12">

		<?php echo $this->Session->flash(); ?>

    </div><!-- /.col -->
</div><!-- /.row -->
<!-- row -->
<div class="row">
    <div class="col-md-12">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Ver Ticket ID #<?php echo $id; ?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th class="bg-light-blue" style="width: 30px">Departamento</th>
                        <th class="bg-light-blue" style="width: 120px">Data</th>
                        <th class="bg-light-blue">Assunto</th>
                        <th class="bg-light-blue " style="width: 40px; text-align:center;">Status</th>
                        <th class="bg-light-blue" style="width: 40px">Prioridade</th>
                    </tr>
                    <tr>

                        <td>
                        	<?php echo \Lib\Tools::getDepartamentoTicket( $departamento_id ); ?>
                        </td>
                        <td><?php

                        $date = new \DateTime( $created );
                        echo $date->format('d/m/Y H:i');

                        ?></td>
                        <td>
                        	<?php echo $assunto; ?></td>
                        <td>
                        <?php

                        if( $status == 0){
                            echo '<span class="badge bg-sucess">';
                            echo \Lib\Tools::getStatusTicket( $status );
                            echo '</span>';
                        } elseif( $status == 1){
                            echo '<span class="badge bg-purple">';
                            echo \Lib\Tools::getStatusTicket( $status );
                            echo '</span>';
                        } elseif( $status == 2){
                            echo '<span class="badge bg-blue">';
                            echo \Lib\Tools::getStatusTicket( $status );
                            echo '</span>';
                        } elseif ( $status == 3) {
                            echo '<span class="badge bg-glay">';
                            echo \Lib\Tools::getStatusTicket( $status );
                            echo '</span>';
                        }

                        ?></td>
                        <td align="center"><span class="badge "><?php

                        echo \Lib\Tools::getPrioridadeTicket( $prioridade );

                        ?></span></td>
                    </tr>

                </table>
            </div><!-- /.box-body -->

        </div><!-- /.box -->

    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <!-- The time line -->
        <ul class="timeline">

            <!-- timeline time label -->
            <li class="time-label">
                <?php
                echo '<span class="bg-red">';
                $date = new \DateTime( $created );
                echo $date->format('d/m/Y');
                echo '</span>';
                ?>
            </li>

            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
                <i class="fa fa-user bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo \Lib\FormatarTempo::formatar( strtotime( $created ) ); ?></span>
                    <h3 class="timeline-header"><a href="#"><?php

                    $cliente = $this->requestAction(
                        array(
							'controller' => 'Ticket',
						  	'action' => 'obterNomeClienteTicketId',
							'id' => $id_cliente
                        )
                    );

                    //foreach ($cliente as $key => $dados);

                    echo $nome;

                    ?></a> <span> #cliente <?php echo '<a href="http://'. $nome_dominio .'" target="_blank" title="URL Loja Virtual"><i class="fa fa-home"></i></a>'; ?></span></h3>
                    <div class="timeline-body">
                        <?php
                        echo \Lib\Tools::htmlentitiesDecodeUTF8( $mensagem );

                        if( !empty( $anexo ) ) {

                            $res_anexo = $this->requestAction(
                                array(
                                    'controller' => 'Ticket',
                                    'action' => 'ticketAnexoGetAll',
                                    'id' => $id_ticket_default
                                )
                            );

                            echo '<br />';
                            echo '<br />';

                            if (count($res_anexo) == 1) {
                                echo 'Anexo: &nbsp;';
                            } else {
                                echo 'Anexos: &nbsp;';
                            }
                            ?>

                            <?php foreach ($res_anexo as $key => $anexo): ?>
                            <a href="<?php echo $this->Html->url( CDN_UPLOAD . $anexo['Ticket']['id_shop_default'] .'/anexos/suporte/ticket/'. $anexo['TicketAnexo']['anexo'] ); ?>" target="_BLANK" title="Anexo"><img src="<?php echo ( CDN_UPLOAD . $anexo['Ticket']['id_shop_default'] .'/anexos/suporte/ticket/thumb-'. $anexo['TicketAnexo']['anexo'] ); ?>"></a>&nbsp;&nbsp;
                            <?php endforeach ?>

                        <?php
                        }
                        ?>

                        <br />
                        <br />
                        ----------------------------
                        <br />IP Address:
                        <?php
                        echo $ip;
                        ?>
                    </div>

                </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->

        	<?php
            foreach ($resposta_ticket as $key => $ticket):

                $cliente = $this->requestAction(
                    array(
						'controller' => 'Ticket',
						'action' => 'obterNomeClienteTicketId',
						'id' => $ticket['Ticket']['id_cliente']
                    )
                );

            ?>

            <!-- timeline time label -->
            <li class="time-label">
                <?php
                if($ticket['Ticket']['remetente'] == 1){
                    echo '<span class="bg-green">';
                } else {
                    echo '<span class="bg-red">';
                }

                $date = new \DateTime( $ticket['Ticket']['created'] );
                echo $date->format('d/m/Y');

                echo '</span>';
                ?>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
                <?php
                if($ticket['Ticket']['remetente'] == 1){
                    echo '<i class="fa fa-user bg-purple"></i>';
                } else {
                     echo '<i class="fa fa-user bg-blue"></i>';
                }
                ?>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo \Lib\FormatarTempo::formatar( strtotime( $ticket['Ticket']['created'] ) ); ?></span>
                    <h3 class="timeline-header"><?php
                            if($ticket['Ticket']['remetente'] == 1){
                                echo '<a  class="text-purple" href="#">Suporte ViaLoja Shopping</a>';
                            } else {
                            	echo '<a href="#">'.  $cliente['Cliente']['nome'] .'</a>';
                            }
                    ?><span> <?php
                    if($ticket['Ticket']['remetente'] == 0){
                        echo '#cliente ';
                        echo '<a href="http://'. $nome_dominio .'"  target="_blank" title="URL Loja Virtual"><i class="fa fa-home"></i></a>';
                    } else {
                        echo '#atendente';
                    }
                    ?></span></h3>
                    <div class="timeline-body">
                        <?php
                        echo \Lib\Tools::htmlentitiesDecodeUTF8( $ticket['Ticket']['mensagem'] );

                        if( !empty( $ticket['TicketAnexo']['anexo'] ) ) {

                            $res_anexo = $this->requestAction(
                                array(
                                    'controller' => 'Ticket',
                                    'action' => 'ticketAnexoGetAll',
                                    'id' => $ticket['TicketAnexo']['id_ticket_default']
                                )
                            );

                            echo '<br />';
                            echo '<br />';

                            if (count($res_anexo) == 1) {
                                echo 'Anexo: &nbsp;';
                            } else {
                                echo 'Anexos: &nbsp;';
                            }
                            ?>

                            <?php foreach ($res_anexo as $key => $anexo): ?>
                            <a href="<?php echo $this->Html->url( CDN_UPLOAD . $this->Session->read('id_shop') .'/anexos/suporte/ticket/'. $anexo['TicketAnexo']['anexo'] ); ?>" target="_BLANK" title="Anexo"><img src="<?php echo ( CDN_UPLOAD . $this->Session->read('id_shop') .'/anexos/suporte/ticket/thumb-'. $anexo['TicketAnexo']['anexo'] ); ?>"></a>&nbsp;&nbsp;
                            <?php endforeach ?>

                        <?php
                        }
                        ?>
                        <br />
                        <br />
                        ----------------------------
                        <br />IP Address:
                        <?php
                        echo $ticket['Ticket']['ip'];

                        $ticket['Ticket']['departamento_id']
                        ?>
                    </div>

                </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->

            <?php
            endforeach;
            ?>
            <!-- END timeline item -->
            <!-- timeline item -->

            <li>
                <i class="fa fa-clock-o"></i>
            </li>
        </ul>
    </div><!-- /.col -->
</div><!-- /.row -->


<!-- row -->
<div class="row">
    <div class="col-md-12">
        <?php
        if ( $this->Session->read('cliente_nivel') <= 5 ) {
        ?>
        <div align="center">
            <form action="<?php echo Router::url(); ?>" method="post">
                <button type="submit" class="btn">Ticket fechado</button>
                <input type="hidden" name="fechar_ticket" value="1">
                <input type="hidden" name="parente_id" value="<?php echo $parente_id; ?>">
                <input type="hidden" name="id_shop_default" value="<?php echo $id_shop_default; ?>">

                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
                <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />

            </form>
        </div>
        <?php
        }
        ?>
        <!-- quick email widget -->
        <h2 class="box-title">Resposta</h2>
        <div class="box box-info">
            <div class="box-header">

            </div>
            <div class="box-body">
                <form action="<?php echo Router::url(); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <span>Nome:</span> <span><strong><?php echo $this->Session->read('cliente_nome'); ?></strong></span>
                    </div>
                    <div class="form-group">
                        <span>E-mail:</span> <span><strong><?php echo $this->Session->read('cliente_email'); ?></strong></span>
                    </div>

                    <?php
                    if( isset( $erro  ) ){
                    ?>
                        <div class="form-group has-warning">
                        <label class="control-label" for="inputWarning"><i class="fa fa-warning"></i> Por favor, informe a mensagem!</label>
                        <textarea name="mensagem"  id="editor_ckeditor" class="form-control" id="inputWarning" placeholder="Informe a mensagem" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo \Lib\Tools::getValue('mensagem'); ?></textarea>
                    </div>
                    <?php

                    } else {

                    ?>
                    <div>
                        <label>&nbsp<i class="fa fa-edit"></i> &nbsp;Descrição completa</label>
                        <textarea name="mensagem" id="editor_ckeditor" placeholder="Descrição completa" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                    <?php

                    }

                    ?>
                    <br />
                    <div class="form-group">
                        <label for="exampleInputFile">Anexo:</label>
                        <input type="hidden" name="_method" value="POST"/></div>
                        <input type="file" name="data[Ticket][file][]" id="TicketFile" multiple="multiple" accept="image/*" />

                        <p class="help-block">(Extensões de arquivos permitidas: .jpg, .gif, .jpeg, .png)<br />Você pode adicionar até <strong>5</strong>  imagens
com tamanho máximo de <strong>2MB</strong> cada.</p>
                    </div>


                    <div class="box-footer">


                        <button id="processando" type="submit" class="btn btn-primary">Enviar ticket</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <?php
                        if ( $this->Session->read('cliente_nivel') > 5 ) {
                        ?>
                         <label>
                            <input type="checkbox" name="status" value="3" />&nbsp;
                            Marque está opção para fechar o ao enviar.
                        </label>
                        <?php
                        }
                        ?>

                    </div>

                    <input type="hidden" name="departamento_id" value="<?php echo $departamento_id; ?>">

                    <input type="hidden" name="parente_id" value="<?php echo $parente_id; ?>">
                    <input type="hidden" name="id_shop_default" value="<?php echo $id_shop_default; ?>">

                    <input type="hidden" name="assunto" value="<?php echo $assunto; ?>">

                    <input type="hidden" name="prioridade" value="<?php echo $prioridade; ?>">

                    <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
                    <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />

                </form>
            </div>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->
