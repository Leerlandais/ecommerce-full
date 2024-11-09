<?php

namespace Controllers;


use model\Manager\CategoryManager;
use model\Mapping\CategoryMapping;



class CategoryController extends AbstractController
{


    public function addCategory() {
        global $errorMessage, $sessionRole;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
            exit();
        }
        $categoryManager = new CategoryManager($this->db);
        $categories = $categoryManager->getCategories();
        echo $this->twig->render("private/private.category.add.html.twig", [
            "errorMessage" => $errorMessage,
            'sessionRole' => $sessionRole,
            "categories" => $categories
        ]);
    }

    public function listCategory() {
        global $errorMessage, $sessionRole;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
            exit();
        }

        echo $this->twig->render("private/private.article.list.html.twig", [
            "errorMessage" => $errorMessage,
            'sessionRole' => $sessionRole
        ]);
    }

    public function createCategory() {
        if (isset($_POST["productName"],
            $_POST["productDesc"],
            $_POST["productPrice"],
            $_POST["productImage"],
            $_POST["productAmount"]
        )){
            $articleMapData = [
                'prod_name' => $_POST["productName"],
                'prod_desc' => $_POST["productDesc"],
                'prod_price' => $_POST["productPrice"],
                'prod_img' => $_POST["productImage"],
                'prod_amount' => $_POST["productAmount"]
            ];

            // Use $this->db instead of $db
            $articleManager = new ArticleManager($this->db);
            $articleMapping = new ArticleMapping($articleMapData);

            $addArticle = $articleManager->addNewArticle($articleMapping);
            $_SESSION["errorMessage"] = $addArticle ? 'Article added!' : 'Error adding article.';
            header("Location: ?route=admin");
            exit();
        }
    }



}