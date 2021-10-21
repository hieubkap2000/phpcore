<?php

namespace app\controllers;

class HomeController
{
    public function __construct()
    {
    }

    public function index()
    {
        echo "This is Home Controller and method index !";
    }

    public function details($name)
    {
        echo $name;
    }
}
