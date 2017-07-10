<?php
require "../../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../../models/PromotionModel.php";
require('../../models/promotionmodels/PointsGTModel.php');
$conn = new DbCon();
//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if ($_POST['action'] == 'add') {
        $sceneType = 4;
      $promotion = new PromotionModel($conn->insert_database());
      $kick_for_cash = new KickForCashModel($conn->insert_database());

      $addPromotion= $promotion->addPromotion($_POST['promotionId'], $_POST['casinoId'], $sceneType);
      $response = array();
      $response['image'] = $promotion->getPromotionImageByPromotionType($_POST['promotionId']);
      $reponse['promotion-id'] = $addPromotion;
      $response['casino-id'] = $_POST['casinoId'];

      header('content-type:application/json');
      echo json_encode($response);
    } else if ($_POST['action'] == 'update'){
      $kick_for_cash = new KickForCashModel($conn->update_database());
      $response = $kick_for_cash->UpdateKickForCash($_POST['promotionId'],$_POST['name'],$_POST['chosenNumber'],$_POST['gameLabel'],$_POST['team1'],$_POST['team2'],$_POST['vs']);

      header('content-type:application/json');
      echo json_encode($response);
    } else if($_POST['action'] == 'read'){
      //$kick_for_cash = new KickForCashModel($conn->read_database());
      //$response = $kick_for_cash->getKickForCash($_POST['promotionId']);

      header('content-type:application/json');

        $dumb;
      echo json_encode($dumb);
    }
}


 ?>
