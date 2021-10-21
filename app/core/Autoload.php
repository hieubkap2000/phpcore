<?php
class Autoload
{
    public function __construct()
    {
        spl_autoload_register([$this, 'autoload']);
    }

    private function autoload($class)
    {
        $rootPath = \App::getConfig()['rootPath'];

        $tmp = explode('\\', $class);
        $className = end($tmp);
        $pathName = str_replace($className, '', $class);
        $filePath = $rootPath . '\\' . $pathName . $className . '.php';
        if (file_exists($filePath)) {
            require_once($filePath);
        }
    }
}
