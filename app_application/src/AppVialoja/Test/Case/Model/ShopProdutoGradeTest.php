<?php
App::uses('ShopProdutoGrade', 'Model');

/**
 * ShopProdutoGrade Test Case
 *
 */
class ShopProdutoGradeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shop_produto_grade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShopProdutoGrade = ClassRegistry::init('ShopProdutoGrade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShopProdutoGrade);

		parent::tearDown();
	}

}
