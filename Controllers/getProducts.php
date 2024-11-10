<?php


require_once "../config.php";
require_once '../vendor/autoload.php';
use model\Manager\ArticleManager;
use model\MyPDO;

try {
    $db = MyPDO::getInstance(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT . ";charset=" . DB_CHARSET,
        DB_LOGIN,
        DB_PWD);
    $db->setAttribute(MyPDO::ATTR_ERRMODE, MyPDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}catch (Exception $e){
    die($e->getMessage());
}
$articleManager = new ArticleManager($db);

    $datas = $articleManager->getArticlesForJson();
    var_dump($datas);
    if (!is_string($datas)) {
        echo json_encode($datas);
    }

    $db = null;
    exit();


