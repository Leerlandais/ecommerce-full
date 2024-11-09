<?php

namespace Routing;

use model\MyPDO;

class Router
{
    private $routes = [];
    private $twig;
    private $userManager;
    private MyPDO $db;

    public function __construct($twig, $userManager, $db)
    {
        $this->twig = $twig;
        $this->userManager = $userManager;
        $this->db = $db;
    }

    public function registerRoute($routeName, $controllerClass, $methodName)
    {
        $this->routes[$routeName] = [
            'controller' => $controllerClass,
            'method' => $methodName
        ];
    }

    public function handleRequest($route)
    {
        if (!isset($this->routes[$route])) {
            $route = '404';
        }

        $controllerClass = $this->routes[$route]['controller'];
        $method = $this->routes[$route]['method'];

        $controller = new $controllerClass($this->twig, $this->userManager, $this->db);

        $controller->$method();
    }
}
