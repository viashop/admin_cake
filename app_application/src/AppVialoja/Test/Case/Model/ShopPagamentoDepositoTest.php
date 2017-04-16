<?php
App::uses('ShopPagamentoDeposito', 'Model');

/**
 * ShopPagamentoDeposito Test Case
 *
 */
class ShopPagamentoDepositoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_pagamento_deposito'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopPagamentoDeposito = ClassRegistry::init('ShopPagamentoDeposito');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopPagamentoDeposito);

		parent::tearDown();
	}

}
