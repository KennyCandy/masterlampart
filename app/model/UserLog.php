<?php

namespace App\Model;

use App\Core\BaseModel as BaseModel;

/**
 * Class UserLog
 *
 * @package App\Model
 */
class UserLog extends BaseModel {

    public function __construct() {
        parent::__construct();
        // set table
        $this->_table = 'user_log';
    }

}