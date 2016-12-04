<?php

// this is the ‘entry-point’ file
// start session and define DIR_PATH
session_start();
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

// create a app by checking the route if it is matched.
$app = $router->match($_SERVER);
if ($app === null) {
	$controller = "App\\Controller\\WelcomeController";
	$method     = "error_404";
	$args       = [];
} else {
	$controller = "App\\Controller\\" . $app['controller'];
	$method     = $app['method'];
	$args       = $app['args'];
}
require_once DIR_PATH . "/public/libs/simple-php-captcha/simple-php-captcha.php";



// connect database and create CONNECTION_VAR to use global in BaseModel Class
$CONNECTION_VAR = Database::connect_database();

// call controller and run
if (class_exists($controller)) {
	$controller_in_charged = new $controller();
	if (count($args) == 0) {
		$controller_in_charged->{$method}();
	} else {
		$controller_in_charged->{$method}($args);
	}
} else {
	die("Error : Do not exist this controller!");
}

