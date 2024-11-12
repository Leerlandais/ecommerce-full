<?php

namespace Routing;

use model\Manager\ArticleManager;
use model\Manager\CategoryManager;
use model\Manager\OrderManager;
use model\Manager\UserManager;
use model\MyPDO;
use Twig\Environment;

class Router
{
    private array $routes = [];
    private Environment $twig;
    private UserManager $userManager;
    private ArticleManager $articleManager;
    private CategoryManager $categoryManager;
    private OrderManager $orderManager;
    private MyPDO $db;

    public function __construct(Environment $twig, UserManager $userManager, ArticleManager $articleManager, CategoryManager $categoryManager, OrderManager $orderManager ,MyPDO $db)
    {
        $this->twig = $twig;
        $this->userManager = $userManager;
        $this->articleManager = $articleManager;
        $this->categoryManager = $categoryManager;
        $this->orderManager = $orderManager;
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

        $controller = new $controllerClass($this->twig, $this->userManager, $this->articleManager, $this->categoryManager, $this->orderManager ,$this->db);

        $controller->$method();
    }
}
