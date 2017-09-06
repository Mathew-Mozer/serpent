<?php
require "../../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../../models/PromotionModel.php";
require('../../models/promotionmodels/MultiplierMadnessModel.php');
$conn = new DbCon();
//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $promotion = new PromotionModel($conn->insert_database());

    if ($_POST['action'] == 'startMM') {
        $MultiplierMadnessModel = new MultiplierMadnessModel($conn->insert_database());
        $response = $MultiplierMadnessModel->startMM($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    }
}


?>
