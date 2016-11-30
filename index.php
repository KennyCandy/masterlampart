<?php

// this is the ‘entry-point’ file
// start session and define PATH
session_start();
define('PATH', __DIR__);

require_once PATH . "/vendor/autoload.php";
use Config\Database;
use Config\Route;
use App\Core\Router;


// init router
$router = new Router();
$route  = new Route($router);
$router = $route->getRoute();

// parse uri to controller, method and argument

$_SERVER['REQUEST_URI'] = str_replace("/masterlampart", "", $_SERVER['REQUEST_URI']);
$app                    = $router->match($_SERVER);


if ($app === null) {
	$controller = "App\\Controller\\WelcomeController";
	$method     = "error_404";
	$args       = [];
} else {
	$controller = "App\\Controller\\" . $app['controller'];
	$method     = $app['method'];
	$args       = $app['args'];
}


// init database
$DB_driver       = "DB" . ucfirst(strtolower(Database::DB_TYPE));
$DB_driver_class = "App\\Core\\DB\\$DB_driver";
$db              = new $DB_driver_class();
$db->connect("mysql:host=" . Database::DB_HOST . ";dbname=" . Database::DB_NAME, Database::DB_USER, Database::DB_PASS);

// call instance
function get_instance()
{
	global $controller;

	return $controller::get_instance();
}

// call controller and run
if (class_exists($controller)) {
	$ctrl = new $controller();

	if (count($args) == 0) {
		$ctrl->{$method}();
	} else {
		$ctrl->{$method}($args);
	}
} else {
	die("Error : Not exist controller");
}

