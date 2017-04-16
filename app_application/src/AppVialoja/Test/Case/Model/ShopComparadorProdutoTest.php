<?php
App::uses('ShopComparadorProduto', 'Model');

/**
 * ShopComparadorProduto Test Case
 *
 */
class ShopComparadorProdutoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_comparador_produto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopComparadorProduto = ClassRegistry::init('ShopComparadorProduto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopComparadorProduto);

		parent::tearDown();
	}

}
