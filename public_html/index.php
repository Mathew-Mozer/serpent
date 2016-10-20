<?php
session_start();
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
foreach ($casinoList as $casino) {

//Begin Casino
    if ($permission->canSeeAPromotionsInACasino($casino['id'])) {
        include 'views/casinoView.php';
        $casinoRowIndex++;

        if ($casinoRowIndex < $casinoCount) { ?>
            <hr>
        <?php }

    }
}
if ($casinoRowIndex == 0){ ?>
<div><h3>You have no access to any casinos.</h3></div>
<?php}

$optionsModal = new OptionsModal(1);
$options = $optionsModal->getPromotionSettings();
$_SESSION['loggedIn'] = 'false';

?>
<div id="page">
    <!--Toolbar-->
    <div class="toolbench">
        <div class="toolbar">
            <div id="createCasinoBtn" class="button-body tool-button" data-toggle="tooltip" title="Create New Property">
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
        if (count($promotionList) > 0) {
            foreach ($promotionList as $row) {
                ?>
                <div class="tile-body">
                    <img class="tile-icon" src="dependencies/images/<?php echo $row['promo_image'] ?>">
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
            <?php }
        } ?>
        <!--End Promotion Tile-->
    </div>
    <!-- End Casino -->

    <div id="settings" title="Settings">
        <?php
        foreach ($options as $setting => $value) {
            echo $setting . " = " . $value . "<br>";
        }
        ?>
    </div>
    <div id="addPromotion" title="Promotion">
        <form id="add-promotion-form" action="controllers/addPromotion.php" method="post">
            <select name="promoId">
                <?php
                $promotionTypeList = $promotion->getPromotionTypes();

                foreach ($promotionTypeList as $row) {
                    echo '<option value="' . $row['promo_id'] . '">' . $row['promo_title'] . '</option>';
                }
                ?>
            </select>
        </form>
    </div>
    <div id="loginModal" title="Log In">
        <ul id="errorMessage" hidden></ul>
        <form>
            <input type="text" name="userName" id="userName" placeholder="User Name">
            <br/>
            <br/>
            <input type="password" name="password" id="password" placeholder="Password">
            <br/>
            <br/>
        </form>
    </div>
    <div id="createCasino" title="Create Casino">
        <form id="casinoForm">
            <input type="text" id="casinoName" name="casinoName" placeholder="Casino Name">
            <br/>
            <br/>
            <input type="number" id="parentCompany" name="parentCompany" placeholder="Parent Company">
            <br/>
            <br/>
            <input type="text" id="assetBundleUrl" name="assetBundleUrl" placeholder="Asset Bundle URL">
            <br/>
            <br/>
            <input type="text" id="assetBundleWindows" name="assetBundleWindows" placeholder="Asset Bundle Windows">
            <br/>
            <br/>
            <input type="text" id="assetName" name="assetName" placeholder="Asset Name">
            <br/>
            <br/>
            <input type="number" id="defaultSkin" name="defaultSkin" placeholder="Default Skin">
            <br/>
            <br/>
            <input type="text" id="defaultLogo" name="defaultLogo" placeholder="Default Logo">
            <br/>
            <br/>
            <input type="text" id="supportGroup" name="supportGroup" placeholder="Support Group">
            <br/>
            <br/>
            <fieldset>
                <legend>Business Operating Hours</legend>
                <input type="time" id="businessHoursOpen" name="businessHoursOpen"> to
                <input type="time" id="businessHoursClose" name="businessHoursClose">
            </fieldset>
            <br/>
            <br/>
        </form>
    </div>
</div>
<?php
include "dependencies/php/footer.php";
?>
