<?php

namespace Controllers;

class HomeController extends AbstractController{

    public function index() {
    global $sessionRole, $errorMessage;

    $products = $this->articleManager->getArticles();
    $categories = $this->categoryManager->getCategories();
        echo $this->twig->render("public/public.index.html.twig", [
            'sessionRole' => $sessionRole,
            'errorMessage' => $errorMessage,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function profile() {
        global $sessionRole, $errorMessage;
        $user = [
            'userName' => $_SESSION['user_fullname'],
            "userAddr" => $_SESSION['user_address'],
        ];
          // $userInfo = $this->userManager->getUserInfo();
        echo $this->twig->render("public/public.profile.html.twig", [
            'sessionRole' => $sessionRole,
            'errorMessage' => $errorMessage,
            'orderHistory' => [1,2,3],
            "user" => $user,
        ]);
    }
}
