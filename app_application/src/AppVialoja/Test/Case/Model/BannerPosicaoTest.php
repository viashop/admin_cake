<?php
App::uses('BannerPosicao', 'Model');

/**
 * BannerPosicao Test Case
 *
 */
class BannerPosicaoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.banner_posicao'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BannerPosicao = ClassRegistry::init('BannerPosicao');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BannerPosicao);

		parent::tearDown();
	}

}
