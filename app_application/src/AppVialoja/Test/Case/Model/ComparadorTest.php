<?php
App::uses('Comparador', 'Model');

/**
 * Comparador Test Case
 *
 */
class ComparadorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comparador'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comparador = ClassRegistry::init('Comparador');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comparador);

		parent::tearDown();
	}

}
