<?php



if(isset($_SESSION["id"], $_SESSION["siteName"]) && $_SESSION["id"] === session_id() && $_SESSION["siteName"] === "ecommerce"){
    require_once PROJECT_DIRECTORY."/controller/privateController.php";
}else {
    require_once PROJECT_DIRECTORY."/controller/publicController.php";
}