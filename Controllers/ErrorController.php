<?php

namespace Controllers;

use Twig\Environment;

class ErrorController {
    private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function error404() {
        global $sessionRole, $errorMessage;
        echo $this->twig->render("err404.html.twig", [
            'sessionRole' => $sessionRole,
            'errorMessage' => $errorMessage
        ]);
    }
}
