<?php
App::uses('ShopPagamentoFacilitador', 'Model');

/**
 * ShopPagamentoFacilitador Test Case
 *
 */
class ShopPagamentoFacilitadorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_pagamento_facilitador'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopPagamentoFacilitador = ClassRegistry::init('ShopPagamentoFacilitador');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopPagamentoFacilitador);

		parent::tearDown();
	}

}
