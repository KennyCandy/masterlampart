<?php
namespace App\Model;

use App\Core\BaseModel as BaseModel;


/**
 * Class User
 * @package App\Model
 */
class User extends BaseModel
{
	/**
	 * User constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		//set table
		$this->_table = 'user';
	}


	/**
	 * @param $id
	 *
	 * @return bool
	 */
	public function find_id($id)
	{
		return $this->select()->where("id", $id)->first();
	}

	/**
	 * @param       $id
	 * @param array $params
	 *
	 * @return bool
	 */
	public function update_id($id, $params = [])
	{
		return $this->where('id', $id)->update($params);
	}

	/**
	 * @param $username
	 * @param $password
	 *
	 * @return bool
	 */
	public function login($username, $password)
	{
		return $this->where('username', $username)->where('password', md5($password))->first();
	}
}