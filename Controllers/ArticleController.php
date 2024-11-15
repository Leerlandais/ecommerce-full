<?php

namespace Controllers;


use model\Mapping\ArticleMapping;

class ArticleController extends AbstractController
{

    public function listArticle() {
        global $errorMessage, $sessionRole;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
            exit();
        }
        $articles = $this->articleManager->getArticles();
        echo $this->twig->render("private/private.article.list.html.twig", [
            "errorMessage" => $errorMessage,
            'sessionRole' => $sessionRole,
            "articles" => $articles
        ]);
    }

    public function addArticle() {
        global $errorMessage, $sessionRole;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
            exit();  // probably don't need to exit the code here but I like to just in case :)
        }
        $categories = $this->categoryManager->getCategories();
        echo $this->twig->render("private/private.article.add.html.twig", [
            "errorMessage" => $errorMessage,
            'sessionRole' => $sessionRole,
            "categories" => $categories
        ]);
    }

    public function createArticle() {
        global $errorMessage, $sessionRole;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
            exit();
        }
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

            $articleMapping = new ArticleMapping($articleMapData);

            $addArticle = $this->articleManager->addNewArticle($articleMapping);
            if ($addArticle) {
                $catId = $_POST["addCatType"];
                $articleId = $this->articleManager->getLastArticleId();

                $addArticleCat = $this->articleManager->addArticleCategory($articleId, $catId);
            }

            $_SESSION["errorMessage"] = $addArticle && $addArticleCat  ? 'Article added!' : 'Error adding article.';
            header("Location: ?route=listArticle");
            exit();
        }
    }

    public function updateArticle(): void
    {
        global $sessionRole, $errorMessage;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
        }

        $artId = $_GET["artId"];

        $oneArticle = $this->articleManager->getOneArticleById($artId);
        $categories = $this->categoryManager->getCategories();

        echo $this->twig->render("private/private.article.edit.html.twig", [
            "errorMessage" => $errorMessage,
            'sessionRole' => $sessionRole,
            "oneArticle" => $oneArticle,
            "categories" => $categories
        ]);
    }

    public function editArticle()
    {
        global $sessionRole, $errorMessage;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
            exit();
        }

        if (isset(
            $_POST["productId"],
            $_POST["productName"],
            $_POST["productDesc"],
            $_POST["productPrice"],
            $_POST["productImage"],
            $_POST["productAmount"],
            $_POST["addCatType"]
        )){
            $articleMapData = [
                'prod_id' => $_POST["productId"],
                'prod_name' => $_POST["productName"],
                'prod_desc' => $_POST["productDesc"],
                'prod_price' => $_POST["productPrice"],
                'prod_img' => $_POST["productImage"],
                'prod_amount' => $_POST["productAmount"]
            ];

            $articleMapping = new ArticleMapping($articleMapData);

            $editArticle = $this->articleManager->editArticle($articleMapping);
            $_SESSION["errorMessage"] = $editArticle ? 'Article updated!' : 'Error updating article.';
            header("Location: ?route=listArticle");
            exit();
        }
    }

} // end class