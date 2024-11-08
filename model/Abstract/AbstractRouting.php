<?php

namespace model\Abstract;

use Twig\Environment;
abstract class AbstractRouting
{
    protected Environment $twig; // children are going to need Twig so I used protected

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }


}