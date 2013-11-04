<?php
App::uses('Fish', 'Model');

/**
 * Fish Test Case
 *
 */
class FishTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fish',
		'app.tank',
		'app.image'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Fish = ClassRegistry::init('Fish');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Fish);

		parent::tearDown();
	}

}
