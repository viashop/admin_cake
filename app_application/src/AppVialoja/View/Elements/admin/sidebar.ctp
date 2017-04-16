<?php
$params = $this->request->here;

$admin_active ='';
$produto_active = '';
$marketing_active = '';
$aparencia_active = '';
$configuracoes_active = '';
$uso_active = '';
$pedido_active = '';
$cliente_active = '';
$relatorio_active = '';
$mercadolivre_active = '';
$pagina_active = '';
$usuarios_active = '';
$parceiros_active = '';

if (empty($params[2])) {
    $admin_active = 'active';
} else {

    $menu_produto = array(
        '/admin/catalogo/produto',
        '/admin/catalogo/categoria',
        '/admin/catalogo/marca',
        '/admin/catalogo/grade'
    );

    foreach ($menu_produto as $key => $value) {
        if (strpos($this->request->here, $value) !== false) {
            $produto_active = 'active';
        }
    }

    $menu_marketing = array(
        '/admin/recurso/banner',
        '/admin/recurso/xml',
        '/admin/recurso/frete/gratis',
        '/admin/recurso/cupom',
        '/admin/recurso/newsletter'
    );

    foreach ($menu_marketing as $key => $value) {
        if (strpos($this->request->here, $value) !== false) {
            $marketing_active = 'active';
        }
    }

    $menu_aparencia = array(
        '/admin/loja/tema',
        '/admin/loja/alterar/logo',
        '/admin/recurso/galeria'
    );

    foreach ($menu_aparencia as $key => $value) {
        if (strpos($this->request->here, $value) !== false) {
            $aparencia_active = 'active';
        }
    }

    $menu_configuracoes = array(
        '/admin/loja/dados',
        '/admin/loja/configuracao',
        '/admin/recurso/html',
        //'/admin/loja/certificado',
        '/admin/configuracao',
        '/admin/loja/google',
        //'/admin/recurso/facebook',
        '/admin/loja/redes/sociais',
        '/admin/loja/selos',
        //'/admin/recurso/email'
    );

    foreach ($menu_configuracoes as $key => $value) {
        if (strpos($this->request->here, $value) !== false) {
            $configuracoes_active = 'active';
        }
    }

    $menu_uso = array(
        '/admin/conta/uso',
        '/admin/conta/editar',
        '/admin/conta/cobranca'
    );

    foreach ($menu_uso as $key => $value) {
        if (strpos($this->request->here, $value) !== false) {
            $uso_active = 'active';
        }
    }

    $parceiros = array(
        '/admin/recurso/parceiros'
    );

    foreach ($parceiros as $key => $value) {
        if (strpos($this->request->here, $value) !== false) {
            $parceiros_active = 'active';
        }
    }

    $usuarios = array(
        '/admin/loja/usuario'
    );

    foreach ($usuarios as $key => $value) {
        if (strpos($this->request->here, $value) !== false) {
            $usuarios_active = 'active';
        }
    }

    $pagina = array(
        '/recurso/pagina'
    );

    foreach ($pagina as $key => $value) {
        if (strpos($this->request->here, $value) !== false) {
            $pagina_active = 'active';
        }
    }

    $pedido = array(
        '/admin/pedido'
    );

    foreach ($pedido as $key => $value) {
        if (strpos($this->request->here, $value) !== false) {
            $pedido_active = 'active';
        }
    }

    $cliente = array(
        '/admin/cliente'
    );

    foreach ($cliente as $key => $value) {
        if (strpos($this->request->here, $value) !== false) {
            $cliente_active = 'active';
        }
    }

    $relatorio = array(
        '/admin/relatorio'
    );

    foreach ($relatorio as $key => $value) {
        if (strpos($this->request->here, $value) !== false) {
            $relatorio_active = 'active';
        }
    }

    $mercadolivre = array(
        '/admin/recurso/mercadolivre'
    );

    foreach ($mercadolivre as $key => $value) {
        if (strpos($this->request->here, $value) !== false) {
            $mercadolivre_active = 'active';
        }
    }

}

?>

<style type="text/css">
.treeview-menu span{
    font-size: 12px;
}
</style>

<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <?php
        if (defined('PAGINA_INICIAL_PAINEL')) {
        ?>

        <!-- Sidebar user panel -->
        <div class="store-logo">

                <?php
                if (defined('LOGO_SHOP')) {
                    echo '<a href="http://'. URL_SHOP .'" target="_BLANK"><img src="'. LOGO_SHOP .'" /></a>' . PHP_EOL;
                } else {
                    echo '<a href="/admin"><img src="/admin/img/sem-logo.png" /></a>' . PHP_EOL;
                }
                ?>

                <a href="/admin/loja/alterar/logo" class="alterar-logo"><i class="icon icon-white icon-picture"></i> Alterar logo</a>
        </div>

        <?php
        }
        ?>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?php echo $admin_active; ?>">
                <a href="/admin">
                    <i class="icon-engine icon-custom"></i>
					<span>Painel de controle</span>
                </span></a>
            </li>

            <!--<li class="treeview active">-->
            <li class="treeview <?php echo $produto_active; ?>">

                <a href="/admin/#">
                    <i class="icon-cart icon-custom"></i>
                    <span>Produtos</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </span></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/admin/catalogo/produto/criar"><i class="fa fa-angle-double-right"></i> <span>Criar Produto</a>
                    </li>
                    <li>
                        <a href="/admin/catalogo/produto/listar"><i class="fa fa-angle-double-right"></i> <span>Listar produtos</span></a>
                    </li>
                    <li>
                        <a href="/admin/catalogo/produto/importar"><i class="fa fa-angle-double-right"></i> <span>Importar produtos</span></a>
                    </li>
                    <li>
                        <a href="/admin/catalogo/categoria/listar"><i class="fa fa-angle-double-right"></i> <span>Categorias</span></a>
                    </li>
                    <li>
                        <a href="/admin/catalogo/marca/listar"><i class="fa fa-angle-double-right"></i> <span>Marcas</span></a>
                    </li>
                    <li>
                        <a href="/admin/catalogo/grade/listar"><i class="fa fa-angle-double-right"></i> <span>Grades</span></a>
                    </li>
                </ul>
            </li>

            <li class="<?php echo $pedido_active; ?>">
                <a href="/admin/pedido/listar">
                    <i class="icon-dollar icon-custom"></i>
                    <span>Vendas</span>
                </span></a>
            </li>

            <li class="<?php echo $cliente_active; ?>">
                <a href="/admin/cliente/listar">
                    <i class="icon-user icon-custom"></i>
                    <span>Clientes</span>
                </span></a>
            </li>

            <li class="<?php echo $relatorio_active; ?>">
                <a href="/admin/relatorio">
                    <i class="icon-clip icon-custom"></i>
                    <span>Relatórios</span>
                </span></a>
            </li>

            <li class="active">
                <a>
                </span></a>
            </li>

            <li class="treeview <?php echo $marketing_active; ?>">
                <a href="/admin/#">
                    <i class="icon-graph icon-custom"></i>
                    <span>Marketing</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </span></a>

                <ul class="treeview-menu">
                    <li>
                        <a href="/admin/recurso/banner/listar"><i class="fa fa-angle-double-right"></i> <span>Banners</span></a>
                    </li>
                    <li>
                        <a href="/admin/recurso/xml/listar"><i class="fa fa-angle-double-right"></i> <span>Comparadores de preço</span></a>
                    </li>
                    <li>
                        <a href="/admin/recurso/frete/gratis/editar"><i class="fa fa-angle-double-right"></i> <span>Frete grátis</span></a>
                    </li>
                    <li>
                        <a href="/admin/recurso/cupom/listar"><i class="fa fa-angle-double-right"></i> <span>Cupons de Desconto</span></a>
                    </li>
                    <li>
                        <a href="/admin/recurso/newsletter/assinatura/listar"><i class="fa fa-angle-double-right"></i> <span>Assinatura da Newslleter</span></a>
                    </li>

                </ul>

            </li>

            <?php
            /*

            <li class="<?php echo $mercadolivre_active; ?>">
                <a href="/admin/recurso/mercadolivre">
                    <i class="icon-mercadolivre icon-custom"></i>
                    <span>Mercado livre</span>
                </span></a>
            </li>

			<li class="<?php echo $mercadolivre_active; ?>">
                <a href="/admin/recurso/mercadolivre/integrada">
                    <i class="icon-mercadolivre icon-custom"></i>
                    <span>Mercado livre</span>
                </span></a>
            </li>
            */
            ?>

            <li class="<?php echo $pagina_active; ?>">
                <a href="/admin/recurso/pagina/listar">
                    <i class="icon-page icon-custom"></i>
                    <span>Páginas de conteúdo</span>
                </span></a>
            </li>

            <li class="active">
                <a>
                </span></a>
            </li>

            <li class="treeview <?php echo $aparencia_active; ?>">
                <a href="/admin/#">
                    <i class="icon-window icon-custom"></i>
                    <span>Aparência da loja</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </span></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/admin/loja/tema/editar"><i class="fa fa-angle-double-right"></i> <span>Configurar tema</span></a>
                    </li>
                    <li>
                        <a href="/admin/loja/tema/css/editar"><i class="fa fa-angle-double-right"></i> <span>Editar CSS</span></a>
                    </li>
                    <li>
                        <a href="/admin/loja/alterar/logo"><i class="fa fa-angle-double-right"></i> <span>Alterar Logo</span></a>
                    </li>
                    <li>
                        <a href="/admin/recurso/galeria/listar" title="Upload de arquivos"><i class="fa fa-angle-double-right"></i> <span>Upload de arquivos</span></a>
                    </li>
                </ul>
            </li>

            <?php if (isset($_SESSION['cliente_nivel']) && $_SESSION['cliente_nivel'] >=5  ): ?>

            <li class="<?php echo $usuarios_active; ?>">
                <a href="/admin/loja/usuario/listar">
                    <i class="icon-users icon-custom"></i>
                    <span>Usuários</span>
                </span></a>
            </li>

            <?php endif ?>

            <li class="treeview <?php echo $configuracoes_active; ?>">
                <a href="/admin/#">
                    <i class="icon-tools icon-custom"></i>
                    <span>Configurações</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </span></a>
                <ul class="treeview-menu">

                    <?php if (isset($_SESSION['cliente_nivel']) && $_SESSION['cliente_nivel'] >=5  ): ?>

                    <li>
                        <a href="/admin/loja/dados/editar"><i class="fa fa-angle-double-right"></i> <span>Dados da loja</span></a>
                    </li>

                    <li>
                        <a href="/admin/loja/configuracao/editar"><i class="fa fa-angle-double-right"></i> <span>Configurações da loja</span></a>
                    </li>

                    <?php endif ?>

                    <li>
                        <a href="/admin/recurso/html/editar/basico"><i class="fa fa-angle-double-right"></i> <span>Incluir código HTML</span></a>
                    </li>
                    <?php /* ?>
                    <li>
                        <a href="/admin/loja/certificado"><i class="fa fa-angle-double-right"></i> <span>Certificado digital</span></a>
                    </li>
                    <?php */ ?>
                    <li>
                        <a href="/admin/configuracao/envio/listar"><i class="fa fa-angle-double-right"></i> <span>Formas de envio</span></a>
                    </li>

                    <?php if (isset($_SESSION['cliente_nivel']) && $_SESSION['cliente_nivel'] >=5  ): ?>

                    <li>
                        <a href="/admin/configuracao/pagamento/listar"><i class="fa fa-angle-double-right"></i> <span>Formas de pagamento</span></a>
                    </li>

                    <?php endif ?>

                    <li>
                        <a href="/admin/loja/google/editar"><i class="fa fa-angle-double-right"></i> <span>Configurações do Google</span></a>
                    </li>

                    <?php if (isset($_SESSION['cliente_nivel']) && $_SESSION['cliente_nivel'] >=5  ): ?>

                    <?php /* ?>
                    <li>
                        <a href="/admin/recurso/facebook"><i class="fa fa-angle-double-right"></i> <span>Loja no Facebook</span></a>
                    </li>
                    <?php */ ?>

                    <?php endif ?>

                    <li>
                        <a href="/admin/loja/redes/sociais"><i class="fa fa-angle-double-right"></i> <span>Redes sociais</span></a>
                    </li>


                    <li>
                        <a href="/admin/loja/selos"><i class="fa fa-angle-double-right"></i> <span>Selos</span></a>
                    </li>

                    <?php /*

                    <li>
                        <a href="/admin/recurso/email"><i class="fa fa-angle-double-right"></i> <span>Configurações de e-mail</span></a>
                    </li>
                    */ ?>
                </ul>
            </li>

            <?php if (isset($_SESSION['cliente_nivel']) && $_SESSION['cliente_nivel'] >=5  ): ?>

            <li class="treeview <?php echo $uso_active;?>">
                <a href="/admin/#">
                    <i class="icon-charging icon-custom"></i>
                    <span>Meu Plano</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </span></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/admin/conta/uso"><i class="fa fa-angle-double-right"></i> <span>Situação de sua conta</span></a>
                    </li>
                    <li>
                        <a href="/admin/conta/editar"><i class="fa fa-angle-double-right"></i> <span>Dados para cobrança</span></a>
                    </li>

                    <li>
                        <a href="/admin/conta/cobranca"><i class="fa fa-angle-double-right"></i> <span>Dados de fatura</span></a>
                    </li>
                </ul>
            </li>

            <?php endif ?>

            <li class="<?php echo $parceiros_active; ?>">
                <a href="/admin/recurso/parceiros">
                    <i class="icon-notification icon-custom"></i>
                    <span>Parceiros</span>
                </span></a>
            </li>

			<li class="active">
                <a>
                </span></a>
            </li>

            <li class="">
                <a href="<?php echo VIALOJA_SUPORTE; ?>">
                    <i class="fa fa-cogs"></i>
                    <span>Central de Ajuda</span>
                </span></a>

            </li>

            <li class="active">
                <a>
                </span></a>
            </li>

            <li class="treeview">
                <a href="/admin/#">
                    <i class="icon-charging icon-custom"></i>
                    <span>Wizard</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </span></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/admin/wizard/passo-1/configure-sua-loja"><i class="fa fa-angle-double-right"></i> <span>Passo 1</span></a>
                    </li>
                    <li>
                        <a href="/admin/wizard/passo-2/escolha-as-formas-de-envio-da-sua-loja"><i class="fa fa-angle-double-right"></i> <span>Passo 2</span></a>
                    </li>
                    <li>
                        <a href="/admin/wizard/passo-3/escolha-a-forma-de-pagamento-da-sua-loja"><i class="fa fa-angle-double-right"></i> <span>Passo 3</span></a>
                    </li>
                    <li>
                        <a href="/admin/wizard/passo-4/resumo"><i class="fa fa-angle-double-right"></i> <span>Passo 4</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>