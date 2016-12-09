<?php

// this is the ‘entry-point’ file
// start session and define DIR_PATH
session_start();
date_default_timezone_set('Asia/Bangkok');
/**
 * Directory path
 */
define('DIR_PATH', __DIR__);

require_once DIR_PATH . "/vendor/autoload.php";
use Config\Database;
use Config\Route;
use App\Core\Router;

// init router
$router = new Router();
$route  = new Route($router);
$router = $route->getRoute();

// parse uri to controller, method and argument
//$_SERVER['REQUEST_URI'] = str_replace("/masterlampart", "", $_SERVER['REQUEST_URI']);
// accept if in debug mode with Xdebug without redirect to 404 page
if (strpos($_SERVER['REQUEST_URI'], 'XDEBUG_SESSION_START') !== false) {
	$_SERVER['REQUEST_URI'] = '/';
}
list($controller, $action, $args) = get_controller_in_charged($router);
// connect database and create CONNECTION_VAR to use global in BaseModel Class
$CONNECTION_VAR = Database::connect_database();

// call controller in charged to run action and then to render the corresponding view
if (class_exists($controller)) {
	$controller_in_charged = new $controller();
	if (count($args) == 0) {
		$controller_in_charged->{$action}();
		$controller_in_charged->render_page();
	} else {
		$controller_in_charged->{$action}($args);
		$controller_in_charged->render_page();
	}
} else {
	die("Error : Do not exist this controller!");
}

