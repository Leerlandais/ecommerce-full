<?php

use model\Manager\UserManager;

$userManager = new UserManager($db);

$sessionRole = $_SESSION["user_roles"]; // To control display of things using Twig
$route = $_GET['route'] ?? 'home';
switch ($route) {
    case 'home':
        echo $twig->render("public/public.index.html.twig", ['sessionRole' => $sessionRole, 'errorMessage' => $errorMessage]);
        break;
    case 'logout':
        $userManager->logoutUser();
        header("Location: ./");
        break;
    case 'super':
        if (!$userManager->verifyUserLevel("ROLE_SUPER", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
        }
        echo $twig->render("private/private.index.html.twig", ['sessionRole' => $sessionRole, 'errorMessage' => $errorMessage]);
        break;
    case 'admin':
        if (!$userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
        }
        echo $twig->render("private/private.index.html.twig", ['sessionRole' => $sessionRole, 'errorMessage' => $errorMessage]);
        break;
    case 'article':
        if (!$userManager->verifyUserLevel("ROLE_ADMIN", $sessionRole)) {
            $_SESSION["errorMessage"] = "You are not authorised to access that page.";
            header("Location: ./");
        }
        // complete this later...

    default:
        echo $twig->render("err404.html.twig", ['sessionRole' => $sessionRole, 'errorMessage' => $errorMessage]);
}

/*
// experimenting with a different way to make a switch
echo match ($route) {
    'home' => $twig->render("public/public.index.html.twig", ["session" => true]),

    default => $twig->render("err404.html.twig"),
};
*/