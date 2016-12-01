<?php
namespace App\Controller;

use App\Model\Test;
use App\Service\UserService;
use \Exception;

/**
 * This is a class UserController
 */
class UserController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	/**
	 *
	 */
	public function home()
	{
		try {
			if (isset($this->_data["error"])) {
				throw new Exception('');
			}
			$data = $this->_data;
			$this->_view->load_view('home', $data);
		} catch (Exception $e) {
			redirect();
		}
	}


	/**
	 *
	 */
	public function registration()
	{
		try {
			if (isset($_SESSION['user_id'])) {
				throw new Exception("");
			}
			$data = [];

			if (isset($_POST['fullname'])) {
				$data         = [
					'code'        => htmlspecialchars($_POST['code']),
					'fullname'    => trim(htmlspecialchars($_POST['fullname'])),
					'username'    => htmlspecialchars($_POST['username']),
					'email'       => htmlspecialchars($_POST['email']),
					'password'    => htmlspecialchars($_POST['password']),
					're_password' => htmlspecialchars($_POST['re-password']),
					'address'     => htmlspecialchars($_POST['address']),
					'sex'         => $_POST['sex'],
					'birthday'    => $_POST['birthday'],
				];
				$user_service = new UserService;
				$data         = $user_service->registration($data);
				if ($data["error"] == false) {
					redirect("/user/successful");
				}
			}
			$this->_view->load_view('registration', $data);
		} catch (Exception $e) {
			redirect('/user/home');
		}
	}


	/**
	 *
	 */
	public function successful()
	{
		try {
			if (!isset($this->_data["error"])) {
				throw new Exception("Error");
			}
			$data = $this->_data;
			$this->_view->load_view('successful');
		} catch (Exception $e) {
			redirect('/user/home');
		}
	}

	/**
	 * action login
	 *
	 */
	public function login()
	{
		try {
			if (!isset($this->_data["error"])) {
				throw new Exception("Error");
			}
			$data = [];

			if (isset($_POST['username'])) {

				$user_service = new UserService();
				$user_info    = [
					"username" => htmlspecialchars($_POST['username']),
					"password" => htmlspecialchars($_POST['password']),
				];
				$data         = $user_service->login($user_info);

				if ($data["error"] == false) {
					$_SESSION['user_id'] = $data["user"]["id"];
					redirect('/user/successful');
				}
			}

			$this->_view->load_view('login', $data);
		} catch (Exception $e) {
			redirect('/user/home');
		}
	}

	/**
	 *
	 */
	public function change_email()
	{
		try {
			if (!isset($_SESSION['user_id'])) {
				throw new Exception("Error");
			}

			$data                = $this->_data;
			$data['page']        = 'Change email';
			$data['edit_status'] = true;

			if (isset($_POST['email'])) {
				$id            = $this->_data['user']['id'];
				$email         = $_POST['email'];
				$user_service  = new UserService();
				$change_result = $user_service->change_email($id, $email);

				if (!$change_result["error"]) {
					$data['edit_status'] = false;
				} else {
					$data['message'][] = $change_result["message"];
				}
			}

			$this->_view->load_view('change-email', $data);
		} catch (Exception $e) {
			redirect();
		}

	}


	/**
	 *
	 */
	public function change_password()
	{
		try {
			if (!isset($_SESSION['user_id'])) {
				throw new Exception("Error");
			}

			$data                = $this->_data;
			$data['page']        = 'Change password';
			$data['edit_status'] = true;

			if (isset($_POST['password'])) {
				try {
					$data['edit_status'] = false;
					$data_change         = [
						"id"               => $this->_data['user']['id'],
						"password"         => htmlspecialchars($_POST['password']),
						"new_password"     => htmlspecialchars($_POST['new-password']),
						"confirm_password" => htmlspecialchars($_POST['confirm-password']),
					];

					$user_service  = new UserService();
					$change_result = $user_service->change_password($data_change);
					if ($change_result["error"]) {
						throw new Exception($change_result["message"]);
					}
				} catch (Exception $e) {
					$data['edit_status'] = true;
					$data['message'][]   = $e->getMessage();
				}
			}

			$this->_view->load_view('change-password', $data);
		} catch (Exception $e) {
			redirect();
		}
	}

	/**
	 * action logout
	 *
	 */
	public function logout()
	{
		session_unset('user_id');
		redirect();
	}

	/**
	 * action confirm
	 *
	 */
	public function confirm($params)
	{
		try {
			if (!isset($this->_data['error'])) {
				throw new Exception("Error");
			}
			$data = $this->_data;
			try {
				$key = $params[0];

				if (!validate($key, 'token')) {
					throw new Exception("Token invalid");
				}

				$user_service   = new UserService;
				$confirm_result = $user_service->confirm($key);

				if ($confirm_result["error"]) {
					throw new Exception($confirm_result["message"]);
				}

				$data["error"]     = false;
				$data['message'][] = $confirm_result["message"];
			} catch (Exception $e) {
				$data["error"]     = true;
				$data['message'][] = $e->getMessage();
			}

			$this->_view->load_view('confirm.result', $data);
		} catch (Exception $e) {
			redirect('/user/home');
		}
	}
}