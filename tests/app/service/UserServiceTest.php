<?php

require_once('C:\xampp\htdocs\masterlampart\vendor\autoload.php');
use App\Service\UserService;
use Config\Database;


class UserServiceTest extends PHPUnit_Framework_TestCase
{
	protected $_userService;

	public function setup()
	{
		$this->_userService = new UserService();

	}

	public function testRegistration()
	{

	}

	public function testLogin()
	{
		$data = [
			'username' => 'trinhtrinh',
			'password' => '123123@',
		];
		$this->assertEquals('19d40526d4f412f467b7e06be025b921',md5($data['password']));

	}


	public function testConfirm()
	{

	}

	public function testChange_profile()
	{

	}

	public function testChange_password()
	{

	}

	public function testChange_email()
	{

	}

	public function testValidate_data_before_call_db()
	{
		$this->_userService = new UserService();

		$data            = [
			'fullname'    => 'lalala Nguyen',
			'code'        => '123132',
			'username'    => 'lalala',
			'email'       => 'lalala@gmail.com',
			'password'    => 'lalala@',
			're_password' => 'lalala@',
			'address'     => 'lalala at Sanfran',
			'sex'         => '1',
			'date'        => '12',
			'month'       => '02',
			'year'        => '1995',
			'birthday'    => '1995-02-12',
		];
		$result          = [];
		$result['error'] = false;
		$result          = $this->_userService->validate_data_before_call_db($data, $result);
		$this->assertArraySubset(["error" => false], $result);

	}

	public function testInsert_and_send_mail_activate_acc()
	{

	}

	public function testValidate_change_profile()
	{

	}

	public function testSend_mail_change_email()
	{

	}

	public function testUpdate_user_change_profile()
	{

	}

}
