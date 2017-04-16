<?php
App::uses('ClienteNewsletterShop', 'Model');

/**
 * ClienteNewsletterShop Test Case
 *
 */
class ClienteNewsletterShopTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cliente_newsletter_shop',
		'app.cliente',
		'app.n'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClienteNewsletterShop = ClassRegistry::init('ClienteNewsletterShop');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClienteNewsletterShop);

		parent::tearDown();
	}

}
