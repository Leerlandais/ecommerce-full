<?php

namespace model\Manager;

use model\Abstract\AbstractManager;
use model\Mapping\UserMapping;

class UserManager extends AbstractManager
{

    public function attemptUserLogin(string $name, string $pwd): bool {
        $name = htmlspecialchars(strip_tags(trim($name)));
        $sql = 'SELECT * FROM `ecom_users` WHERE `user_username` = :name';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            echo "No user found with that username.";
            return false;
        }

        $row = $stmt->fetch();

        $user = new UserMapping($row);
        $trimmedPwd = trim($user->getUserPassword());
        // after an hour of headscratching cos I couldn't log on, I discovered some trailing whitespace in my DB :D
        if (!password_verify($pwd, $trimmedPwd)) {
            echo "Password verification failed.";
            return false;
        }
        $_SESSION = $row;
        $_SESSION["id"] = session_id();
        $_SESSION["siteName"] = "ecommerce";
        unset($_SESSION["user_password"]);
        unset($_SESSION["user_uniqid"]);
        return true;
    }

    public function logoutUser() {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    public function verifyUserLevel(string $level, string $userLevel) : bool {
        if(!in_array($level, json_decode($userLevel))) return false;

        return true;
    }

    public function checkForUser($user) : bool {
        $stmt = $this->db->prepare("SELECT * FROM `ecom_users` WHERE `user_username` = :user");
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        if ($stmt->rowCount() === 0) return false;
        return true;
    }

    function createNewUser($datas) : bool {
        $name = $datas->getUserUsername();
        $password = $datas->getUserPassword();
        $fullname = $datas->getUserFullname();
        $email = $datas->getUserEmail();
        $address = $datas->getUserAddress();
        $uniqId = $datas->getUserUniqid();
        $roles = $datas->getUserRoles();

        $stmt = $this->db->prepare("INSERT INTO `ecom_users`
                                                    (`user_username`,
                                                     `user_password`,
                                                     `user_fullname`,
                                                     `user_email`,
                                                     `user_address`,
                                                     `user_uniqid`,
                                                     `user_roles`) 
                                            VALUES (:name,:pass,:full,:mail,:addr,:uniq,:role)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':pass', $password);
        $stmt->bindParam(':full', $fullname);
        $stmt->bindParam(':mail', $email);
        $stmt->bindParam(':addr', $address);
        $stmt->bindParam(':uniq', $uniqId);
        $stmt->bindParam(':role', $roles);
        $stmt->execute();
        if ($stmt->rowCount() === 0) return false;
        return true;
    }
} // end class