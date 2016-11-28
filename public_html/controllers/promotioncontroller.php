<?php
require "../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../models/PromotionModel.php";
$conn = new DbCon();
//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['action'] == 'add') {

      $promotion = new PromotionModel($conn->insert_database());

      $className = $promotion->getPromtionModelName($_POST['promotionTypeId']);
      require '../models/promotionmodels/'.$className.'.php';

      $addedPromotion= $promotion->addPromotion($_POST['promotionTypeId'], $_POST['propertyId'], $_POST['scene_id']);
      $_POST['promotionId'] = $addedPromotion['promo_id'];

      $r = new ReflectionClass($className);
      $classReference = $r->newInstanceArgs(array($conn->insert_database()));
      $classReference->add($_POST);

      $response = $addedPromotion;

      header('content-type:application/json');
      echo json_encode($response);
    } else if ($_POST['action'] == 'update'){
      $promotion = new PromotionModel($conn->insert_database());
      $className = $promotion->getPromtionModelName($_POST['promotionTypeId']);
      require '../models/promotionmodels/'.$className.'.php';

      $r = new ReflectionClass($className);
      $classReference = $r->newInstanceArgs(array($conn->insert_database()));
      $oldRecord = $classReference->get($_POST['promotionId']);
      $newRecord = array_merge($oldRecord, $_POST);

      $classReference->update($newRecord);

      header('content-type:application/json');
      echo json_encode($response);
    } else if($_POST['action'] == 'read'){
      $promotion = new PromotionModel($conn->insert_database());

      $className = $promotion->getPromtionModelName($_POST['promotionTypeId']);
      require '../models/promotionmodels/'.$className.'.php';

      $r = new ReflectionClass($className);
      $classReference = $r->newInstanceArgs(array($conn->insert_database()));
      $response = $classReference->get($_POST['promotionId']);

      header('content-type:application/json');
      echo json_encode($response);
    }
}


 ?>
