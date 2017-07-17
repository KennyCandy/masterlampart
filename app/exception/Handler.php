<?php

namespace App\Exception;

use Exception;

/**
 * Class Handler
 *
 * @package App\Exception
 */
class Handler extends Exception {

    /**
     * Handler constructor.
     */
    public function __construct() {
        parent::__construct();
    }

}