<?php

namespace app\controllers;

use app\core\Controller;
use \App;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        
    }

    public function details($name)
    {
        echo $name;
    }
}
