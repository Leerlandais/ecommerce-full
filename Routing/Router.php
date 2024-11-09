<?php

namespace Routing;

use model\Manager\ArticleManager;
use model\Manager\CategoryManager;
use model\Manager\UserManager;
use model\MyPDO;
use Twig\Environment;

class Router
{
    private $routes = [];
    private $twig;
    private $userManager;
    private $articleManager;
    private $categoryManager;
    private MyPDO $db;

    public function __construct(Environment $twig, UserManager $userManager, ArticleManager $articleManager, CategoryManager $categoryManager, MyPDO $db)
    {
        $this->twig = $twig;
        $this->userManager = $userManager;
        $this->articleManager = $articleManager;
        $this->categoryManager = $categoryManager;
        $this->db = $db;
    }

    public function registerRoute(string $routeName, string $controllerClass, string $methodName): void
    {
        $this->routes[$routeName] = [
            'controller' => $controllerClass,
            'method' => $methodName
        ];
    }

    public function handleRequest($route): void
    {
        if (!isset($this->routes[$route])) {
            $route = '404';
        }

        $controllerClass = $this->routes[$route]['controller'];
        $method = $this->routes[$route]['method'];

        $controller = new $controllerClass($this->twig, $this->userManager, $this->articleManager, $this->categoryManager, $this->db);

        $controller->$method();
    }
}
