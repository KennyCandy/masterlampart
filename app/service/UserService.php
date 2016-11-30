<?php
namespace App\Service;

use App\Model\User;
use App\Model\Token;
use App\Model\Group;
use \Exception;

/**
 * This is a class UserService
 */
class UserService extends Service
{
	/**
	 * registration new user
	 *
	 */
	public function registration($data = [])
	{
		$data["error"]   = false;
		$data["message"] = [];

		if (!validate($data['fullname'], 'fullname')) {
			$data['error']     = true;
			$data['message'][] = 'Fullname a-Z, length 4-30';
		}

		if (!validate($data['username'], 'username')) {
			$data['error']     = true;
			$data['message'][] = 'Username a-Z0-9 and underscore, length 4-30';
		}

		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$data['error']     = true;
			$data['message'][] = 'Email invalid';
		}

		if (!validate($data['password'], 'password')) {
			$data['error']     = true;
			$data['message'][] = 'Password a-Z0-9, special characters !@#$%, length 3-20';
		}

		if ($data['password'] != $data['re_password']) {
			$data['error']     = true;
			$data['message'][] = 'Re-password invalid';
		}

		if ($data['password'] == $data['username']) {
			$data['error']     = true;
			$data['message'][] = 'Username and password must different';
		}

		if (strlen($data['address']) == 0) {
			$data['error']     = true;
			$data['message'][] = 'Address is required';
		}

		if ($data['code'] != $_SESSION['code_capcha']) {
			//$data['error'] = true;
			$data['message'][] = 'Sercurity code invalid';
		}

		if (!(($data['sex'] == 1) || ($data['sex'] == 2))) {
			$data['error']     = true;
			$data['message'][] = 'Sex invalid';
		}

		if (!(checkdate(explode('-', $data['birthday'])[1], explode('-', $data['birthday'])[2], explode('-', $data['birthday'])[0]) && (strtotime($data['birthday']) < time()))) {
			$data['error']     = true;
			$data['message'][] = 'Birthday invalid';
		}

		if ($data['error'] == false) {
			$user = new User;

			//check exist username
			$username_check = $user->where('username', $data['username'])->first();
			if ($username_check) {
				$data['error']     = true;
				$data['message'][] = 'Username is exist';
			}

			//check exist email
			$email_check = $user->where('email', $data['email'])->first();

			if ($email_check) {
				$data['error']     = true;
				$data['message'][] = 'Email is exist';
			}

			if ($data['error'] == false) {
				unset($data['error']);
				unset($data['message']);
				unset($data['re_password']);
				unset($data['code']);
				$data['password'] = md5($data['password']);

				//insert
				if ($user->insert($data)) {

					$current_user = $user->get_insert();

					//create token
					$token_code = md5(time());
					$data_token = [
						'user_id' => $current_user['id'],
						'token'   => $token_code,
						'type'    => "account",
						'status'  => 0,
					];
					$token      = new Token;
					if ($token->insert($data_token)) {
						$header        = mail_header();
						$content_email = "Click <a href='http://masterlampart.me/user/confirm/$token_code'>here</a> to active account in <a href='http://dev.lampart.com.vn'>http://dev.lampart.com.vn</a> \n ";
						@mail('@lampart-vn.com', 'Active account', $content_email, $header);
					}

					$data = ["error" => false];
				} else {
					$data['error']     = true;
					$data['message'][] = 'Error when create new user';
				}
			}
		}
		$result = $data;

		return $result;
	}


	/**
	 * @param array $data
	 *
	 * @return array
	 */
	public function login($data = [])
	{
		try {
			//validate
			if (!(validate($data['username'], 'username') && validate($data['password'], 'password'))) {
				throw new Exception("Username or password invalid");
			}

			//check user exist
			$user = new User();
			$user = $user->login($data['username'], $data['password']);

			if (!$user) {
				throw new Exception("Username or password invalid");
			}

			// check active status
			if ($user['status'] == 0) {
				// throw new Exception("Please active account before login");
			}

			$result = ["error" => false, "user" => $user];
		} catch (Exception $e) {
			$result["error"]     = true;
			$result['message'][] = $e->getMessage();
		}

		return $result;
	}

	public function confirm($key)
	{
		try {
			$token      = new Token();
			$token_info = $token->where('token', $key)->where('status', 0)->first();
			if (!$token_info) {
				throw new Exception("Token not exists");
			}

			$confirm_class = "App\\Service\\Confirm\\Confirm" . ucfirst(strtolower($token_info["type"]));
			if (!class_exists($confirm_class)) {
				throw new Exception("Type token not exists");
			}

			$confirm        = new  $confirm_class($token_info);
			$confirm_result = $confirm->confirm();

			if (!$confirm_result["status"]) {
				throw new Exception($confirm_result["message"]);
			}

			$result["error"]   = false;
			$result["message"] = $confirm_result["message"];
		} catch (Exception $e) {
			$result = ["error" => true, "message" => $e->getMessage()];
		}

		return $result;
	}
}