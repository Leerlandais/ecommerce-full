<?php
namespace Routing;

use controller\ErrorController;
class Router {
    private array $routes = [];

    public function registerRoute($route, $controller, $method): void
    {
        $this->routes[$route] = ['controller' => $controller, 'method' => $method];
    }

    public function handleRequest($route) {
        if (isset($this->routes[$route])) {
            $controllerClass = $this->routes[$route]['controller'];
            $method = $this->routes[$route]['method'];

            $controller = new $controllerClass();
            return $controller->$method();
        } else {
            $errorController = new ErrorController();
            return $errorController->error404();
        }
    }
}
