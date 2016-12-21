<?php
require "../../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../../models/PromotionModel.php";
require('../../models/promotionmodels/HighHandModel.php');
$conn = new DbCon();
$promotion = new PromotionModel($conn->insert_database());
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'add') {

        $highHand = new HighHandModel($conn->insert_database());
        $addPromotion = 0;
        if($_POST['isTemplate'] != 'true') {
            $addPromotion = $promotion->addPromotion($_POST['promotionId'], $_POST['casinoId'], $_POST['sceneType']);
        }
        $highHand->addHighHand($addPromotion, $_POST['titleMessage'], $_POST['useJoker'],
            $_POST['highHandGold'], $_POST['hornTimer'], $_POST['payoutValue'], $_POST['sessionTimer'],
            $_POST['multipleHands'], $_POST['isTemplate']);

        $response = array();
        $response['image'] = $promotion->getPromotionImageByPromotionType($_POST['promotionId']);
        $response['promotion-id'] = $addPromotion;
        $response['casino-id'] = $_POST['casinoId'];
        header('content-type:application/json');
        echo json_encode($response);

    } else if ($_POST['action'] == 'read') {
        $highHand = new HighHandModel($conn->read_database());
        $response = $highHand->getHighHand($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);

    } else if ($_POST['action'] == 'template'){
        $highHand = new HighHandModel($conn->read_database());
        $response = $highHand->getTemplate();
        header('content-type:application/json');
        echo json_encode($response);

    }else if($_POST['action'] == 'update'){
        $highHand = new HighHandModel($conn->insert_database());
        $highHand->updateHighHand($_POST['promotionId'], $_POST['name'], $_POST['card1'], $_POST['card2'],
            $_POST['card3'], $_POST['card4'], $_POST['card5'], $_POST['card6'], $_POST['card7'],
            $_POST['card8']);
        echo("yo");
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($highHand);

    } else if ($_POST['action'] == 'view'){
        $highHand = new HighHandModel($conn->read_database());
        $response = $highHand->getAllHands($_POST['highHandSession']);
        header('content-type:application/json');
        echo json_encode($response);
    } else if ($_POST['action'] == 'updateHand'){
        $highHand = new HighHandModel($conn->update_database());
        $highHand->updateCardSet($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);

    }
}


