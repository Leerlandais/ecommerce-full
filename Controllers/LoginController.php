<?php

namespace Controllers;

class LoginController extends AbstractController
{
    public function login()
    {
        global $sessionRole, $errorMessage;
        if (isset($_POST["userLoginName"], $_POST["userLoginPwd"])) {
            $name = $_POST["userLoginName"];
            $pwd = $_POST["userLoginPwd"];

            if ($this->userManager->attemptUserLogin($name, $pwd)) {
                header("Location: ./");
                exit;
            } else {
                echo $this->twig->render("public/public.login.html.twig", [
                    'errorMessage' => $errorMessage,
                    'sessionRole' => $sessionRole
                ]);
            }
        } else {
            echo $this->twig->render("public/public.login.html.twig", [
                'errorMessage' => $errorMessage,
                'sessionRole' => $sessionRole
            ]);
        }
    }
}
