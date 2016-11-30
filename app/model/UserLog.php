<?php
namespace App\Model;

use App\Core\DB\BaseModel as BaseModel;

/**
 * This is a class UserLog
 */
class UserLog extends BaseModel
{
    public function __construct(){
        parent::__construct();
        // set table
        $this->_table = 'user_log';
    }

}