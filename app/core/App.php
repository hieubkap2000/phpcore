<?php
require_once(dirname(__FILE__) . '/Autoload.php');

use app\core\Router;

class App
{
    private $router;
    public static $config;

    public function __construct()
    {
        new Autoload;
        $this->router = new Router();

        $this->router->get('/home', 'HomeController@index');
        $this->router->get('/home/details/{name}', 'HomeController@details');

        $this->router->get('/', function () {
            echo "This is home page.";
        });

        $this->router->get('/product/{id}/{name}', function ($id, $name) {
            echo $id;
            echo "<br>";
            echo $name;
        });

        $this->router->any('*', function () {
            echo "This is notfound page.";
        });
    }

    public static function setConfig($config)
    {
        self::$config = $config;
    }

    public static function getConfig()
    {
        return self::$config;
    }

    public function run()
    {
        return $this->router->run();
    }
}
