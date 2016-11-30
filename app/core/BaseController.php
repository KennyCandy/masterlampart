<?php
namespace App\Core;

/**
 * This is a class Controller
 */
abstract class BaseController
{
	protected static $_instance;

	protected $_config;

	protected $_view;

	protected $_helper;

	public function __construct()
	{
		self::$_instance = &$this;

		$this->_view = new BaseView();

	}

	public function load_template_before($view, $data = [])
	{
		$this->_view->load_template_before($view, $data);
	}

	public function load_template_after($view, $data = [])
	{
		$this->_view->load_template_after($view, $data);
	}

	public function __destruct()
	{
		$this->_view->show();
	}

	/**
	 * @return BaseController
	 */
	public static function get_instance()
	{
		return self::$_instance;
	}
}