<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require __DIR__ . '/../vendor/autoload.php';

use Dell5480\BackEnd\Core\Router;
use Dell5480\BackEnd\Controllers\AuthController;

$router = new Router();

// ENDPOINTS
$router->add("POST", "login", [new AuthController(), "login"]);
$router->add("POST", "register", [new AuthController(), "register"]);

// EJECUTAR RUTAS
$router->run();
