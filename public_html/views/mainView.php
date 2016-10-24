<?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require "../modals/PromotionModal.php";
  require "../modals/permissionModal.php";
  require_once("../dependencies/php/HelperFunctions.php");

  require_once(getServerPath()."dbcon.php");

  $dbcon = NEW DbCon();

  $promotion = new PromotionModal($dbcon->read_database());

  $permission = new PermissionModal($dbcon->update_database(), $_POST['id']);

  require 'toolbar.php';

  $casinoList = $promotion->getPromotionCasinos();

  $casinoCount = count($casinoList);

  $casinoRowIndex = 0;

  foreach($casinoList as $casino){
//Begin Casino

if($permission->canViewCasinoPromotions($casino['id'])) {

  include ('casinoView.php');
  $casinoRowIndex++;

  if($casinoRowIndex < $casinoCount){ ?>
    <hr>
    <?php }
  }
}

if ($casinoRowIndex == 0){ ?>
  <div>
    <h3>You have no access to any casinos.</h3>
  </div>
<?php }
 include '../dependencies/php/footer.php';
 }
?>
