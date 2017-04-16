<?php
App::uses('CodigoCorreio', 'Model');

/**
 * CodigoCorreio Test Case
 *
 */
class CodigoCorreioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.codigo_correio'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CodigoCorreio = ClassRegistry::init('CodigoCorreio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CodigoCorreio);

		parent::tearDown();
	}

}
