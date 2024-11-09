<?php

namespace Controllers;

class ErrorController extends AbstractController{


    public function error404() {
        global $sessionRole, $errorMessage;
        echo $this->twig->render("err404.html.twig", [
            'sessionRole' => $sessionRole,
            'errorMessage' => $errorMessage
        ]);
    }
}
