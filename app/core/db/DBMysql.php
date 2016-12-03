<?php
namespace App\Core\DB;

use \PDO;

/**
 * Class DBMysql
 * @package App\Core\DB
 */
class DBMysql
{
	/**
	 * @var
	 */
	protected $db;


	/**
	 * @param string $dsn
	 * @param string $username
	 * @param string $passwd
	 * @param null   $options
	 *
	 * @return string
	 */
	public function connect($dsn = '', $username = '', $passwd = '', $options = null)
	{
		$this->db = new PDO($dsn, $username, $passwd);

		return 'PDO is created';
	}


	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function query($query)
	{
		return $this->db->query($query);
	}


	/**
	 * @return mixed
	 */
	public function lastInsertId()
	{
		return $this->db->lastInsertId();
	}
}