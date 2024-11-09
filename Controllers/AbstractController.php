<?php

namespace Controllers;

use model\Manager\ArticleManager;
use model\Manager\CategoryManager;
use model\Manager\UserManager;
use model\MyPDO;
use Twig\Environment;

abstract class AbstractController
{
    protected $twig;
    protected $userManager;
    protected $articleManager;
    protected $categoryManager;
    protected MyPDO $db;
    public function __construct(Environment $twig, UserManager $userManager, ArticleManager $articleManager, CategoryManager $categoryManager, MyPDO $db)
    {
        $this->twig = $twig;
        $this->userManager = $userManager;
        $this->articleManager = $articleManager;
        $this->categoryManager = $categoryManager;
        $this->db = $db;
    }
}
