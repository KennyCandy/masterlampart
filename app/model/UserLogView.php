<?php
namespace App\Model;

use App\Core\BaseModel as BaseModel;


/**
 * Class UserLogView
 * @package App\Model
 */
class UserLogView extends BaseModel
{
    public function __construct(){
        parent::__construct();
        // set table
        $this->_table = "user_log_view";
    }

    /**
     * check user follow user action log
     *
     */
    public function is_view($user_id, $log_id)
    {
        return $this->where("user_id", $user_id)->where("log_id", $log_id)->first();
    }

}