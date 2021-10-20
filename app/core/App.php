<?php

require_once(dirname(__FILE__) . '/Router.php');

class App
{
    private $router;
    public function __construct()
    {
        $this->router = new Router();
        $this->router->get('/',function(){
            echo "This is home page.";
        });
        $this->router->get('/product',function(){
            echo "This is product page.";
        });
        $this->router->get('/home',function(){
            echo "This is home page.";
        });
    }
    public function run()
    {
        return $this->router->run();
    }
}
