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
        $categoryManager = new CategoryManager($this->db);
        $categories = $categoryManager->getCategories();

        echo $this->twig->render("private/private.category.list.html.twig", [
            "errorMessage" => $errorMessage,
            'sessionRole' => $sessionRole,
            "categories" => $categories
        ]);
    }

    public function createCategory() {
        global $sessionRole;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
            exit();
        }
        if (isset($_POST["categoryName"],
            $_POST["categoryDesc"]
        )){
            $categoryMapData = [
                'cats_name' => $_POST["categoryName"],
                'cats_desc' => $_POST["categoryDesc"]
            ];

            $categoryManager = new CategoryManager($this->db);
            $categoryMapping = new CategoryMapping($categoryMapData);

            $addArticle = $categoryManager->addNewCategory($categoryMapping);
            $_SESSION["errorMessage"] = $addArticle ? 'Category added!' : 'Error adding category.';
            header("Location: ?route=admin");
            exit();
        }
    }

    public function updateCategory() {
        global $sessionRole, $errorMessage;
        if (!$this->userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
        }
        $categoryManager = new CategoryManager($this->db);
        $catId = $_GET["catId"];

        $oneCategory = $categoryManager->getOneCategoryById($catId);

        echo $this->twig->render("private/private.category.edit.html.twig", [
            "errorMessage" => $errorMessage,
            'sessionRole' => $sessionRole,
            "oneCategory" => $oneCategory
        ]);
    }



}