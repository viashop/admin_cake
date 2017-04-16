<section id="columns" class="offcanvas-siderbars">
    <div class="container">
        <div class="breadcrumbs">
            <ul>
                <li class="home">
                    <a href="<?php printf('//%s', env('HTTP_HOST')); ?>" title="Início do Site">Home</a>
                    <span>/ </span>
                </li>
                <li class="cms_page">
                    <strong></strong>
                </li>
            </ul>
        </div>
        <div class="row">
            <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="content">
                    <div class="page-title">
                        <h1><?php echo @$pag_titulo; ?></h1>
                    </div>
                    <div class="">
                        <p><?php echo @$pag_conteudo; ?></p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>