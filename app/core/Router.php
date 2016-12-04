<?php
namespace App\Core;


/**
 * Class Router for CRUD
 * @package App\Core
 */
class Router
{

	/**
	 * @var array
	 */
	protected $routes = [
		'GET'    => [],
		'POST'   => [],
		'PUT'    => [],
		'DELETE' => [],
	];

	/**
	 * @var array
	 */
	public $patterns = [
		':any'  => '.*',
		':id'   => '[0-9]+',
		':slug' => '[a-z-0-9\-]+',
		':name' => '[a-zA-Z]+',
	];

	/**
	 *
	 */
	const REGVAL = '/({:.+?})/';


	/**
	 * @param $path
	 * @param $handler
	 */
	public function any($path, $handler)
	{
		$this->add_route('GET', $path, $handler);
		$this->add_route('POST', $path, $handler);
		$this->add_route('PUT', $path, $handler);
		$this->add_route('DELETE', $path, $handler);
	}

	/**
	 * @param $path
	 * @param $handler
	 */
	public function get($path, $handler)
	{
		$this->add_route('GET', $path, $handler);
	}

	/**
	 * @param $path
	 * @param $handler
	 */
	public function post($path, $handler)
	{
		$this->add_route('POST', $path, $handler);
	}

	/**
	 * @param $path
	 * @param $handler
	 */
	public function put($path, $handler)
	{
		$this->add_route('PUT', $path, $handler);
	}

	/**
	 * @param $path
	 * @param $handler
	 */
	public function delete($path, $handler)
	{
		$this->add_route('DELETE', $path, $handler);
	}

	/**
	 * @param $method
	 * @param $path
	 * @param $handler
	 */
	protected function add_route($method, $path, $handler)
	{
		array_push($this->routes[$method], [$path => $handler]);
	}


	/**
	 * @param array $server
	 * @return array|bool|mixed
	 */
	public function match(array $server = [])
	{
		$request_method = $server['REQUEST_METHOD'];
		$request_uri    = $server['REQUEST_URI'];

		if (!in_array($request_method, array_keys($this->routes))) {
			return false;
		}

		$method = $request_method;
		#@TODO: Implement REST method.
		foreach ($this->routes[$method] as $resource) {

			$args    = [];
			$route   = key($resource);
			$handler = reset($resource);

			if (preg_match(self::REGVAL, $route)) {
				list($args, $uri, $route) = $this->parse_regex_route($request_uri, $route);
			}

			if (!preg_match("#^$route$#", $request_uri)) {
				unset($this->routes[$method]);
				continue;
			}

			if (is_string($handler) && strpos($handler, '@')) {
				list($ctrl, $method) = explode('@', $handler);

				return ['controller' => $ctrl, 'method' => $method, 'args' => $args];
			}

			if (empty($args)) {
				return $handler();
			}

			return call_user_func_array($handler, $args);

		}

	}

	/**
	 * @param $request_uri
	 * @param $resource
	 *
	 * @return array
	 */
	protected function parse_regex_route($request_uri, $resource)
	{
		$route = preg_replace_callback(self::REGVAL, function ($matches) {
			$patterns   = $this->patterns;
			$matches[0] = str_replace(['{', '}'], '', $matches[0]);

			if (in_array($matches[0], array_keys($patterns))) {
				return $patterns[$matches[0]];
			}

		}, $resource);

		$reg_uri = explode('/', $resource);

		$args = array_diff(array_replace($reg_uri, explode('/', $request_uri)), $reg_uri);

		return [array_values($args), $resource, $route];
	}

	/**
	 * @param $postVar
	 *
	 * @return string
	 */
	protected function getRestfullMethod($postVar)
	{
		if (array_key_exists('_method', $postVar)) {
			$method = strtoupper($postVar['_method']);
			if (in_array($method, array_keys($this->routes))) {
				return $method;
			}
		}
	}

}