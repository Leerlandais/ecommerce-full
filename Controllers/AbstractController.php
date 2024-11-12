<?php

namespace Controllers;

use model\Manager\ArticleManager;
use model\Manager\CategoryManager;
use model\Manager\OrderManager;
use model\Manager\UserManager;
use model\MyPDO;
use Twig\Environment;

// As with Manager and Mapping, the Controllers have lots of shared needs, so Abstract to keep it DRY

abstract class AbstractController
{
    protected $twig;
    protected $userManager;
    protected $articleManager;
    protected $categoryManager;

    protected $orderManager;
    protected MyPDO $db;
    public function __construct(Environment $twig, UserManager $userManager, ArticleManager $articleManager, CategoryManager $categoryManager, OrderManager $orderManager ,MyPDO $db)
    {
        $this->twig = $twig;
        $this->userManager = $userManager;
        $this->articleManager = $articleManager;
        $this->categoryManager = $categoryManager;
        $this->orderManager = $orderManager;
        $this->db = $db;
    }
}
