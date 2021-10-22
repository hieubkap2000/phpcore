<?php

namespace app\core;

use \App;

class Controller
{
    public function __construct()
    {
    }

    public function redirect($url, $isEnd = true, $resPonseCode = 302)
    {
        header('Location:' . $url, true, $resPonseCode);
        if ($isEnd) {
            die();
        }
    }

    public function render($view, $data = null)
    {
        $controller = App::getController();
        $folderView = strtolower(str_replace('Controller', '', $controller));
        $rootDir = App::getConfig()['rootDir'];
        $viewPath = $rootDir . '/app/views/' . $folderView . '/' . $view . '.php';
        if (file_exists($viewPath)) {
            require $viewPath;
        }
    }

    public function renderPartial()
    {
    }
}
