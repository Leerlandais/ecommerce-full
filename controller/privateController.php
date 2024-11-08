<?php

use model\Manager\UserManager;

$userManager = new UserManager($db);

$route = $_GET['route'] ?? 'home';

// experimenting with a different way to make a switch
echo match ($route) {
    'home' => $twig->render("public/public.index.html.twig", ["session" => true]),

    default => $twig->render("err404.html.twig"),
};
