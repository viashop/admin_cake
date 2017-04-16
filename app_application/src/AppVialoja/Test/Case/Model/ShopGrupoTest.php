<?php
App::uses('ClienteShopGrupo', 'Model');

/**
 * ClienteShopGrupo Test Case
 *
 */
class ClienteShopGrupoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_grupo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClienteShopGrupo = ClassRegistry::init('ClienteShopGrupo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClienteShopGrupo);

		parent::tearDown();
	}

}
