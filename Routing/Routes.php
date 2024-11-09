<?php


use Controllers\ArticleController;
use Controllers\ErrorController;
use Controllers\HomeController;
use Controllers\LoginController;
use Controllers\UserController;
use model\Manager\UserManager;
use Routing\Router;

$userManager = new UserManager($db);

$router = new Router($twig, $userManager);

// Register routes
$router->registerRoute('home', HomeController::class, 'index');
$router->registerRoute('login', LoginController::class, 'login');
$router->registerRoute('logout', UserController::class, 'logout');
$router->registerRoute('super', UserController::class, 'super');
$router->registerRoute('admin', UserController::class, 'admin');
$router->registerRoute("addArticle", ArticleController::class, 'addArticle');
$router->registerRoute("listArticle", ArticleController::class, 'listArticle');
$router->registerRoute("createArt", ArticleController::class, 'createArticle');
$router->registerRoute('404', ErrorController::class, 'error404');

// Handle request
$route = $_GET['route'] ?? 'home';
$router->handleRequest($route);