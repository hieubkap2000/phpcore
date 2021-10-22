<?php
class Router
{
    private static $routesrs = [];

    private $basePath;

    function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    private function getRequestUrl()
    {
        $url =  isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $url = str_replace($this->basePath, '', $url);
        $url = $url === '' || empty($url) ? '/' : $url;
        return $url;
    }

    private function getRequestMethod()
    {
        return isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
    }

    private static function addRouter($method, $url, $action)
    {
        self::$routesrs[] = [$method, $url, $action];
    }

    public static function get($url, $action)
    {
        self::addRouter('GET', $url, $action);
    }

    public static function post($url, $action)
    {
        self::addRouter('POST', $url, $action);
    }

    public static function any($url, $action)
    {
        self::addRouter('GET|POST', $url, $action);
    }

    public function map()
    {
        $checkRoute = false;
        $params = [];
        $requestUrl = $this->getRequestUrl();
        $requestMethod = $this->getRequestMethod();

        $routesrs = self::$routesrs;
        foreach ($routesrs as $router) {
            list($method, $url, $action) = $router;

            if (strpos($method, $requestMethod) === false) {
                continue;
            }

            if ($url === '*') {
                $checkRoute = true;
            } elseif (strpos($url, '{') === false) {

                if (strcmp(strtolower($url), strtolower($requestUrl)) === 0) {
                    $checkRoute = true;
                } else {
                    continue;
                }
            } elseif (strpos($url, '}') === false) {
                continue;
            } else {
                $routeParam = explode('/', $url);
                $requestParam =  explode('/', $requestUrl);

                if (count($routeParam) !== count($requestParam)) {
                    continue;
                }

                foreach ($routeParam as $k => $rp) {
                    if (preg_match('/^{\w+}/', $rp)) {
                        $params[] = $requestParam[$k];
                    }
                }
                $checkRoute = true;
            }


            if ($checkRoute === true) {
                if (is_callable($action)) {
                    call_user_func_array($action, $params);
                } elseif (is_string($action)) {
                    $this->compieRoute($action, $params);
                }
                return;
            } else {
                continue;
            }
        }
        return;
    }

    private function compieRoute($action, $params)
    {
        if (count(explode('@', $action)) !== 2) {
            die('Router Error');
        }

        $className = explode('@', $action)[0];
        $methodName = explode('@', $action)[1];

        $classNameSpace = 'app\\controllers\\' . $className;
        if (class_exists($classNameSpace)) {
            $object = new $classNameSpace;
            App::setController($className);
            if (method_exists($classNameSpace, $methodName)) {
                App::setAction($methodName);
                call_user_func_array([$object, $methodName], $params);
            } else {
                echo 'Method ' . $methodName . ' does not exists !';
            }
        } else {
            echo 'Class <b>' . $classNameSpace . '</b> does not exists !';
        }
    }

    public function run()
    {
        $this->map();
    }
}
