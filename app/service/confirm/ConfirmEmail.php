<?php
namespace App\Service\Confirm;

use App\Model\Token;
use App\Model\User;


/**
 * Class ConfirmEmail
 * @package App\Service\Confirm
 */
class ConfirmEmail extends Confirm
{
	public function __construct($token)
	{
		parent::__construct($token);
	}

	/**
	 * @return array
	 */
	public function confirm()
	{
		$user      = new User();
		$user_info = $user->where('email', $this->_token['content'])->first();
		// Check whether email is existed
		if ($user_info) {
			$result = ["status" => false, "message" => "Email is existed"];
		} else {
			$user->update_id($this->_token['user_id'], ['email' => $this->_token['content']]);
			$token = new Token();
			// update status(0->1) in token is used.
			$token->where('user_id', $this->_token['user_id'])->where('status', 0)->update(['status' => 1]);
			$result = ["status" => true, "message" => "Changed email successfully!"];
		}

		return $result;
	}
}