<!--/** Index* Author: Stephen King* Version 2016.10.5.1** This is the main page.
It constructs the 10 upcoming event list*/-->

<?php
    require "dependencies/php/header.php";
    require "modals/PromotionModal.php";
    require "modals/permissionModal.php";
    require "modals/OptionsModal.php";

    $optionsModal = new OptionsModal(1);
    $options = $optionsModal->getPromotionSettings();
    $promotion = new PromotionModal($dbcon->read_database());
    $permission = new PermissionModal($dbcon->update_database(), 1);

    $casinoList = $promotion->getPromotionCasinos();
    $casinoCount = count($casinoList);
    $casinoRowIndex = 0;
    foreach($casinoList as $casino){

//Begin Casino
  if($permission->canViewCasinoPromotions($casino['id'])){
  include 'views/casinoView.php';
  $casinoRowIndex++;

  if($casinoRowIndex < $casinoCount){ ?>
    <hr>
  <?php }

}} if($casinoRowIndex == 0){?>
  <div><h3>You have no access to any casinos.</h3></div>
  <?php } ?>
<!-- End Casino -->

<div id="settings" title="Settings">
    <?php
    foreach ($options as $setting => $value){
        echo $setting . " = " . $value . "<br>";
    }
    ?>
</div>
<div id="addPromotion" title="Promotion">
  <form id="add-promotion-form" action="controllers/addPromotion.php" method="post">
    <input type="hidden" name="casinoId" value="">
  <select name="promoId">
  <?php
  $promotionTypeList = $promotion->getPromotionTypes();

  foreach($promotionTypeList as $row){
    echo '<option value="'.$row['promo_id'].'">'.$row['promo_title'].'</option>';
  }
  ?>
  </select>
</form>
 </div>
<?php
include "dependencies/php/footer.php"; ?>
