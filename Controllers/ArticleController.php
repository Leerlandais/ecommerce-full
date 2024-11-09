<?php

namespace Controllers;

use model\Manager\ArticleManager;
use model\Manager\CategoryManager;
use model\Mapping\ArticleMapping;



class ArticleController extends AbstractController
{


    public function addArticle() {
        global $errorMessage, $sessionRole;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
            exit();  // probably don't need to exit the code here but I like to just in case :)
        }
        $categoryManager = new CategoryManager($this->db);
        $categories = $categoryManager->getCategories();
        echo $this->twig->render("private/private.article.add.html.twig", [
            "errorMessage" => $errorMessage,
            'sessionRole' => $sessionRole,
            "categories" => $categories
        ]);
    }

    public function listArticle() {
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

    public function createArticle() {
        if (isset($_POST["productName"],
            $_POST["productDesc"],
            $_POST["productPrice"],
            $_POST["productImage"],
            $_POST["productAmount"],
            $_POST["addCatType"]
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
            if ($addArticle) {
                $catId = $_POST["addCatType"];
                $articleId = $articleManager->getLastArticleId();

                $addArticleCat = $articleManager->addArticleCategory($articleId, $catId);
            }

            $_SESSION["errorMessage"] = $addArticle && $addArticleCat  ? 'Article added!' : 'Error adding article.';
            header("Location: ?route=admin");
            exit();
        }
    }



}