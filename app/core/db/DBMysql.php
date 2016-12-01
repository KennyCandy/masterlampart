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
	 * (PHP 5 &gt;= 5.1.0, PECL pdo &gt;= 0.1.0)<br/>
	 * Creates a PDO instance representing a connection to a database
	 * @link http://php.net/manual/en/pdo.construct.php
	 * @param $dsn
	 * @param $username [optional]
	 * @param $passwd [optional]
	 * @param $options [optional]
	 */
	public function connect($dsn = '', $user = '', $pass = '')
	{
		$this->db = new PDO($dsn, $user, $pass);

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