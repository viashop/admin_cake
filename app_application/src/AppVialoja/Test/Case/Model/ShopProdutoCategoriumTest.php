<?php
App::uses('ShopProdutoCategorium', 'Model');

/**
 * ShopProdutoCategorium Test Case
 *
 */
class ShopProdutoCategoriumTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_produto_categorium'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopProdutoCategorium = ClassRegistry::init('ShopProdutoCategorium');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopProdutoCategorium);

		parent::tearDown();
	}

}
