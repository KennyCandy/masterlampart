<?php
namespace App\Controller;

use \Exception;

/**
 * This is a class IndexController
 */
class IndexController extends Controller
{   
    public function __construct()
    {   
        parent::__construct();
    }

    /**
     * action index
     *
     */
    public function index()
    {   
        $data = $this->_data;
        if (!isset($data['error'])) {
            redirect('/user/home');
        }
        
        $this->_view->load_content('welcome');
    }

    public function error_404()
    {   
        $this->_view->load_content('404');
    }
}