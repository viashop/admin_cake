<?php
App::uses('ShopPagamentoBoleto', 'Model');

/**
 * ShopPagamentoBoleto Test Case
 *
 */
class ShopPagamentoBoletoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_pagamento_boleto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopPagamentoBoleto = ClassRegistry::init('ShopPagamentoBoleto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopPagamentoBoleto);

		parent::tearDown();
	}

}
