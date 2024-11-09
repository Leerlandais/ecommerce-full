<?php

namespace Controllers;

use Twig\Environment;

class HomeController {
    private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function index() {
        $sessionRole = "";
        if(isset($_SESSION['user_roles'])) $sessionRole = $_SESSION['user_roles'];
        echo $this->twig->render("public/public.index.html.twig", [
            'sessionRole' => $sessionRole,

        ]);
    }
}
