<?php
namespace Config;


/**
 * Class Database
 * @package Config
 */

class Database
{
	public static function connect_database()
	{
		//init database
		$DB_driver       = "DB" . ucfirst(strtolower(Env::DB_TYPE));
		$DB_driver_class = "App\\Core\\DB\\$DB_driver";
		$CONNECTION_VAR  = new $DB_driver_class();
		$is_created      = $CONNECTION_VAR->connect("mysql:host=" . Env::DB_HOST . ";dbname=" . Env::DB_NAME,
			Env::DB_USER, Env::DB_PASS);
		echo("<script>console.log('PHP: " . $is_created . "');</script>");

		return $CONNECTION_VAR;
	}
	public static function connect_database_test()
	{
		//init database
		$DB_driver       = "DB" . ucfirst(strtolower(Env::DB_TYPE_TEST));
		$DB_driver_class = "App\\Core\\DB\\$DB_driver";
		$CONNECTION_VAR  = new $DB_driver_class();
		$is_created      = $CONNECTION_VAR->connect("mysql:host=" . Env::DB_HOST_TEST . ";dbname=" . Env::DB_NAME_TEST,
			Env::DB_USER_TEST, Env::DB_PASS_TEST);
		echo("<script>console.log('PHP: " . $is_created . "');</script>");

		return $CONNECTION_VAR;
	}

}