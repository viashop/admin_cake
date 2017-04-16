<?php
App::uses('ClienteShop', 'Model');

/**
 * ClienteShop Test Case
 *
 */
class ClienteShopTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cliente_shop'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClienteShop = ClassRegistry::init('ClienteShop');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClienteShop);

		parent::tearDown();
	}

}
