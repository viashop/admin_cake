<?php
App::uses('ShopUrlUso', 'Model');

/**
 * ShopUrlUso Test Case
 *
 */
class ShopUrlUsoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_url_uso'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopUrlUso = ClassRegistry::init('ShopUrlUso');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopUrlUso);

		parent::tearDown();
	}

}
