<?php

use App\Model\User;
class UserTest extends PHPUnit_Framework_TestCase
{
	public $test;

	public function setUp()
	{
		$this->test = new User();
	}

	public function testName()
	{
		$jason = $this->test;
		$this->assertTrue(true,'');
	}
}