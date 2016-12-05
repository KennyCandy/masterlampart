<?php


require_once('C:\xampp\htdocs\masterlampart\vendor\autoload.php');

class TokenTest extends PHPUnit_Framework_TestCase
{
	public $test;

	public function setUp()
	{
		$this->test = new \App\Model\Token();
	}

	public function testTableName()
	{
		$this->assertEquals('token', $this->test->getTable());
	}
}
