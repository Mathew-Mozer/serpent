<!--/** Index* Author: Stephen King* Version 2016.10.5.1** This is the main page.
It constructs the 10 upcoming event list*/-->

<?php
require "dependencies/php/header.php";
require "modals/PromotionModal.php";
include('/home/casino/public_html/modals/OptionsModal.php');

$optionsModal = new OptionsModal(1);
$options = $optionsModal->getPromotionSettings();
?>

<!--Toolbar-->
<div class="toolbench">
    <div class="toolbar">
        <div class="button-body tool-button" data-toggle="tooltip" title="Create New Property">
            <span class="glyphicon glyphicon-home tool-glyphicon white" aria-hidden="true"></span>
        </div>
        <div class="button-body tool-button" data-toggle="tooltip" title="Add New User">
            <span class="glyphicon glyphicon-user tool-glyphicon white" aria-hidden="true"></span>
        </div>
        <div class="button-body tool-button" data-toggle="tooltip" title="Options">
            <span class="glyphicon glyphicon-cog tool-glyphicon white" aria-hidden="true"></span>
        </div>
        <div class="button-body tool-button" data-toggle="tooltip" title="Request Help">
            <span class="glyphicon glyphicon-comment tool-glyphicon white" aria-hidden="true"></span>
        </div>
    </div>
</div>

<!-- Begin Casino -->
<div id="promotion-list">
    <h2 class="casino-title">Casino - Great American Lakewood</h2>
    <!--New Promotion Title-->
    <div id="add-promotion-btn" class="tile-body tile-insert">
        <img class="tile-icon" src="dependencies/images/clear.png">
        <div class="glyphicon-new-container">
            <span class="glyphicon glyphicon-plus-sign glyphicon-new-tile white" aria-hidden="true"></span>
        </div>
    </div>
    <!--End New Promotion Tile-->
    <!--Promotion Title-->
    <?php
    $promotion = new PromotionModal($dbcon->read_database());
    $promotionList = $promotion->getAllPromotions();
    if(count($promotionList)>0){
        foreach($promotionList as $row){?>
            <div class="tile-body">
                <img class="tile-icon" src="dependencies/images/<?php echo $row['promo_image']?>">
                <div class="tile-menu-bar hidden">
                    <div class="tile-menu-item settingsBtn">
                        <span class="glyphicon glyphicon-cog glyphicon-menu black" aria-hidden="true"></span>
                    </div>
                    <div class="tile-menu-item">
                        <span class="glyphicon glyphicon-pause glyphicon-menu black" aria-hidden="true"></span>
                    </div>
                    <div class="tile-menu-item">
                        <span class="glyphicon glyphicon-user glyphicon-menu black" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
        <?php } }?>
    <!--End Promotion Tile-->
</div>
<!-- End Casino -->
<?php
include "views/promotionModalView.php";
include "dependencies/php/footer.php"; ?>

<div id="settings" title="Settings">
    <?php
    foreach ($options as $setting => $value){
        echo $setting . " = " . $value . "<br>";
    }
    ?>
</div>
<div id="addPromotion" title="Promotion">
    <form id="add-promotion-form" action="controllers/addPromotion.php" method="post">
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
include "views/promotionModalView.php";
include "dependencies/php/footer.php"; ?>
