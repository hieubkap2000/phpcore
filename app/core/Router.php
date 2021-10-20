<?php
class Router
{
    private $routes = [];
    private function getRequestUrl()
    {
        $url =  isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $url = str_replace('/phpcore/public/', '', $url);
        $url = $url === '' || empty($url) ? '/' : $url;
        return $url;
    }

    private function getRequestMethod()
    {
        return isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
    }

    private function addRouter($url, $action)
    {
        $this->routes = [$url, $action];
    }

    public function get($url, $action)
    {
        $this->addRouter($url, $action);
    }

    public function post($url, $action)
    {
        $this->addRouter($url, $action);
    }

    public function any($url, $action)
    {
        $this->addRouter($url, $action);
    }

    public function run()
    {
        $url = $this->getRequestUrl();
        $method = $this->getRequestMethod();
        echo "<pre>";
        var_dump($this->routes);
    }
}
