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
        $user = new User();
        $token = new Token();
        $user_info = $user->where("user_id", $this->_token['user_id'])->where('status', 1)->first();

        if ($user_info) {
            $token->where('user_id', $this->_token['id'])->where('type', "account")->update(array('status' => 1));
            $result = array("status" =>false, "message" => "Account have been active");
        } else {
            $user->update_id($this->_token['user_id'], array('status' => 1));
            $token->where('id', $this->_token['id'])->update(array('status' => 1));
            $result = array("status" =>true, "message" => "Active account success");
        }
        
        return $result;
    }
}