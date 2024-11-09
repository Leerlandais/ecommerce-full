<?php

namespace Controllers;

use Twig\Environment;
use model\Manager\UserManager;

abstract class AbstractController
{
    protected $twig;
    protected $userManager;

    public function __construct(Environment $twig, UserManager $userManager)
    {
        $this->twig = $twig;
        $this->userManager = $userManager;
    }
}
