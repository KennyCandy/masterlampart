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

	public function testLogin_User_Invalid()
	{
		$this->_userService = new UserService();
		$data   = [
			'username' => 'trinhtrinh12@#12',
			'password' => '123123@',
		];
		$result = $this->_userService->login($data);

//		$this->assertEquals('19d40526d4f412f467b7e06be025b921',md5($data['password']);

		$this->assertArraySubset(['error' => true],$result);
	}

	public function testLogin_Password_Invalid()
	{
		$this->_userService = new UserService();
		$data   = [
			'username' => 'trinhtrinh',
			'password' => '123121sadasd()',
		];
		$result = $this->_userService->login($data);
		$this->assertArraySubset(['error' => true],$result);
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

	public function testValidate_data_before_call_db_Succeed()
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

	public function testValidate_data_before_call_db_Fail()
	{
		$this->_userService = new UserService();

		$data            = [
			'fullname'    => 'lal',
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
		$this->assertArraySubset(["error" => true], $result);
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