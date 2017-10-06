<?php
require "../../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../../models/PromotionModel.php";
require('../../models/promotionmodels/PicViewerModel.php');
$conn = new DbCon();
//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $promotion = new PromotionModel($conn->insert_database());

    if ($_POST['action'] == 'changeDuration') {
        $PicViewerModel = new PicViewerModel($conn->insert_database());
        $response = $PicViewerModel->changeDuration($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    }
    elseif ($_POST['action'] == 'deletePicture') {
        $PicViewerModel = new PicViewerModel($conn->insert_database());
        $response = $PicViewerModel->deletePictureFromDatabase($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);

    }
}


?>
