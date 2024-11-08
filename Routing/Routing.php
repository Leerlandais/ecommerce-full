<?php

namespace Routing;

class Routing {
    private $routes = [];

    public function registerRoute($route, $controller, $method) {
        $this->routes[$route] = ['controller' => $controller, 'method' => $method];
    }

    public function handleRequest($route) {
        if (isset($this->routes[$route])) {
            $controllerClass = $this->routes[$route]['controller'];
            $method = $this->routes[$route]['method'];

            $controller = new $controllerClass(); // Instantiate the controller
            return $controller->$method(); // Call the controller method
        } else {
            // Route not found, render 404 page
            $errorController = new \App\Controller\ErrorController();
            return $errorController->error404();
        }
    }
}
