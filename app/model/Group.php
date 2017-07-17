<?php

namespace App\Model;

use App\Core\BaseModel as BaseModel;

/**
 * Class Group
 *
 * @package App\Model
 */
class Group extends BaseModel {

    public function __construct() {
        parent::__construct();
        //set table
        $this->_table = 'group';
    }

}