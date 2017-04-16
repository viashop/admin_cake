<?php
App::uses('ShopComparadorXml', 'Model');

/**
 * ShopComparadorXml Test Case
 *
 */
class ShopComparadorXmlTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_comparador_xml'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopComparadorXml = ClassRegistry::init('ShopComparadorXml');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopComparadorXml);

		parent::tearDown();
	}

}
