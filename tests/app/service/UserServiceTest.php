<?php
/**
 * Created by PhpStorm.
 * User: quoc_trinh
 * Date: 07/12/2016
 * Time: 09:45
 */


use App\Service\UserService;


class UserServiceTest extends PHPUnit_Framework_TestCase
{
	protected $_userService ;
	public function setup()
	{
		$this->_userService = new UserService();
	}

	public function test()
	{
		
	}
}
