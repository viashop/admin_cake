<section id="columns" class="columns-container">
    <div class="container">
        <div class="row">
            <div id="top_column" class="center_column col-xs-12 col-sm-12 col-md-12">
            </div>
        </div>
        <div class="row">
            <!-- Center -->
            <section id="center_column" class="col-md-12">
                <div class="pagenotfound">
                    <div class="img-404">
                        <img src="<?php echo CDN . 'error-404/vialoja-erro-404.png' ?>" alt="Página não encontrada" />
                    </div>
                    <h1>Página indisponível</h1>
                    <p>
                        Lamentamos, mas o endereço que digitou não está mais disponível
                    </p>
                    <h3>Para encontrar um produto, por favor escreva o nome no campo abaixo</h3>
                    <form action="/busca" method="post" class="std">
                        <fieldset>
                            <div>
                                <label for="search_query">Procure no nosso catálogo:</label>
                                <input id="search_query" name="search_query" type="text" class="form-control grey" />
                                <button type="submit" name="Submit" value="OK" class="btn btn-outline button button-small btn-sm"><span>Ok</span></button>
                            </div>
                        </fieldset>
                    </form>
                    <div class="buttons"><a class="btn btn-outline button button-medium" href="../" title="Início"><span>Página inicial</span></a></div>
                </div>
            </section>
        </div>
    </div>
</section>
<!-- Footer -->