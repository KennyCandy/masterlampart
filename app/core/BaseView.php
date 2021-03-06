<?php

namespace App\Core;

/**
 * Class BaseView
 *
 * @package App\Core
 */
class BaseView {

    /** @var array $_content contains content to body view */
    protected $_content = [];

    /** @var array $_content contains content to before body view */
    protected $_before_content = [];

    /** @var array $_content contains content to after body view */
    protected $_after_content = [];


    /**
     * load content for before body view and save to $_content.
     *
     * @param string       $view is file view in folder view.
     * @param array|string $data contain variable need extract.
     */
    public function load_template_before($view, $data = []) {
        extract($data);
        ob_start();
        require_once DIR_PATH . "/app/view/layout/$view.php";
        $content = ob_get_contents();
        //$buffer_length = ob_get_length();
        ob_end_clean();

        $this->_before_content[] = $content;
    }

    /**
     * load content for after body view and save to $_content.
     *
     * @param string       $view is file view in folder view.
     * @param array|string $data contain variable need extract.
     */
    public function load_template_after($view, $data = []) {
        extract($data);
        ob_start();
        require_once DIR_PATH . "/app/view/layout/$view.php";
        $content = ob_get_contents();
        ob_end_clean();

        $this->_after_content[] = $content;
    }

    /**
     * load content for body view and save to $_content.
     *
     * @param string       $view is file view in folder view.
     * @param array|string $data contain variable need extract.
     */
    public function load_view($view, $data = []) {
        // standardize url
        if (preg_match("/\./", $view)) {
            $view = explode(".", $view);
            $view = implode("/", $view);
        }

        extract($data);

        ob_start();
        require_once DIR_PATH . "/app/view/$view.php";
        $content = ob_get_contents();
        ob_end_clean();

        $this->_content[] = $content;
    }

    /**
     * show/render page
     *
     */
    public function render_page() {
        foreach ($this->_before_content as $before_content) {
            echo $before_content;
        }
        foreach ($this->_content as $content) {
            echo $content;
        }
        foreach ($this->_after_content as $after_content) {
            echo $after_content;
        }
    }
}