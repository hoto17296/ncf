<?php
App::uses('Tank', 'Model');

/**
 * Tank Test Case
 *
 */
class TankTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tank',
		'app.fish'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tank = ClassRegistry::init('Tank');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tank);

		parent::tearDown();
	}

}
