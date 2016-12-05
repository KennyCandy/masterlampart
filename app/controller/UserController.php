<?php
namespace App\Controller;

use App\Model\User;
use App\Service\UserService;
use Exception;

/**
 * This is a class UserController
 */
class UserController extends Controller
{
	/**
	 * UserController constructor.
	 */
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
			redirect('/');
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
				$user_service = new UserService();
				$data         = $user_service->registration($data);
				//$this->_data['email'] = $data['email'];
				if ($data["error"] == false) {
					redirect("/user/successful");
				}
			}
			$_SESSION['captcha'] = simple_php_captcha();
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
			$this->_view->load_view('successful',$data);
		} catch (Exception $e) {
			redirect('/user/home');
		}
	}


	/**
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
					$GLOBALS['user_id']  = $data["user"]["id"];
					echo("<script>console.log('PHP: " . 'user_id is set' . "');</script>");
					redirect('/user/home');
				}
			}
			$this->_view->load_view('login', $data);

		} catch (Exception $e) {
			echo("<script>console.log('PHP: " . 'fail' . "');</script>");
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
				$data_change = [
					'id'    => $this->_data['user']['id'],
					'email' => htmlspecialchars($_POST['email']),
				];

				$user_service  = new UserService();
				$change_result = $user_service->change_email($data_change);

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
	 * logout
	 */
	public function logout()
	{
		session_unset();
		redirect();
	}

	/**
	 * action profile
	 *
	 * @param array $params
	 */
	public function profile($params = [])
	{
		$userModal    = new User();
		$user         = $userModal->find_id($params[0]);
		$data['user'] = $user;
		// if edit_status = true is edit mode, if false is view mode
		$data['edit_status'] = false;
		if (!isset($_SESSION['user_id'])) {
			//redirect();
			echo '<pre>';
			print_r('user_id is not found');
			echo '</pre>';
			die();
		} else {

			if (isset($_POST['fullname'])) {
				$data         = $this->_data;
				$data['page'] = 'Profile';

				$id        = $this->_data['user']['id'];
				$edit_data = [
					'fullname' => htmlspecialchars($_POST['fullname']),
					'address'  => htmlspecialchars($_POST['address']),
					'birthday' => $_POST['birthday'],
					'sex'      => $_POST['sex'],
				];

				$user_service  = new UserService();
				$change_result = $user_service->change_profile($id, $edit_data);

				if ($change_result["error"]) {
					$data["edit_status"] = true;
					$data["message"]     = $change_result["message"];
				} else {
					$data['edit_status']      = false;
					$data['user']['fullname'] = $change_result['fullname'];
					$data['user']['address']  = $change_result['address'];
					$data['user']['birthday'] = $change_result['birthday'];
					$data['user']['sex']      = $change_result['sex'];
				}
			}
			$this->_view->load_view('profile', $data);
		}
	}

	/**
	 * @return array
	 */
	public function refresh_captcha()
	{
		// refresh a new captcha
		$_SESSION['captcha'] = simple_php_captcha();
	}

	/**
	 * action confirm
	 *
	 * @param $params
	 */
	public function confirm($params = [])
	{
		try {
//			if (!isset($this->_data['error'])) {
//				throw new Exception("Error");
//			}
			$data = $this->_data;
			try {
				$token_code      = $params[0];

				if (!validate($token_code, 'token')) {
					throw new Exception("Token is invalid");
				}

				$user_service   = new UserService;
				$confirm_result = $user_service->confirm($token_code);

				if ($confirm_result["error"]) {
					throw new Exception($confirm_result["message"]);
				}

				$data["error"]     = false;
				$data['message'][] = $confirm_result["message"];
			} catch (Exception $e) {
				$data["error"]     = true;
				$data['message'][] = $e->getMessage();
			}

			$this->_view->load_view('confirm/confirm-result', $data);
		} catch (Exception $e) {
			redirect('/user/home');
		}
	}
}