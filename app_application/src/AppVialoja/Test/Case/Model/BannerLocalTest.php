<?php
App::uses('BannerLocal', 'Model');

/**
 * BannerLocal Test Case
 *
 */
class BannerLocalTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.banner_local'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BannerLocal = ClassRegistry::init('BannerLocal');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BannerLocal);

		parent::tearDown();
	}

}
