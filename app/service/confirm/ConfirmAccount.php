<?php
namespace App\Service\Confirm;

use App\Model\Token;
use App\Model\User;
use \Exception;

/**
 * Class ConfirmAccount
 * @package App\Service\Confirm
 */
class ConfirmAccount extends Confirm
{

	/**
	 * @return array
	 */
	public function confirm()
	{
		$user  = new User();
		$token = new Token();
		// find user in database and check if it is activated or not
		$user_info = $user->where("id", $this->_token['user_id'])->where('status', 1)->first();

		// if activated -> notify and set status =>false
		if ($user_info) {
			$token->where('user_id', $this->_token['user_id'])->where('type', "account")->update(['status' => 1]);
			$result = ["status" => false, "message" => "Account has been active"];
		} else {
			// if not activated yet -> update and set status =>true
			$user->update_id($this->_token['user_id'], ['status' => 1]);
			$token->where('id', $this->_token['id'])->update(['status' => 1]);
			$result = ["status" => true, "message" => "Activate account successfully"];
		}
		return $result;
	}
}