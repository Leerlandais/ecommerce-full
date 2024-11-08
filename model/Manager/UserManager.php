<?php

namespace model\Manager;

use model\Abstract\AbstractManager;
use model\Mapping\UserMapping;

class UserManager extends AbstractManager
{
    /*
     * Needs functions for :-
     *      - Connect User
     *      - Disconnect User
     *      - Create User
     *      - Update User
     */

    public function attemptUserLogin(string $name, string $pwd): bool {

        $name = htmlspecialchars(strip_tags(trim($name)));

        $sql = 'SELECT * FROM `ecom_users` WHERE `user_username` = :name';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return false;
        }

        $row = $stmt->fetch();
        $user = new UserMapping($row);

        if (!password_verify($pwd, $user->getUserPassword())) {
            return false;
        }


        $_SESSION["id"] = session_id();
        $_SESSION["siteName"] = "ecommerce";

        return true;
    }

} // end class