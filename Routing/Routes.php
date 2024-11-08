<?php

use Routing\Router;
use controller\HomeController;
use controller\UserController;
use controller\ErrorController;

$router = new Router();

$router->registerRoute('home', HomeController::class, 'index');
$router->registerRoute('logout', UserController::class, 'logout');
$router->registerRoute('super', UserController::class, 'super');
$router->registerRoute('admin', UserController::class, 'admin');
$router->registerRoute('404', ErrorController::class, 'error404');

$route = $_GET['route'] ?? 'home';
$router->handleRequest($route);
