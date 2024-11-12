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

        echo $this->twig->render("public/public.profile.html.twig", [
            'sessionRole' => $sessionRole,
            'errorMessage' => $errorMessage,
        ]);
    }
}
