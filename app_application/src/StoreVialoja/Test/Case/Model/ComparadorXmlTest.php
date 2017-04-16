<?php
App::uses('ComparadorXml', 'Model');

/**
 * ComparadorXml Test Case
 *
 */
class ComparadorXmlTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comparador_xml'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ComparadorXml = ClassRegistry::init('ComparadorXml');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ComparadorXml);

		parent::tearDown();
	}

}
