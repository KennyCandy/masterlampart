<?php

namespace Config;

/**
 * Class Route to control user's URL
 *
 * @package Config
 */
class Route {

    private $_route;

    /**
     * @param mixed $route
     */
    public function setRoute($route) {
        $this->_route = $route;
    }

    /**
     * @return mixed
     */
    public function getRoute() {
        return $this->_route;
    }


    public function __construct($router) {
        $this->_route = $router;

        $this->_route->get("/", "WelcomeController@index");
        // UserController
        $this->_route->any("/user/registration", "UserController@registration");
        $this->_route->any("/user/login", "UserController@login");
        $this->_route->get("/user/logout", "UserController@logout");
        $this->_route->get("/user/successful", "UserController@successful");
        $this->_route->get("/user/home", "UserController@home");
        $this->_route->get("/user/main", "UserController@main");
        $this->_route->any("/user/changeemail", "UserController@change_email");
        $this->_route->any("/user/changepassword", "UserController@change_password");
        $this->_route->get("/user/confirm/{:any}", "UserController@confirm");
        $this->_route->any("/user/profile", "UserController@profile");
        $this->_route->get("/user/manage", "UserController@manage");
        $this->_route->get("/user/refreshcaptcha", "UserController@refresh_captcha");
        $this->_route->get("/user/confirm/{:any}", "UserController@confirm");

    }
}