<?php
require "../../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../../models/PromotionModel.php";
require('../../models/promotionmodels/ListDisplayModel.php');
$conn = new DbCon();
//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $promotion = new PromotionModel($conn->insert_database());

    if ($_POST['action'] == 'getDisplayList') {
        $ListDisplayModel = new ListDisplayModel($conn->insert_database());
        $response = $ListDisplayModel->getList($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    }
    if ($_POST['action'] == 'deleteListItem') {
        $ListDisplayModel = new ListDisplayModel($conn->insert_database());
        $response = $ListDisplayModel->deleteListItem($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    }if ($_POST['action'] == 'addListItem') {
        $ListDisplayModel = new ListDisplayModel($conn->insert_database());
        $response = $ListDisplayModel->addListItem($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    }

}


?>
