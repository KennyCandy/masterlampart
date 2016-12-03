<?php
namespace App\Service\Confirm;

/**
 * Class Confirm
 * @package App\Service\Confirm
 */
abstract class Confirm
{

	/**
	 * @var array
	 */
	protected $_token = array();

	/**
	 * Confirm constructor.
	 *
	 * @param $token
	 */
	public function __construct($token)
    {
        $this->_token = $token;
    }

	/**
	 * @return mixed
	 */
	abstract public function confirm();
}