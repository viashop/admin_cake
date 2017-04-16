<?php

App::uses('Model', 'Model');

class ShopCarrinhoProdutoDescricao extends AppModel {
    public $name = 'ShopCarrinhoProdutoDescricao';
    public $useTable = 'shop_carrinho_produto_descricao';
    public $primaryKey = 'id_carrinho_descricao';
    public $useDbConfig = 'default';
}
