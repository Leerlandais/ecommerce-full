<?php

namespace Controllers;

class LoginController extends AbstractController
{
    public function login()
    {
        global $sessionRole, $errorMessage;
        if (isset($_POST["userCreateName"], $_POST["userCreatePwd"])) {
            $name = $_POST["userCreateName"];
            $pwd = $_POST["userCreatePwd"];

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

    public function createUser()
    {
        global $sessionRole, $errorMessage;
        if (isset($_POST["userCreateName"],
                  $_POST["userCreateFullname"],
                  $_POST["userCreateEmail"],
                  $_POST["userCreateAddress"],
                  $_POST["userCreatePwd"],
        )) {
            $name = $_POST["userCreateName"];
            $fullname = $_POST["userCreateFullname"];
            $email = $_POST["userCreateEmail"];
            $address = $_POST["userCreateAddress"];
            $pwd = $_POST["userCreatePwd"];

            //verify that info is correct and adjust the next bit to handle it instead of login

            if ($this->userManager->checkForUser($name)) {
                $_SESSION["errorMessage"] = "Username already exists.";
                header("Location: ./");
                exit;
            } else {
                echo $this->twig->render("public/public.create.html.twig", [
                    'errorMessage' => $errorMessage,
                    'sessionRole' => $sessionRole
                ]);
            }
        } else {
            echo $this->twig->render("public/public.create.html.twig", [
                'errorMessage' => $errorMessage,
                'sessionRole' => $sessionRole
            ]);
        }
    }
}
