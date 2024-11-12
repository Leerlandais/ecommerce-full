<?php

namespace Controllers;
class OrderController extends \Controllers\AbstractController
{


    public function profile() {
        global $sessionRole, $errorMessage;
        $user = [
            'userName' => $_SESSION['user_fullname'],
            "userAddr" => $_SESSION['user_address'],
        ];
        $user_id = $_SESSION['user_id'];
        $orderHistory = $this->orderManager->getOrderByUserId($user_id);

        echo $this->twig->render("public/public.profile.html.twig", [
            'sessionRole' => $sessionRole,
            'errorMessage' => $errorMessage,
            'orderHistory' => $orderHistory,
            "user" => $user,
        ]);
    }
}