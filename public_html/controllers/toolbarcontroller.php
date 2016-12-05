<?php
/**
 * This file will manage toolbar functionality
 */
require_once('../models/ToolBarModel.php');

//Construct toolbar model
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $toolBarModel = new ToolBarModel($_POST['propertyName'], $_POST['parentCompany'], $_POST['assetBundleUrl'],
        $_POST['assetBundleWindows'], $_POST['assetName'], $_POST['defaultSkin'], $_POST['defaultLogo'],
        $_POST['supportGroup'], $_POST['businessOpen'], $_POST['businessClose']);

    //Creates new property
    if ($toolBarModel->insertProperty()) {
        echo json_encode(array("error" => "none"));
    } else {
        echo json_encode(array("error" => "Error writing to db"));
    }
} else {
    echo json_encode(array("error" => "Not authenticated"));
}

?>
