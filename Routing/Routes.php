<?php


use Controllers\ArticleController;
use Controllers\CategoryController;
use Controllers\CheckoutController;
use Controllers\ErrorController;
use Controllers\HomeController;
use Controllers\LoginController;
use Controllers\UserController;
use model\Manager\ArticleManager;
use model\Manager\CategoryManager;
use model\Manager\OrderManager;
use model\Manager\UserManager;
use Routing\Router;

$userManager = new UserManager($db);
$articleManager = new ArticleManager($db);
$categoryManager = new CategoryManager($db);
$orderManager = new OrderManager($db);

$router = new Router($twig, $userManager, $articleManager, $categoryManager, $orderManager,$db);

// Register routes
// found a way to handle passing stuff to my Controller Class - kind of reminds me of node :)
// first the home page
$router->registerRoute('home', HomeController::class, 'index');
// the user connection pages
$router->registerRoute('login', LoginController::class, 'login');
$router->registerRoute('logout', UserController::class, 'logout');
$router->registerRoute("createUser", LoginController::class, "createUser");
// the user profile and history pages
$router->registerRoute("userProfile", HomeController::class, "profile");
// the admin verification passage
$router->registerRoute('super', UserController::class, 'super');
$router->registerRoute('admin', UserController::class, 'admin');
// the article pages
$router->registerRoute("addArticle", ArticleController::class, 'addArticle');
$router->registerRoute("listArticle", ArticleController::class, 'listArticle');
$router->registerRoute("createArt", ArticleController::class, 'createArticle');
$router->registerRoute("updateArt", ArticleController::class, 'updateArticle');
$router->registerRoute('editArt', ArticleController::class, 'editArticle');
// the category pages
$router->registerRoute("addCategory", CategoryController::class, 'addCategory');
$router->registerRoute("listCategory", CategoryController::class, 'listCategory');
$router->registerRoute('createCat', CategoryController::class, 'createCategory');
$router->registerRoute("updateCat", CategoryController::class, 'updateCategory');
$router->registerRoute('editCat', CategoryController::class, 'editCategory');
// the checkout page
$router->registerRoute("checkout", CheckoutController::class, 'checkout');
// the inevitable error page :-)
$router->registerRoute('404', ErrorController::class, 'error404');

// Handle request
$route = $_GET['route'] ?? 'home'; // use the usual method to set the default page
$router->handleRequest($route);