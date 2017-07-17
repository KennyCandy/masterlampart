<?php

namespace App\Model;

use App\Core\BaseModel as BaseModel;

/**
 * Class UserLogView
 *
 * @package App\Model
 */
class UserLogView extends BaseModel {

    public function __construct() {
        parent::__construct();
        // set table
        $this->_table = "user_log_view";
    }
}