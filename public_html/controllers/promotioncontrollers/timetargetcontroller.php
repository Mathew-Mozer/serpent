<?php
require "../../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../../models/PromotionModel.php";
require('../../models/promotionmodels/TimeTargetModel.php');
$conn = new DbCon();
//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $promotion = new PromotionModel($conn->insert_database());

    if ($_POST['action'] == 'addTimeTarget') {
        $TimeTargetModel = new TimeTargetModel($conn->insert_database());
        $response = $TimeTargetModel->addSession($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    } else if ($_POST['action'] == 'confirmTimeTarget') {
        $TimeTargetModel = new TimeTargetModel($conn->insert_database());
        $response = $TimeTargetModel->confirmTimeTarget($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    } else if ($_POST['action'] == 'endTimeTarget') {
        $TimeTargetModel = new TimeTargetModel($conn->insert_database());
        $response = $TimeTargetModel->endTimeTarget($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    } else if ($_POST['action'] == 'archiveTimeTarget') {
        $TimeTargetModel = new TimeTargetModel($conn->insert_database());
        $response = $TimeTargetModel->archiveTimeTarget($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    }
}


?>
