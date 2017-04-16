<?php
App::uses('ShopProdutoImagemAssociada', 'Model');

/**
 * ShopProdutoImagemAssociada Test Case
 *
 */
class ShopProdutoImagemAssociadaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_produto_imagem_associada'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopProdutoImagemAssociada = ClassRegistry::init('ShopProdutoImagemAssociada');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopProdutoImagemAssociada);

		parent::tearDown();
	}

}
