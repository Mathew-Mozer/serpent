<?php
require "../../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../../models/PromotionModel.php";
require('../../models/promotionmodels/PrizeEventModel.php');
$conn = new DbCon();
//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $promotion = new PromotionModel($conn->insert_database());

    if ($_POST['action'] == 'addMonsterCarlo') {
        $MonsterCarloModel = new MonsterCarloModel($conn->insert_database());
        $response = $MonsterCarloModel->addWinner($_POST);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    }
}


?>
