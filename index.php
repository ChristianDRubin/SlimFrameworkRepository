<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();


$app = new \Slim\Slim();

$app->config(array(
    'templates.path' => 'views',
));
require "includes/connect.php";
require "includes/errorCodes.php";
require "api/api.php";

$app->run();
