<?php

require_once(dirname(__FILE__) . '/Router.php');

class App
{
    private $router;
    public function __construct()
    {
        $this->router = new Router();
        $this->router->get('/', function () {
            echo "This is home page.";
        });
        $this->router->get('/product/{id}/{name}', function ($id, $name) {
            echo $id;
            echo "<br>";
            echo $name;
        });
        $this->router->get('/home', function () {
            echo "This is home page.";
        });
        $this->router->any('*', function () {
            echo "This is notfound page.";
        });
    }
    public function run()
    {
        return $this->router->run();
    }
}
