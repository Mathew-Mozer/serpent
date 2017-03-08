<?php
require "../../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../../models/PromotionModel.php";
require('../../models/promotionmodels/PrizeEventModel.php');
$conn = new DbCon();
//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $promotion = new PromotionModel($conn->insert_database());

    if ($_POST['action'] == 'addPrizeEventWinner') {
        $PrizeEventModel = new PrizeEventModel($conn->insert_database());
        $response = $PrizeEventModel->addWinner($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    } else if ($_POST['action'] == 'DeletePrizeEventWinner') {
        $PrizeEventModel = new PrizeEventModel($conn->insert_database());
        $response = $PrizeEventModel->deleteWinner($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    }



}


?>
