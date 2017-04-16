<?php
App::uses('ShopBanner', 'Model');

/**
 * ShopBanner Test Case
 *
 */
class ShopBannerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_banner'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopBanner = ClassRegistry::init('ShopBanner');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopBanner);

		parent::tearDown();
	}

}
