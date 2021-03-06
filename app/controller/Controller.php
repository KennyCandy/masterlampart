<?php

namespace App\Controller;

use App\Core\BaseController as BaseController;
use App\Service\HeaderService;
use \Exception;

/**
 * Class Controller
 *
 * @package App\Controller
 */
abstract class Controller extends BaseController {

    /**
     * @var array
     */
    protected $_data = [];

    /**
     * Controller constructor.
     */
    public function __construct() {
        parent::__construct();
        try {

            if (!isset($_SESSION['user_id'])) {
                throw new Exception("Error");
            }

            $header_service = new HeaderService();
            $data           = $header_service->load_data($_SESSION['user_id']);

            if ($data["error"] == true) {
                session_unset();
                throw new Exception("Error");
            }

            $this->_data['user'] = $data["user"];
            $this->load_template_before('header', $data);
            $this->load_template_after('footer');
        } catch (Exception $e) {
            $this->_data['error'] = true;
            $this->load_template_before('header');
            $this->load_template_after('footer');
        }
    }


}