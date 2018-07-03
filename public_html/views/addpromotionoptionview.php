
<?php
/**
 * This is the add promotion form
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("../dependencies/php/HelperFunctions.php");
    require_once(getServerPath() . "dbcon.php");
    require "../models/PromotionModel.php";
    $dbcon = new DBCon();
    $promotion = new PromotionModel($dbcon->read_database());
    if (isset($_POST['propertyId'])) {
        $promotionTypeList = $promotion->getPromotionTypes($_POST['propertyId']);
     ?>
        <div class="newpromo-title">
            Select Promotion Type From The List</div>
       <?php foreach ($promotionTypeList as $row) {
            ?>
            <div data-promotion-name="<?php echo $row['file_name'] ?>"
                 data-promotion-id="<?php echo $row['promo_id'] ?>" id="<?php echo $row['promo_id'] ?>"
                 class="addPromotion select-tile">
                <image class="tile-icon tile-icon-select-promo"
                       src="dependencies/images/<?php echo $row['promo_image'] ?>">
                    <label><?php echo $row['promo_title'] ?><label>
            </div>
        <?php }
    }
} ?>

<script src="dependencies/js/addpromotionmodal.js?t=<?php echo microtime() ?>"></script>
<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime() ?>"></script>
