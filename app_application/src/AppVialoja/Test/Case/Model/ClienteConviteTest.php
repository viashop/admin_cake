<?php
App::uses('ClienteConvite', 'Model');

/**
 * ClienteConvite Test Case
 *
 */
class ClienteConviteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cliente_convite'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClienteConvite = ClassRegistry::init('ClienteConvite');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClienteConvite);

		parent::tearDown();
	}

}
