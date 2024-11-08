<?php

use model\Manager\UserManager;

$userManager = new UserManager($db);

// USER LOGIN VERIFICATION
if (isset($_POST["userLoginName"],
    $_POST["userLoginPwd"])) {
    $name = $_POST["userLoginName"];
    $pwd = $_POST["userLoginPwd"];

    if ($userManager->attemptUserLogin($name, $pwd)) {
        header("Location: ./");
        exit;
    } else {
        echo "Login failed. Please check your credentials.";
    }
}

$route = $_GET['route'] ?? 'home';
switch ($route) {
  case 'home':
    echo $twig->render("public/public.index.html.twig", ["session" => false]);
    break;
    case 'login' :
        echo $twig->render('public/public.login.html.twig');
        break;

  default:
    echo $twig->render("err404.html.twig");
}
            