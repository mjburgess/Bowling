<?php


require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';

use bowling\http\HttpApplication;
use bowling\http\HttpRequest;
use bowling\services\Session;

header('Access-Control-Allow-Origin: http://localhost:8080');

//die(print_r($_POST));
$app = new HttpApplication();
$app->registerService(Session::fromHttpContext());

echo $app->run(HttpRequest::fromHttpContext());