<?php

namespace Controllers;

use model\Mapping\UserMapping;

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

    public function createUser()
    {
        global $sessionRole, $errorMessage;
        if (isset($_POST["userCreateName"],
                  $_POST["userCreateFullName"],
                  $_POST["userCreateEmail"],
                  $_POST["userCreateAddress"],
                  $_POST["userCreatePwd"],
        )) {
            $name = $_POST["userCreateName"];
            $fullname = $_POST["userCreateFullName"];
            $email = $_POST["userCreateEmail"];
            $address = $_POST["userCreateAddress"];
            $pwd = $_POST["userCreatePwd"];




            if ($this->userManager->checkForUser($name)) {
                $_SESSION["errorMessage"] = "Username already exists.";
                header("Location: ?route=createUser");
            }else {
                $uniq = uniqid("user_", true);
                $userMapData = [
                    'user_username' => $name,
                    'user_password' => password_hash($pwd, PASSWORD_DEFAULT),
                    'user_fullname' => $fullname,
                    'user_email' => $email,
                    'user_address' => $address,
                    'user_uniqid' => $uniq,
                    'user_roles' => json_encode(["ROLE_USER"])
                ];
                $userMapping = new UserMapping($userMapData);
                $createNewUser = $this->userManager->createNewUser($userMapping);
                $_SESSION["errorMessage"] = $createNewUser ? 'User Added!' : 'Error adding user!';
                header("Location: ?route=home");
            }
        } else {
            echo $this->twig->render("public/public.create.html.twig", [
                'errorMessage' => $errorMessage,
                'sessionRole' => $sessionRole
            ]);
        }
    }
}
