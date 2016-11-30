<?php
namespace App\Model;

use App\Core\DB\BaseModel as BaseModel;

/**
 * This is a class Token
 */
class Token extends BaseModel
{
    public function __construct(){
        parent::__construct();
        // set table
        $this->_table = 'token';
    }

}