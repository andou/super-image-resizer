<?php

require_once './vendor/autoload.php';
$basedir = __DIR__;
new \Andou\Autoloader\Autoloader($basedir . "/src");
echo \Andou\SuperImageResizer\App::getInstance($basedir, '/config/config.ini')->getImageResized('test.jpg', "1000");

