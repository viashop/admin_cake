<?php
App::uses('ShopProduto', 'Model');

/**
 * ShopProduto Test Case
 *
 */
class ShopProdutoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_produto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopProduto = ClassRegistry::init('ShopProduto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopProduto);

		parent::tearDown();
	}

}
