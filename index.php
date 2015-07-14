<?php

/*
Sample:
*/
/*
require_once './vendor/autoload.php';
$basedir = __DIR__;
new \Andou\Autoloader\Autoloader($basedir . "/src");
$app = \Andou\SuperImageResizer\App::getInstance($basedir, '/config/config.ini');
$_newimg = $app->getImageResized('test.jpg', "1200");
$app->serve($_newimg);
*/
