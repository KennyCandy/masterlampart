<?php
namespace App\Core;

use \PDO;


/**
 * Class BaseModel
 * @package App\Core
 */
abstract class BaseModel
{
	/** @var string|null $_table set table in database */
	protected $_table;

	/** @var string|null $_db_host , $_db_name, $_db_user, $_db_pass config param to connect database */
	protected $_db_host;

	/**
	 * @var
	 */
	protected $_db_name;

	/**
	 * @var
	 */
	protected $_db_user;

	/**
	 * @var
	 */
	protected $_db_pass;

	/** @var string|null $_conn store connection */
	protected $_conn;

	/** @var string|null $_result store result after run query */
	protected $_result = [];

	/** @var store all param before run query */
	protected $_query;

	/**
	 * @var
	 */
	protected $_num_row;

	/**
	 * @var string
	 */
	protected $_select = '*';

	/**
	 * @var array
	 */
	protected $_where = [];

	/**
	 * @var array
	 */
	protected $_or_where = [];

	/**
	 * @var string
	 */
	protected $_where_exist = '';

	/**
	 * @var string
	 */
	protected $_where_not_exist = '';

	/**
	 * @var array
	 */
	protected $_join = [];

	/**
	 * @var string
	 */
	protected $_sort_by = '';

	/**
	 * @var string
	 */
	protected $_group_by = '';

	/**
	 * @var int
	 */
	protected $_take = 0;

	/**
	 * @var int
	 */
	protected $_skip = 0;

	/** @var bool insert status flag */
	protected $_insert_status = false;

	/**
	 * BaseModel constructor.
	 */
	public function __construct()
	{
		global $CONNECTION_VAR;
		$this->_conn = $CONNECTION_VAR;
	}


	/**
	 * insert data to table
	 *
	 * @param array|null $params data need insert.
	 *
	 * @return bool if insert success, store insert id to $_result, enable flag $_insert_status
	 */
	public function insert($params = [])
	{
		if ($this->_table != '') {

			$query  = 'INSERT INTO `' . $this->_table . '`(`' . implode('`, `', array_keys($params)) . '`) VALUES ("' . implode('", "', $params) . '")';
			$result = $this->_conn->query($query);

			if ($result) {
				$this->_insert_status = true;
				$this->_result        = [];
				array_push($this->_result, $this->_conn->lastInsertId());
				return true;
			} else {
				return false;
			}
		}
	}

	/**
	 * check status flag $_insert_status, get row last query INSERT.
	 *
	 * @return bool result and disable flag $_insert_status
	 *
	 */
	public function get_insert()
	{

		if ($this->_insert_status) {
			$this->_insert_status = false;
			$result               = $this->where('id', $this->_result[0])->first();

			return $result;
		} else {
			return false;
		}

	}

	/**
	 * store fields need select.
	 *
	 * @param string $params
	 *
	 * @return $this
	 * @internal param $ string|* $params have string, once field is divided by comma
	 */
	public function select($params = '*')
	{
		if($params!=='*'){
			$params        = explode(',', $params);
			$this->_select = '`' . implode('`,`', $params) . '`';
		}
		else{
			$this->_select='*';
		}
		return $this;
	}


	/**
	 * store key and value in where
	 *
	 * @param string|null $key  and $value need import
	 * @param string|= $condition is =,!=,>=,<=,LIKE default =
	 * @param string  $type is AND or OR, default AND
	 *
	 * @return $this
	 */
	public function where($key, $value, $condition = '=', $type = 'AND')
	{
		$this->_where[] = [
			'key'       => $key,
			'value'     => $value,
			'condition' => $condition,
			'type'      => $type,
		];

		return $this;
	}


	/**
	 *  similar to where
	 * @param        $key
	 * @param        $value
	 * @param string $condition
	 * @param string $type
	 *
	 * @return $this
	 */
	public function or_where($key, $value, $condition = '=', $type = 'AND')
	{
		$this->_or_where[] = [
			'key'       => $key,
			'value'     => $value,
			'condition' => $condition,
			'type'      => $type,
		];

		return $this;
	}

	/**
	 * @param $table
	 * @param $condition
	 *
	 * @return $this
	 */
	public function join($table, $condition)
	{
		$this->_join[] = [
			'table'     => $table,
			'condition' => $condition,
		];

		return $this;
	}

	/**
	 * @param        $key
	 * @param string $value
	 *
	 * @return $this
	 */
	public function sort_by($key, $value = 'DESC')
	{
		$this->_sort_by = "ORDER BY $key $value";

		return $this;
	}

	/**
	 * @param int $params
	 *
	 * @return $this
	 */
	public function take($params = 0)
	{
		$this->_take = $params;

		return $this;
	}

	/**
	 * @param int $params
	 *
	 * @return $this
	 */
	public function skip($params = 0)
	{
		$this->_skip = $params;

		return $this;
	}

	/**
	 * get first row
	 *
	 */
	public function first()
	{
		$where    = (count($this->_where) != 0) ? $this->parse_where($this->_where) : '1';
		$or_where = (($where != '1') && (count($this->_or_where) != 0)) ? 'OR ' . $this->parse_where($this->_or_where) : '';

		$this->_query = "SELECT $this->_select FROM `$this->_table` WHERE $where $or_where $this->_where_exist $this->_where_not_exist $this->_sort_by LIMIT 1";
		$result       = $this->_conn->query($this->_query);
		$this->reset();

		if ($result) {
			return $result->fetch(PDO::FETCH_ASSOC);
		} else {
			return false;
		}
	}

	/**
	 * get limit row
	 *
	 */
	public function get()
	{
		$where    = (count($this->_where) != 0) ? $this->parse_where($this->_where) : '1';
		$or_where = (($where != '1') && (count($this->_or_where) != 0)) ? 'OR ' . $this->parse_where($this->_or_where) : '';
		$take     = ($this->_take != 0) ? 'LIMIT ' . $this->_take : '';
		$skip     = ($this->_limit != 0) ? 'OFFSET ' . $this->_limit : '';

		$this->_query = "SELECT $this->_select FROM `$this->_table` WHERE $where $or_where $this->_where_exist $this->_where_not_exist $this->_sort_by $take $skip";
		$result       = $this->_conn->query($this->_query);
		$this->reset();

		if ($result) {
			$data = [];

			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}

			return $data;
		} else {
			return false;
		}
	}

	/**
	 * get all row
	 *
	 */
	public function getAll()
	{
		$where    = (count($this->_where) != 0) ? $this->parse_where($this->_where) : '1';
		$or_where = (($where != '1') && (count($this->_or_where) != 0)) ? 'OR ' . $this->parse_where($this->_or_where) : '';

		$this->_query = "SELECT $this->_select FROM `$this->_table` WHERE $where $or_where $this->_where_exist $this->_where_not_exist $this->_sort_by";
		$result       = $this->_conn->query($this->_query);

		$this->reset();

		if ($result) {
			$data = [];

			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}

			return $data;
		} else {
			return false;
		}
	}

	/**
	 * count row
	 *
	 * @return number
	 *
	 */
	public function count()
	{
		$where    = (count($this->_where) != 0) ? $this->parse_where($this->_where) : "1";
		$or_where = (($where != "1") && (count($this->_or_where) != 0)) ? "OR " . $this->parse_where($this->_or_where) : "";

		$this->_query = "SELECT COUNT(*) as num_row FROM `$this->_table` WHERE $where $or_where $this->_where_exist $this->_where_not_exist";
		$result       = $this->_conn->query($this->_query);

		$this->reset();

		if ($result) {
			$row = $result->fetch(PDO::FETCH_ASSOC);

			return $row['num_row'];
		} else {
			return 0;
		}
	}

	/**
	 * @param string $query
	 * @param string $type
	 *
	 * @return array|bool
	 */
	public function query($query = "", $type = "select")
	{
		$result = $this->_conn->query($query);
		$this->reset();

		if ($result) {

			switch ($type) {
				case "select":
					$data = [];
					while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
						$data[] = $row;
					}

					return $data;
					break;

				default:
					return true;
					break;
			}
		} else {
			return false;
		}
	}

	/**
	 * @param string $query
	 *
	 * @return int
	 */
	public function count_raw($query = "")
	{
		$result = $this->_conn->query($query);
		$this->reset();

		if ($result) {
			return $result->fetchColumn();
		} else {
			return 0;
		}
	}

	/**
	 * @param array $params
	 *
	 * @return bool
	 */
	public function update($params = [])
	{
		if (count($params) > 0) {
			$update = "";

			foreach ($params as $key => $value) {
				$update .= "`$key` = '$value',";
			}

			$update   = rtrim($update, ",");
			$where    = (count($this->_where) != 0) ? $this->parse_where($this->_where) : "1";
			$or_where = (($where != "1") && (count($this->_or_where) != 0)) ? "OR " . $this->parse_where($this->_or_where) : "";

			$this->_query = "UPDATE `$this->_table` SET $update WHERE $where $or_where";
			$result       = $this->_conn->query($this->_query);

			if ($result) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * @return bool
	 */
	public function delete()
	{
		if ($this->_table != "") {
			$where    = (count($this->_where) != 0) ? $this->parse_where($this->_where) : "1";
			$or_where = (($where != "1") && (count($this->_or_where) != 0)) ? "OR " . $this->parse_where($this->_or_where) : "";

			$this->_query = "DELETE FROM `$this->_table` WHERE $where $or_where";
			$result       = $this->_conn->query($this->_query);
			$this->reset();

			if ($result) {
				return true;
			} else {
				return false;
			}
		}
	}

	/**
	 * @param array $params
	 *
	 * @return string
	 */
	public function parse_where($params = [])
	{
		$string = "";

		foreach ($params as $p) {
			$string .= $p['type'] . " " . $p['key'] . " " . $p['condition'] . " '" . $p['value'] . "' ";
		}

		$string = ltrim($string, "AND");
		$string = ltrim($string, "OR");
		$string = "(" . $string . ")";

		return $string;
	}

	/**
	 * @param array  $params
	 * @param string $type
	 *
	 * @return string
	 */
	public function parse_join($params = [], $type = "join")
	{
		$string = "";

		foreach ($params as $p) {
			$string .= $p['table'] . " ON " . $p['condition'];
		}

		switch ($type) {
			case "join":
				$string = "JOIN $string";
				break;

			case "inner":
				$string = "INNER JOIN $string";
				break;

			case "left":
				$string = "LEFT JOIN $string";
				break;

			case "right":
				$string = "RIGHT JOIN $string";
				break;

			case "full":
				$string = "FULL JOIN $string";
				break;

			default:
				break;
		}
		return $string;
	}

	/**
	 * @param string $query
	 *
	 * @return $this
	 */
	public function where_exist($query = "")
	{
		$this->_where_exist = ($query == "") ? "" : "AND EXISTS ($query)";

		return $this;
	}

	/**
	 * @param string $query
	 *
	 * @return $this
	 */
	public function where_not_exist($query = "")
	{
		$this->_where_not_exist = ($query == "") ? "" : "AND NOT EXISTS ($query)";

		return $this;
	}

	/**
	 * @param string $query
	 *
	 * @return $this
	 */
	public function group_by($query = "")
	{
		$this->_group_by = "GROUP BY $query";
		return $this;
	}


	/**
	 * reset property after run a query
	 *
	 */
	private function reset()
	{
		$this->_result          = [];
		$this->_query           = "";
		$this->_select          = "*";
		$this->_where           = [];
		$this->_or_where        = [];
		$this->_where_exist     = "";
		$this->_where_not_exist = "";
		$this->_sort_by         = "";
		$this->_join            = [];
	}
}