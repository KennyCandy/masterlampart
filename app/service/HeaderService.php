<?php
namespace App\Service;

use App\Model\User;
use Exception;

/**
 * Class HeaderService
 * @package App\Service
 */
Class HeaderService extends Service {
	/**
	 * @param $id
	 *
	 * @return array
	 */
	public function load_data($id)
	{
		$data = array("error" => false);
		try {
			$user = new User();
			$user_find = $user->find_id($id);

			if(!$user_find) {
				throw new Exception("");
			}

			$data["user"] = $user_find;
			//$data["navbar"] = true;
		} catch (Exception $e) {
			$data["error"] = true;
		}

		return $data;
	}
}