<?php
/**
 * Created by PhpStorm.
 * User: quoc_trinh
 * Date: 09/12/2016
 * Time: 11:43
 */


use App\Service\Confirm\ConfirmEmail;


class ConfirmEmailTest extends PHPUnit_Framework_TestCase
{
	protected $_confirmAccount;
	protected $_token;

	public function setup()
	{
		$this->_token          = [];
		$this->_confirmAccount = new ConfirmEmail($this->_token);
	}

	public function testConfirmEmail_fail()
	{
		$token                 = [
			'user_id'=>'115',
			'status'=>'1',
		    'content'=>'asdsadas@asdasds.com'
		];
		$this->_token          = $token;
		$this->_confirmAccount = new ConfirmEmail($this->_token);
		$result = $this->_confirmAccount->confirm();
		$this->assertArraySubset(['status'=>false],$result);
	}

}
