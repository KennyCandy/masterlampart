<?php

//use App\Model\User;
require_once('C:\xampp\htdocs\masterlampart\vendor\autoload.php');

class UserTest extends PHPUnit_Framework_TestCase
{
	public $test;

	public function setUp()
	{
		$this->test = new \App\Model\User();
	}

	public function testTableName()
	{
		$this->assertEquals('user', $this->test->getTable());
	}

	public function testName()
	{
		$jason = $this->test;
		$this->assertTrue(true, '');
	}
}