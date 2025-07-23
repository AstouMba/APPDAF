<?php

require_once '../vendor/autoload.php';
require_once '../app/config/env.php';
use App\Core\Router;

$routes=require_once '../routes/route.web.php';


Router::resolve($routes);