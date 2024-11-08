<?php

namespace controller;

use Twig\Environment;
class AbstractController
{
    protected $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

}