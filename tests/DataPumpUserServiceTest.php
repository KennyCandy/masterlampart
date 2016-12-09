<?php

//namespace Tests;
require_once('C:\xampp\htdocs\masterlampart\vendor\autoload.php');
use App\Service\UserService;


/**
 * These are required to ensure that the PDO object in the class is able to work correctly
 * @backupGlobals          disabled
 * @backupStaticAttributes disabled
 */
class DataPumpUserServiceTest extends PHPUnit_Extensions_Database_TestCase
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
		// connect to database which is created for testing
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
		$prod          = $this->getDataSet();
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
		$data_set      = $this->getDataSet();
		$expectedTable = $data_set->getTable('user');
		$data          = [
			'id'       => '101',
			'username' => 'trinhtrinh',
			'password' => md5('123123@'),
			'fullname' => 'trinhtrinh nguyen sasdasd',
			'sex'      => '1',
			'birthday' => '2013-02-05',
			'address'  => 'Nguyen van quy',
			'email'    => 'nguyenquoctrinhctt3@gmail.com',
			'status'   => '1',
			'group_id' => '1',
		];
		$is_st         = $expectedTable->assertContainsRow($data);
		$this->assertTrue($is_st, 'compare 2 tables ');
	}

	public function testLogin_succeed()
	{
		$data   = [
			'username' => 'trinhtrinh',
			'password' => '123123@',

		];
		$result = $this->object->login($data);

		$this->assertArraySubset(['error' => false], $result);
		$this->assertCount(10, $result['user'], 'Count user data');
	}

	public function test_confirm_token_not_exist()
	{
		$token_code_data = '123456789';
		$result          = $this->object->confirm($token_code_data);
		$this->assertArraySubset(['error' => true], $result);
	}

	public function test_confirm_class_not_exist()
	{
		$token_code_data = '123456789';
		$result          = $this->object->confirm($token_code_data);
		$this->assertArraySubset(['error' => true], $result);
	}

	public function testRegistration_fail()
	{
		$data   = [
			'fullname'    => 'lalala~',
			'code'        => '123132~',
			'username'    => 'lalala~',
			'email'       => 'lalalagmail.com',
			'password'    => 'lalala~',
			're_password' => 'lalala@',
			'address'     => '',
			'sex'         => '',
			'date'        => '12',
			'month'       => '02',
			'year'        => '1995',
			'birthday'    => '1995-16-12',
		];
		$result = $this->object->registration($data);
		$this->assertArraySubset(['error' => true], $result);
	}

	public function testSend_mail_change_email_fail()
	{
//		$id        = '101';
//		$email     = 'nguyenquoctrinhctt333@gmail.com';
//		$old_email = 'nguyenquoctrinhctt3@gmail.com';
//
//		$result = $this->object->send_mail_change_email($id,$email,$old_email);

	}
}