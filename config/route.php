<?php
namespace Config;
/**
 * Class Route
 * @package Config
 */
class Route
{
	private $_router;

	public function __construct($router)
	{

		$this->_router = $router;

		$this->_router->get("/", "IndexController@index");

		$this->_router->any("/user/registration", "UserController@registration");
		$this->_router->any("/user/login", "UserController@login");
		$this->_router->get("/user/logout", "UserController@logout");
		$this->_router->get("/user/successful", "UserController@successful");
		$this->_router->get("/user/home", "UserController@home");
		$this->_router->any("/user/profile/{:id}", "UserController@profile");
		$this->_router->any("/user/changeemail", "UserController@change_email");
		$this->_router->any("/user/changepassword", "UserController@change_password");
		$this->_router->get("/user/manage", "UserController@manage");
		$this->_router->get("/user/confirm/{:any}", "UserController@confirm");
		$this->_router->any("/user/search", "UserController@search");
	}

	public function getRoute()
	{
		return $this->_router;
	}
}