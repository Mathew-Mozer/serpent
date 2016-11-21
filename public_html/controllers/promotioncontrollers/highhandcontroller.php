<?php
require "../../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../../models/PromotionModel.php";
require('../../models/promotionmodels/HighHandModel.php');
$conn = new DbCon();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'add') {
        $promotion = new PromotionModel($conn->insert_database());
        $highHand = new HighHandModel($conn->insert_database());

        $addPromotion= $promotion->addPromotion($_POST['promotionId'], $_POST['casinoId']);
        $highHand->addHighHand($addPromotion,$_POST['titleMessage'], $_POST['useJoker'] == 'on',
            $_POST['highHandGold'] == 'on', $_POST['hornTimer'], $_POST['payoutValue'], $_POST['sessionTimer'],
            $_POST['multipleHands']);

        $response = array();
        $response['image'] = $promotion->getPromotionImageByPromotionType($_POST['promotionId']);
        $response['promotion-id'] = $addPromotion;
        $response['casino-id'] = $_POST['casinoId'];
        header('content-type:application/json');
        echo json_encode($response);
    }
}


