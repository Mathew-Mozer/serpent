<?php
require "../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../models/CasinoBoxes.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'update') {
      $dbcon = new DBCon();
      $displayCasinos = new CasinoBoxes($dbcon->update_Database(), $_POST['casinoId']);
      $displayCasinos->UpdateDisplayWithId($_POST['displayId'],$_POST['displayName'], $_POST['displayLocation']);
      $displayCasinos->updatePromotionsInDisplay($_POST['displayId'], $_POST['promotions']);
      header('content-type:application/json');
      echo json_encode(array("success"=>"updated diplay"));
    }
  }

    ?>
