<?php

namespace Controllers;

use Twig\Environment;

class HomeController {
    private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function index() {
    global $sessionRole, $errorMessage;
        echo $this->twig->render("public/public.index.html.twig", [
            'sessionRole' => $sessionRole,
            'errorMessage' => $errorMessage
        ]);
    }
}
