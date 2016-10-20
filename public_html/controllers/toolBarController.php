<?php
/**
 * User: Christopher Barbour
 * Date: 10/16/16
 * Time: 8:47 PM
 */
require_once ('../models/ToolBarModel.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $toolBarModel = new ToolBarModel($_POST['casinoName'], $_POST['parentCompany'], $_POST['assetBundleUrl'],
        $_POST['assetBundleWindows'], $_POST['assetName'], $_POST['defaultSkin'], $_POST['defaultLogo'],
        $_POST['supportGroup'], $_POST['businessOpen'], $_POST['businessClose']);

    if($toolBarModel->insertCasino()){
        echo json_encode(array("error" => "none"));
    } else {
        echo json_encode(array("error" => "Error writing to db"));
    }
}else {
    echo json_encode(array("error" => "Not authenticated"));
}


?>