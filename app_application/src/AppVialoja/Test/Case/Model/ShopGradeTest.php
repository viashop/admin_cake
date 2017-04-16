<?php
App::uses('ShopGrade', 'Model');

/**
 * ShopGrade Test Case
 *
 */
class ShopGradeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_grade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopGrade = ClassRegistry::init('ShopGrade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopGrade);

		parent::tearDown();
	}

}
