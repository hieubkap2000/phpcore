<?php
class Autoload
{
    private $rootDir;

    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir;
        spl_autoload_register([$this, 'autoload']);
        $this->autoloadFile();
    }

    private function autoload($class)
    {
        $tmp = explode('\\', $class);
        $className = end($tmp);
        $pathName = str_replace($className, '', $class);
        $filePath = $this->rootDir . '\\' . $pathName . $className . '.php';
        if (file_exists($filePath)) {
            require_once($filePath);
        }
    }

    private function autoloadFile()
    {
        foreach ($this->defaultFileLoad() as $file) {
            require_once($this->rootDir . '/' . $file);
        }
    }

    private function defaultFileLoad()
    {
        return [
            'app/core/Router.php',
            'app/routers.php'
        ];
    }
}
