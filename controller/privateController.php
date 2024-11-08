<?php

use model\Manager\UserManager;

$userManager = new UserManager($db);

$sessionRole = $_SESSION["user_roles"];

$route = $_GET['route'] ?? 'home';
switch ($route) {
    case 'home':
        echo $twig->render("public/public.index.html.twig", ['sessionRole' => $sessionRole]);
        break;
    case 'logout':
        $userManager->logoutUser();
        header("Location: ./");
        break;
    case 'super':

        break;
    default:
        echo $twig->render("err404.html.twig", ['sessionRole' => $sessionRole]);
}

/*
// experimenting with a different way to make a switch
echo match ($route) {
    'home' => $twig->render("public/public.index.html.twig", ["session" => true]),

    default => $twig->render("err404.html.twig"),
};
*/