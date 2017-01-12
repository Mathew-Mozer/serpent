<?php
/**
 * This is the add promotion form
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("../dependencies/php/HelperFunctions.php");
    require_once(getServerPath()."dbcon.php");
    require "../models/PromotionModel.php";
    $dbcon = new DBCon();
    $promotion = new PromotionModel($dbcon->read_database());
    if(isset($_POST['propertyId'])){
$promotionTypeList = $promotion->getPromotionTypes($_POST['propertyId']);

foreach ($promotionTypeList as $row) {
    echo '<div data-promotion-name="'.$row['file_name'].'" data-promotion-id="'.$row['promo_id'].'"  id ="'.$row['promo_id'].'"class="addPromotion select-tile"> <image class="tile-icon tile-icon-select-promo" src="dependencies/images/'.$row['promo_image'].'"><label>'.$row['promo_title'].'<label> </div>';
    echo '<hr>';
}
}
}?>

<script src="dependencies/js/addpromotionmodal.js?t=<?php echo microtime()?>"></script>
<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime()?>"></script>
