<?php

namespace Controllers;

use model\Manager\UserManager;
use Twig\Environment;

class HomeController extends AbstractController{

    public function index() {
    global $sessionRole, $errorMessage;
        echo $this->twig->render("public/public.index.html.twig", [
            'sessionRole' => $sessionRole,
            'errorMessage' => $errorMessage
        ]);
    }
}
