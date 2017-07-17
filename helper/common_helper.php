<?php
use Config\Env;

/**
 * @param $string
 * @param $type
 *
 * @return bool
 */
function validate($string, $type) {
    switch ($type) {

        case 'fullname' :
            $pattern = '/^[a-zA-Z\s]+$/';
            if (preg_match($pattern, $string)) {
                return ((strlen($string) >= 4) && (strlen($string) <= 30)) ? true : false;
            }
        break;

        case 'username' :
            $pattern = '/^([a-zA-Z0-9]+)([a-zA-Z0-9\_]*)([a-zA-Z0-9]+)$/';
            if (preg_match($pattern, $string)) {
                return ((strlen($string) >= 4) && (strlen($string) <= 30)) ? true : false;
            }
        break;

        case 'token' :
            $pattern = '/^[a-zA-Z0-9]+$/';
            if (preg_match($pattern, $string)) {
                return (strlen($string) == 32) ? true : false;
            }
        break;

        case 'password' :
            $pattern = '/^[a-zA-Z0-9\@\#\$\%\!]+$/';
            if (preg_match($pattern, $string)) {
                return ((strlen($string) >= 3) && (strlen($string) <= 20)) ? true : false;
            }
        break;
        case 'address':
            return strlen($string) > 0 ? true : false;
        break;
        case 'sex':
            return ($string == '1' || $string == '2') ? true : false;
        break;

        default :
            return false;
        break;
    }

    return false;
}

/**
 * @param string $url
 */
function redirect($url = '') {
    $url = Env::APP_URL . ltrim($url, '/');
    header("Location: $url");
    exit();
}

/**
 * @return string
 *
 */
function get_mail_header() {
    $headers = 'From: ' . Env::EMAIL_FROM . "\r\n" . 'Reply-To: ' . Env::EMAIL_REPLY_TO . "\r\n" . "Content-Type: text/html; charset=UTF-8 \r\n" . 'X-Mailer: PHP/' . phpversion();

    return $headers;
}

/**
 * @param $router
 *
 * @return array
 */
function get_controller_in_charged($router) {
    // create a app by checking the route if it is matched.
    $app = $router->match($_SERVER);
    if ($app === null) {
        $controller = "App\\Controller\\WelcomeController";
        $action     = "error_404";
        $args       = [];

        return [$controller, $action, $args];
    } else {
        $controller = "App\\Controller\\" . $app['controller'];
        $action     = $app['method'];
        $args       = $app['args'];

        return [$controller, $action, $args];
    }
}

