<?php

/**
* This adds a promotion when a user with permission
* uses the add promotion button.
*/

  require "../dependencies/php/HelperFunctions.php";
  require getServerPath()."dbcon.php";
  require "../modals/PromotionModal.php";
  $dbcon = NEW DbCon();

//Add the new promotion to the database
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $promotion = new PromotionModel($dbcon->insert_database());
      $addResponse = $promotion->addPromotion($_POST['promotionId'], $_POST['casinoId']);
      $response = $promotion->getPromotionImage($_POST['promotionId']);

      header('content-type:application/json');
      echo json_encode($response);
    }



 ?>