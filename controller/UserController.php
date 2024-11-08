<?php

namespace controller;

use controller\AbstractController,
    model\Manager\UserManager;

class UserController extends AbstractController
{
    private $userManager;
    public function logout() {
        $this->userManager->logoutUser();
        header("Location: ./");
        exit;
    }

    public function super() {
        global $sessionRole, $errorMessage;
        if (!$this->userManager->verifyUserLevel("ROLE_SUPER", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
            exit;
        }
        echo $this->twig->render("private/private.index.html.twig", [
            'sessionRole' => $sessionRole,
            'errorMessage' => $errorMessage
        ]);
    }

    public function admin() {
        global $sessionRole, $errorMessage;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
            exit;
        }
        echo $this->twig->render("private/private.index.html.twig", [
            'sessionRole' => $sessionRole,
            'errorMessage' => $errorMessage
        ]);
    }
}