<?php

//namespace Tests;
require_once('C:\xampp\htdocs\masterlampart\vendor\autoload.php');
use App\Service\UserService;


/**
 * These are required to ensure that the PDO object in the class is able to work correctly
 * @backupGlobals          disabled
 * @backupStaticAttributes disabled
 */
class DataPumpTest extends PHPUnit_Extensions_Database_TestCase
{

	/**
	 * This is the object that will be tested
	 * @var UserService
	 */
	protected $object;

	/**
	 * only instantiate pdo once for test clean-up/fixture load
	 * @var PDO
	 */
	static private $pdo = null;

	/**
	 * only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
	 * @var type
	 */
	private $conn = null;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = new UserService();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{

	}

	/**
	 * Returns the test database connection.
	 *
	 * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
	 */
	protected function getConnection()
	{
		if ($this->conn === null) {
			if (self::$pdo == null) {
				self::$pdo = new PDO('mysql:dbname=testlampart;host=localhost', 'root', '');;
			}
			$this->conn = $this->createDefaultDBConnection(self::$pdo, 'testlampart');
		}

		return $this->conn;
	}

	/**
	 * Returns the test dataset.
	 *
	 * @return PHPUnit_Extensions_Database_DataSet_IDataSet
	 */
	protected function getDataSet()
	{
		return $this->createMySQLXMLDataSet(__DIR__ . '/userservice.xml');
	}

	/**
	 * This is here to ensure that the database is working correctly
	 */
	public function testDataBaseConnection()
	{

		$this->getConnection()->createDataSet(['user']);
		$prod = $this->getDataSet();
//		echo '<pre>';
//		print_r($prod);
//		echo '</pre>';
//		die;


		$queryTable    = $this->getConnection()->createQueryTable(
			'user', 'SELECT * FROM user'
		);
		$expectedTable = $this->getDataSet()->getTable('user');
		//Here we check that the table in the database matches the data in the XML file
		$this->assertTablesEqual($expectedTable, $queryTable);
	}

	/**
	 * This is where you can put your actual tests
	 */
	public function testLogin()
	{
		$this->getConnection()->createDataSet(['user']);
		$prod          = $this->getDataSet();
		$expectedTable = $this->getDataSet()->getTable('user');


//		echo '<pre>';
//		print_r($expectedTable);
//		echo '</pre>';
//		die;

		$data = [
			'id'=>'101',
			'username' => 'trinhtrinh',
			'password' => md5('123123@'),
			'fullname' => 'trinhtrinh nguyen sasdasd',
			'sex'      => '1',
			'birthday' => '2013-02-05',
			'address'  => '&lt;div class=&quot;selection_bubble_root&quot; style=&quot;display: none;&quot;&gt;&lt;/div&gt;&lt;div class=&quot;selection_bubble_root&quot; style=&quot;display: none;&quot;&gt;&lt;/div&gt;&lt;div class=&quot;selection_bubble_root&quot; style=&quot;dis',
			'email'    => 'nguyenquoctrinhctt3@gmail.com',
			'status'   => '1',
			'group_id' => '1',
		];


		$is_st = $expectedTable->assertContainsRow($data);
		$this->assertTrue($is_st, 'Not good');
//		$result = $this->object->login($data);

//		$this->assertArraySubset(["error" => false], $result);

	}

}