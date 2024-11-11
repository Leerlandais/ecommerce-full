<?php

namespace Controllers;
class CheckoutController extends AbstractController
{

    public function checkout() {
        echo $this->twig->render("public/public.checkout.html.twig");
    }
}