<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
require "includes/connect.php";
require "api/api.php";
require 'api/Exceptions/HandlerExceptions.php';
require 'api/Services/BusinessLogic.php';

$app->run();