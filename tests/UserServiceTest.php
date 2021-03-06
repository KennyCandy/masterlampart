<?php

require_once('C:\xampp\htdocs\masterlampart\vendor\autoload.php');
use App\Service\UserService;
use Config\Database;

class UserServiceTest extends PHPUnit_Framework_TestCase {

    protected $_userService;

    public function setup() {
        $this->_userService = new UserService();

    }

    public function testLogin_User_Invalid() {
        $this->_userService = new UserService();
        $data               = [
            'username' => 'trinhtrinh12@#12',
            'password' => '123123@',
        ];
        $result             = $this->_userService->login($data);
        // $this->assertEquals('19d40526d4f412f467b7e06be025b921',md5($data['password']);
        $this->assertArraySubset(['error' => true], $result);
    }

    public function testLogin_Password_Invalid() {
        $this->_userService = new UserService();
        $data               = [
            'username' => 'trinhtrinh',
            'password' => '123121sadasd()',
        ];
        $result             = $this->_userService->login($data);
        $this->assertArraySubset(['error' => true], $result);
    }

    public function testChange_email_empty_fail() {
        $this->_userService = new UserService();

        $data   = [
            'email' => '',
        ];
        $result = $this->_userService->change_email($data);
        $this->assertArraySubset(["error" => true], $result);
    }

    public function testChange_email_invalid_fail() {
        $this->_userService = new UserService();
        $data               = [
            'id'    => '102',
            'email' => 'nguyenquoctrinhctt3gmailcom',
        ];
        $result             = $this->_userService->change_email($data);
        $this->assertArraySubset(["error" => true], $result);
    }

    public function testChange_email_duplicate_fail() {
        $this->_userService = new UserService();

        $data   = [
            'id'    => '102',
            'email' => 'nguyenquoctrinhctt3@gmail.com',
        ];
        $result = $this->_userService->change_email($data);
        $this->assertArraySubset(["error" => true], $result);
    }

    public function testValidate_data_before_call_db_Succeed() {
        $this->_userService = new UserService();
        $data               = [
            'fullname'    => 'lalala Nguyen',
            'code'        => '123132',
            'username'    => 'lalala',
            'email'       => 'lalala@gmail.com',
            'password'    => 'lalala@',
            're_password' => 'lalala@',
            'address'     => 'lalala at Sanfran',
            'sex'         => '1',
            'date'        => '12',
            'month'       => '02',
            'year'        => '1995',
            'birthday'    => '1995-02-12',
        ];
        $result             = [];
        $result['error']    = false;
        $this->_userService->validate_data_before_call_db($data, $result);
        $this->assertArraySubset(["error" => false], $result);
    }

    public function testValidate_data_before_call_db_Fail() {
        $this->_userService = new UserService();
        $data               = [
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
        $result             = [];
        $result['error']    = false;
        $result             = $this->_userService->validate_data_before_call_db($data, $result);
        $this->assertArraySubset(["error" => true], $result);
    }

    public function testValidate_change_profile_fail() {
        $this->_userService = new UserService();
        $data               = [
            'fullname' => '',
            'address'  => '',
            'sex'      => '',
            'birthday' => '2001-20-20',
        ];
        list($result, $error) = $this->_userService->validate_change_profile($data);
        $this->assertEquals(true, $error, 'error is true');

        $this->assertArrayHasKey('message', $result);
    }

    public function testValidate_change_profile_succeed() {
        $this->_userService = new UserService();
        $data               = [
            'fullname' => 'trinh Nguyen quoc',
            'address'  => 'district 7',
            'sex'      => '1',
            'birthday' => '2001-10-10',
        ];
        list($result, $error) = $this->_userService->validate_change_profile($data);
        $this->assertEquals(false, $error, 'error is false');
        $this->assertArrayNotHasKey('message', $result);
    }


    public function testValidate_before_change_password_fail_id() {
        $this->_userService = new UserService();
        $data               = [
            'id'               => '',
            'password'         => '',
            'new_password'     => 'trinhtrinh@',
            'confirm_password' => 'trinhtrinh@',
        ];
        $result             = [];
        try {
            $this->_userService->validate_before_change_password($data);
        } catch (Exception $e) {
            $result['message'] = $e->getMessage();
        }
        $this->assertNotNull($result);
    }

    public function testValidate_before_change_password_fail_password() {
        $this->_userService = new UserService();
        $data               = [
            'id'               => '101',
            'password'         => '12',
            'new_password'     => 'trinhtrinh@',
            'confirm_password' => 'trinhtrinh@',
        ];
        $result             = [];
        try {
            $this->_userService->validate_before_change_password($data);
        } catch (Exception $e) {
            $result['message'] = $e->getMessage();
        }
        $this->assertNotNull($result);
    }

    public function testValidate_before_change_password_fail_confirm_password() {
        $this->_userService = new UserService();
        $data               = [
            'id'               => '101',
            'password'         => 'trinhtrinh!',
            'new_password'     => 'trinhtrinh',
            'confirm_password' => 'trinhtrinh@',
        ];
        $result             = [];
        try {
            $this->_userService->validate_before_change_password($data);
        } catch (Exception $e) {
            $result['message'] = $e->getMessage();
        }
        $this->assertNotNull($result);
    }

    public function testValidate_before_change_password_fail_current_password() {
        $this->_userService = new UserService();
        $data               = [
            'id'               => '101',
            'password'         => 'trinhtrinh!',
            'new_password'     => 'trinhtrinh!',
            'confirm_password' => 'trinhtrinh!',
        ];
        $result             = [];
        try {
            $this->_userService->validate_before_change_password($data);
        } catch (Exception $e) {
            $result['message'] = $e->getMessage();
        }
        $this->assertNotNull($result);
    }

    public function testValidate_before_change_password_succeed() {
        $this->_userService = new UserService();
        $data               = [
            'id'               => '101',
            'password'         => 'trinhtrinh!',
            'new_password'     => 'trinhtrinh@',
            'confirm_password' => 'trinhtrinh@',
        ];
        list($id, $password, $new_password) = $this->_userService->validate_before_change_password($data);
        $this->assertEquals('101', $id, 'Id is not Equal');
        $this->assertEquals('trinhtrinh!', $password, 'password is not Equal');
        $this->assertEquals('trinhtrinh@', $new_password, 'new_password is not Equal');
    }


}
