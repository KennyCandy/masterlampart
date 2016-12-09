<?php
/**
 * Created by PhpStorm.
 * User: quoc_trinh
 * Date: 09/12/2016
 * Time: 11:25
 */


use App\Service\Confirm\ConfirmAccount;


class ConfirmAccountTest extends PHPUnit_Framework_TestCase
{

	protected $_confirmAccount;
	protected $_token;

	public function setup()
	{
		$this->_token          = [];
		$this->_confirmAccount = new ConfirmAccount($this->_token);
	}

	public function testConfirmAccount_fail()
	{
		$token                 = [
			'user_id'=>'115',
		    'status'=>'1'
		];
		$this->_token          = $token;
		$this->_confirmAccount = new ConfirmAccount($this->_token);
		$result = $this->_confirmAccount->confirm();
		$this->assertArraySubset(['status'=>false],$result);
	}
}
