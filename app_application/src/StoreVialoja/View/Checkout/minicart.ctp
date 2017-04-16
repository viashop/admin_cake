<?php
$item = 'itens';
$existe = 'Existem';
if ($totalqtde == 1) {
  $item = 'item';
  $existe = 'Existe';
}

$html = '<div class="clearfix" id="cart">
    <div class="heading hidden-sm hidden-xs">
        <div class="cart-inner">
            <a href="#" title="Shopping cart">
                <i class="fa fa-shopping-cart "></i>
                <h4>        
                    <span class="title">Carrinho de Compras</span>        
                    <span id="cart-total">'. $totalqtde .' '.$item .' - <span class="price">R$ '. \Lib\Tools::convertToDecimalBR($subtotal) .'</span></span>
                </h4>
            </a>
        </div>
    </div>';

    $html .= '<div class="quick-access">
        <div class="cart-inner">
            <div class="quickaccess-toggle hidden-lg hidden-md">
                <i class="fa fa-shopping-cart "></i>                                                   
            </div>
            <div class="inner-toggle">
                <div class="content">
                    <div class=" block-cart">
                        <div class="block-content">
                            <p class="block-subtitle">'.$item .' adicionado recentemente</p>
                            <ol id="cart-sidebar" class="mini-products-list">';

                                $subtotal=0;
                                $subtotal_produto=0;

                                foreach ($carrinhoLista as $key => $car) {

                                  $qtde = $car['ShopCarrinhoProdutoDescricao']['qtde'];
                                  $preco = $car['ShopCarrinhoProdutoDescricao']['preco'];
                                  $subtotal_produto = $preco * $qtde;
                                  $subtotal +=  $subtotal_produto;

                                  $url_img = CDN .'static/img/imagem-padrao/cart/produto-sem-imagem.gif';
                                  $nome_imagem = $car['ShopProdutoImagem']['nome_imagem'];
                                  $id_produto = $car['ShopCarrinhoProdutoDescricao']['id_produto_default'];

                                  if (!empty($nome_imagem)) {

                                      $url_root = sprintf( '%s%d%sproduto%s%d%scart%s%s',
                                          CDN_ROOT_UPLOAD,
                                          $this->Session->read('id_shop_default'),
                                          DS,
                                          DS,
                                          $id_produto,
                                          DS,
                                          DS,
                                          $nome_imagem
                                      );

                                      if (is_file($url_root)) {

                                          $url_img = sprintf( '%s%d/produto/%d/cart/%s',
                                              CDN_UPLOAD,
                                              $this->Session->read('id_shop_default'),
                                              $id_produto,
                                              $nome_imagem
                                          );                               

                                      }

                                  }

                           
                                $html .= '<li class="item">
                                    <a href="/produto/'. $id_produto .'-'. \Lib\Tools::slug( $car['ShopProduto']['nome'] ) .'.html" title="'. $car['ShopProduto']['nome'] .'" class="product-image"><img src="'. $url_img .'" width="75" height="75" alt="'. $car['ShopProduto']['nome'] .'" /></a>
                                    <div class="product-details">
                                        <a href="/checkout/carrinho/remover/id/'. $car['ShopCarrinhoProdutoDescricao']['id_carrinho_descricao'] . '/'. $car['ShopCarrinhoProdutoDescricao']['key'] . '" title="Remover este item" onclick="return confirm(\'Tem certeza de que deseja remover este item do carrinho de compras?\');" class="btn-remove">Remover este item</a>';

                                        /*
                                        <a href="/checkout/carrinho/configure/id/590/" title="Edit item" class="btn-edit">Edit item</a>

                                        */
                                        $html .= '<p class="product-name"><a href="/produto/'. $id_produto .'-'. \Lib\Tools::slug( $car['ShopProduto']['nome'] ) .'.html">'. $car['ShopProduto']['nome'] .'</a></p>
                                        <strong>'. $qtde .'</strong> x
                                        <span class="price">R$ '. \Lib\Tools::convertToDecimalBR( $car['ShopCarrinhoProdutoDescricao']['preco']) .'</span>
                                        <div class="truncated">
                                            <div class="truncated_full_value">
                                                <dl class="item-options">
                                                    <dt>Size</dt>
                                                    <dd>
                                                        M                                    
                                                    </dd>
                                                </dl>
                                            </div>
                                            <a href="#" onclick="return false;" class="details">Detalhes</a>
                                        </div>
                                    </div>
                                </li>';

                              }

                            $html .= '</ol>
                            <script type="text/javascript">decorateList(\'cart-sidebar\', \'none-recursive\')</script>
                            <div class="summary">
                                <p class="amount">'.$existe.' '. $totalqtde .' '.$item .' no seu carrinho.</p>
                                <p class="subtotal">
                                    <span class="label">Carrinho Subtotal:</span> <span class="price">R$ '. \Lib\Tools::convertToDecimalBR($subtotal) .'</span>
                                </p>
                            </div>
                            <div class="actions">
                                <button type="button" title="Finalizar Pedido" class="button" onclick="setLocation(\'/checkout/onepage/\')"><span><span>Finalizar</span></span></button>
                                <a class="view-cart" href="/checkout/carrinho/" title="Visualizar carrinho">Visualizar carrinho</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    text_confirm_delete_item = "Tem certeza de que deseja remover este item do carrinho de compras?";
    var text_cart_total = "%total% '.$item .' - %price%";
</script>';


$json = [];
$json['html'] = $html;
$json['summary_qty'] = $totalqtde;
$json['subtotal'] = '<span class="price">R$ '. \Lib\Tools::convertToDecimalBR($subtotal) .'</span>';

echo json_encode($json);
