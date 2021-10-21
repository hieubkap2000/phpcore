<?php
require_once(dirname(__FILE__) . '/../app/core/App.php');
$config = require_once(dirname(__FILE__) . '/../config/main.php');

App::setConfig($config);

$app = new App();
$app->run();
