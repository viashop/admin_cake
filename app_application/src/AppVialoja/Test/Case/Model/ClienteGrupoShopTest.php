<?php
App::uses('ClienteGrupoShop', 'Model');

/**
 * ClienteGrupoShop Test Case
 *
 */
class ClienteGrupoShopTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cliente_grupo_shop'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClienteGrupoShop = ClassRegistry::init('ClienteGrupoShop');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClienteGrupoShop);

		parent::tearDown();
	}

}
