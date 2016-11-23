<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require_once("../dependencies/php/HelperFunctions.php");
  require_once(getServerPath()."dbcon.php");
  require "../models/PromotionModel.php";

  $dbcon = new DBCon();
$promotion = new PromotionModel($dbcon->read_database());

$promotionTypeList = $promotion->getPromotionTypes($_POST['propertyId']);

foreach ($promotionTypeList as $row) {
    echo '<div style="background-color: lightgray" data-promotion-name="'.$row['file_name'].'" data-promotion-id="'.$row['promo_id'].'"  id ="'.$row['promo_id'].'"class="addPromotion"> <image class="tile-icon" src="dependencies/images/'.$row['promo_image'].'"><label>'.$row['promo_title'].'<label> </div>';
    echo '<hr>';
}
}?>
<script>
$("div.addPromotion").on('click', function(e){

  e.preventDefault();
  $("#promotion-details").data("promotion-id", $(this).data('promotion-id'));
  promotionName = $(this).data('promotion-name');
  $("#promotion-select").hide();
  $("#promotion-details").show();

  $("#promotion-details").load("views/addpromotionviews/add"+promotionName+"view.php");

});
</script>
