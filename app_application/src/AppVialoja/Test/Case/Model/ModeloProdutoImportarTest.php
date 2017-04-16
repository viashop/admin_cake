<?php
App::uses('ModeloProdutoImportar', 'Model');

/**
 * ModeloProdutoImportar Test Case
 *
 */
class ModeloProdutoImportarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.modelo_produto_importar'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ModeloProdutoImportar = ClassRegistry::init('ModeloProdutoImportar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ModeloProdutoImportar);

		parent::tearDown();
	}

}
