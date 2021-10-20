<?php
class Router
{
    private $routesrs = [];
    private function getRequestUrl()
    {
        $url =  isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $url = str_replace('/phpcore/public', '', $url);
        $url = $url === '' || empty($url) ? '/' : $url;
        return $url;
    }

    private function getRequestMethod()
    {
        return isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
    }

    private function addRouter($method, $url, $action)
    {
        $this->routesrs[] = [$method, $url, $action];
    }

    public function get($url, $action)
    {
        $this->addRouter('GET', $url, $action);
    }

    public function post($url, $action)
    {
        $this->addRouter('POST', $url, $action);
    }

    public function any($url, $action)
    {
        $this->addRouter('GET|POST', $url, $action);
    }

    public function map()
    {
        $requestUrl = $this->getRequestUrl();
        $requestMethod = $this->getRequestMethod();

        $routesrs = $this->routesrs;
        foreach ($routesrs as $router) {
            // echo "<pre>";
            // print_r($router);
            list($method, $url, $action) = $router;
            echo $url . "<br>";
            if (strpos($method, $requestMethod) !== false) {
                if (strcmp(strtolower($url), strtolower($requestUrl)) === 0) {
                    if (is_callable($action)) {
                        call_user_func($action);
                        return;
                    }
                } else {
                    continue;
                }
            } else {
                continue;
            }
        }
        return;
    }

    public function run()
    {
        $this->map();
    }
}
