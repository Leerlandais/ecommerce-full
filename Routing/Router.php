<?php

namespace Routing;

class Router
{
    private $routes = [];
    private $twig;
    private $userManager;

    public function __construct($twig, $userManager)
    {
        $this->twig = $twig;
        $this->userManager = $userManager;
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
            $route = '404'; // Default to 404 if route not found
        }

        $controllerClass = $this->routes[$route]['controller'];
        $method = $this->routes[$route]['method'];

        // Instantiate controller with dependencies based on controller type
        $controller = new $controllerClass($this->twig, $this->userManager);

        // Call the specified method on the controller
        $controller->$method();
    }
}
