<?php
namespace App\Core;


/**
 * Class BaseController
 * @package App\Core
 */
abstract class BaseController
{
	/**
	 * @var BaseController
	 */
	protected static $_instance;

	/**
	 * @var BaseView
	 */
	protected $_view;

	/**
	 * BaseController constructor.
	 */
	public function __construct()
	{
		self::$_instance = &$this;
		$this->_view     = new BaseView();
	}

	/**
	 * @param       $view
	 * @param array $data
	 */
	public function load_template_before($view, $data = [])
	{
		$this->_view->load_template_before($view, $data);
	}

	/**
	 * @param       $view
	 * @param array $data
	 */
	public function load_template_after($view, $data = [])
	{
		$this->_view->load_template_after($view, $data);
	}

	/**
	 * render page when controller shuts down.
	 */
	public function __destruct()
	{
		$this->_view->render_page();
	}

	/**
	 * @return BaseController
	 */
	public static function get_instance()
	{
		return self::$_instance;
	}
}