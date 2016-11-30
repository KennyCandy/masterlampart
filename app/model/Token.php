<?php
namespace App\Model;

use App\Core\BaseModel as BaseModel;


/**
 * Class Token
 * @package App\Model
 */
class Token extends BaseModel
{
    public function __construct(){
        parent::__construct();
        // set table
        $this->_table = 'token';
    }

}