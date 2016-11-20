<?php
require "../../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../../models/PromotionModel.php";
require('../../models/promotionmodels/KickForCashModel.php');
$conn = new DbCon();
//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if ($_POST['action'] == 'add') {
      $promotion = new PromotionModel($conn->insert_database());
      $kick_for_cash = new KickForCashModel($conn->insert_database());

      $addPromotion= $promotion->addPromotion($_POST['promotionId'], $_POST['propertyId']);
      $kick_for_cash->addKickForCash($addPromotion,$_POST['cashPrize'],$_POST['targetNumber']);

      $response = array();
      $response['image'] = $promotion->getPromotionImageByPromotionType($_POST['promotionId']);
      $reponse['promotion-id'] = $addPromotion;
      $response['property-id'] = $_POST['propertyId'];

      header('content-type:application/json');
      echo json_encode($response);
    } else if ($_POST['action'] == 'update'){
      $kick_for_cash = new KickForCashModel($conn->update_database());
      $response = $kick_for_cash->UpdateKickForCash($_POST['promotionId'],$_POST['name'],$_POST['chosenNumber'],$_POST['gameLabel'],$_POST['team1'],$_POST['team2'],$_POST['vs']);

      header('content-type:application/json');
      echo json_encode($response);
    } else if($_POST['action'] == 'read'){
      $kick_for_cash = new KickForCashModel($conn->read_database());
      $response = $kick_for_cash->getKickForCash($_POST['promotionId']);

      header('content-type:application/json');

      echo json_encode($response);
    }
}


 ?>
