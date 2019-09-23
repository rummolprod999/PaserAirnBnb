<?php
// from https://toster.ru/q/178365
require_once 'controllers/DefaultController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/StatController.php';
require_once 'controllers/SettingsController.php';
require_once 'controllers/ChangesController.php';
require_once 'controllers/AnalitycsController.php';

final class RouterLite
{
    public static $routes = array();
    private static $params = array();
    public static $requestedUrl = '';

    public static function addRoute($route, $destination = null)
    {
        if ($destination !== null && !is_array($route)) {
            $route = array($route => $destination);
        }
        self::$routes = array_merge(self::$routes, $route);
    }

    public static function splitUrl($url)
    {
        return preg_split('/\//', $url, -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function getCurrentUrl()
    {
        return (self::$requestedUrl ?: '/');
    }


    public static function dispatch($requestedUrl = null)
    {

        if ($requestedUrl === null) {
            $exp = explode('?', $_SERVER["REQUEST_URI"]);
            $uri = reset($exp);
            $requestedUrl = urldecode(($uri == '/') ? $uri : rtrim($uri, '/'));
        }

        self::$requestedUrl = $requestedUrl;
        if (isset(self::$routes[$requestedUrl])) {
            self::$params = self::splitUrl(self::$routes[$requestedUrl]);
            return self::executeAction();
        }
        foreach (self::$routes as $route => $uri) {
            if (strpos($route, ':') !== false) {
                $route = str_replace(':any', '(.+)', str_replace(':num', '([0-9]+)', $route));
            }

            if (preg_match('#^' . $route . '$#', $requestedUrl)) {
                if (strpos($uri, '$') !== false && strpos($route, '(') !== false) {
                    $uri = preg_replace('#^' . $route . '$#', $uri, $requestedUrl);
                }
                self::$params = self::splitUrl($uri);

                break;
            }
        }
        return self::executeAction();
    }

    public static function executeAction()
    {
        $controller = isset(self::$params[0]) ? self::$params[0] : 'AuthController';
        $action = isset(self::$params[1]) ? self::$params[1] : 'index_page';
        $params = array_slice(self::$params, 2);
        $controller = new $controller();
        return call_user_func_array(array($controller, $action), $params);
    }

}