<?php

namespace Controllers;

use model\MyPDO;
use Twig\Environment;
use model\Manager\UserManager;

abstract class AbstractController
{
    protected $twig;
    protected $userManager;
    protected MyPDO $db;
    public function __construct(Environment $twig, UserManager $userManager, MyPDO $db)
    {
        $this->twig = $twig;
        $this->userManager = $userManager;
        $this->db = $db;
    }
}
