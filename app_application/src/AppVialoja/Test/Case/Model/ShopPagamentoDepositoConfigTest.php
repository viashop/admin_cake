<?php
App::uses('ShopPagamentoDepositoConfig', 'Model');

/**
 * ShopPagamentoDepositoConfig Test Case
 *
 */
class ShopPagamentoDepositoConfigTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_pagamento_deposito_config'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopPagamentoDepositoConfig = ClassRegistry::init('ShopPagamentoDepositoConfig');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopPagamentoDepositoConfig);

		parent::tearDown();
	}

}
