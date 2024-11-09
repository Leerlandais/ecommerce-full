<?php

namespace Controllers;

use Controllers\AbstractController;

class ArticleController extends AbstractController
{
    public function addArticle() {
        global $errorMessage, $sessionRole;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
            exit();  // probably don't need to exit the code here but I like to just in case :)
        }

        echo $this->twig->render("private/private.article.add.html.twig", [
            "errorMessage" => $errorMessage,
            'sessionRole' => $sessionRole
        ]);
    }

    public function listArticle() {
        global $errorMessage, $sessionRole;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
            exit();
        }

        echo $this->twig->render("private/private.article.list.html.twig", [
            "errorMessage" => $errorMessage,
            'sessionRole' => $sessionRole
        ]);
    }
}