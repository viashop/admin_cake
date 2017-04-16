<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/html/listar"><i class="icon-tools icon-custom"></i> HTML</a> <span class="bread-separator">-</span></li>
        <li><span>Listar</span></li>
    </ul>
</div>
<div class="box">
    <div class="box-header">
        <h3>
            Códigos HTML
        </h3>
        <div class="box-widget pull-right">
            <a class="btn btn-primary" href="/admin/recurso/html/criar">
            <i class="icon-white icon-plus"></i> 
            Adicionar código
            </a>
        </div>
    </div>
    <div class="box-content">
        <table class="table">
            <thead>
                <th>Descrição</th>
                <th>Posição</th>
                <th>Página</th>
                <th>Criado em</th>
            </thead>

            <?php
            if (!\Respect\Validation\Validator::notBlank()->validate($result_code)) {
                echo '<tbody>
                    <tr>
                        <td  colspan="4">
                            <div style="text-align:center; margin-top:30px;">
                                <a class="btn btn-primary" href="/admin/recurso/html/criar">
                                    <i class="icon-white icon-plus"></i> 
                                    Adicionar código HTML
                                </a>
                            </div>
                        </td>
                    <tr>
                <tbody>';
            }

            foreach ($result_code as $key => $code) {
            ?>
            <tbody>
                <tr>
                    <td>
                        <a href="<?php echo VIALOJA_PAINEL ?>/recurso/html/editar/<?php echo $code['ShopCode']['id_code']; ?>" title="<?php echo $code['ShopCode']['descricao']; ?>">	
                        <?php
                        echo $code['ShopCode']['descricao'];
                        ?>
                        <br>
                        <small class="muted"><?php echo $code['ShopCode']['tipo']; ?></small>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo VIALOJA_PAINEL ?>/recurso/html/editar/<?php echo $code['ShopCode']['id_code']; ?>">
                        <?php 
                        if ($code['ShopCode']['local_publicacao'] == 'cabecalho') {
                            echo 'Cabeçalho';
                        } else {
                             echo 'Rodapé';

                        }

                        ?>
                        </a>
                    </td>
                    <td><?php 


                        if (isset($code['ShopCode']['pagina_publicacao'])) {
                            # code...
                        
                        if (!(strcmp('todas', $code['ShopCode']['pagina_publicacao']))) {
                            echo "Todas as páginas";
                        }

                        if (!(strcmp('loja/index', $code['ShopCode']['pagina_publicacao']))) {
                            echo "Página inicial - Home";
                        }

                        if (!(strcmp('loja/produto_detalhar', $code['ShopCode']['pagina_publicacao']))) {
                            echo "Página do produto";
                        }

                        if (!(strcmp('loja/categoria_listar', $code['ShopCode']['pagina_publicacao']))) {
                            echo "Página da categoria";
                        }

                        if (!(strcmp('loja/carrinho_index', $code['ShopCode']['pagina_publicacao']))) {
                            echo "Página do carrinho";
                        }

                        if (!(strcmp('checkout/checkout_finalizacao', $code['ShopCode']['pagina_publicacao']))) {
                            echo "Página do pedido";
                        }

                        if (!(strcmp('checkout/checkout_obrigado', $code['ShopCode']['pagina_publicacao']))) {
                            echo "Página de finalização do pedido";
                        }

                    }

                    ?></td>
                    <td>
                        <div>
                            <?php echo \Lib\FormatarTempo::formatar( $code['ShopCode']['time'] ); ?>
                        </div>

                        <?php
                        if ($code['ShopCode']['reprovado'] > 0) {
                            
                            echo '<div>
                                 <button type="button" class="btn btn-danger">Reprovado</button>
                            </div>';
                        }
                        ?>
                    </td>
                </tr>
            </tbody>

            <?php
            }
            ?>
        </table>
    </div>
    
    <div class="box-footer"></div>
</div>
