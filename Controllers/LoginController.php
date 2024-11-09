<?php

namespace Controllers;

use model\Manager\UserManager;

class LoginController
{
    private $twig;
    private $userManager;

    public function __construct($twig, UserManager $userManager)
    {
        $this->twig = $twig;
        $this->userManager = $userManager;
    }

    public function login()
    {
        if (isset($_POST["userLoginName"], $_POST["userLoginPwd"])) {
            $name = $_POST["userLoginName"];
            $pwd = $_POST["userLoginPwd"];

            if ($this->userManager->attemptUserLogin($name, $pwd)) {
                header("Location: ./");
                exit;
            } else {
                $errorMessage = "Login failed. Please check your credentials.";
                echo $this->twig->render("public/public.login.html.twig", [
                    'errorMessage' => $errorMessage
                ]);
            }
        } else {
            echo $this->twig->render("public/public.login.html.twig");
        }
    }
}
