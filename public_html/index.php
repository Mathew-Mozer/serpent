<?php
session_start();
$_SESSION['loggedIn'] = false;
require "dependencies/php/header.php";
require "modals/PromotionModal.php";
include('modals/OptionsModal.php');

$optionsModal = new OptionsModal(1);
$options = $optionsModal->getPromotionSettings();
?>
<div id="page">
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
            <input type="text" name="userName" id="userName" placeholder="User Name"
                   onkeypress="return on_enter_key(event)">
            <br/>
            <br/>
            <input type="password" name="password" id="password" placeholder="Password">
            <br/>
            <br/>
        </form>
    </div>
    <div id="createCasino" title="Create Casino">
        (id, name, asset bundle url, asset bundle url windows, asset name, default skin, default logo, support group, business open time, parent company id)
        <form>
            <input type="text" name="casinoName" placeholder="Casino Name">
            <br/>
            <br/>
            <input type="text" name="assetBundleUrl" placeholder="Asset Bundle URL">
            <br/>
            <br/>
            <input type="text" name="assetBundleWindows" placeholder="Asset Bundle Windows">
            <br/>
            <br/>
            <input type="text" name="assetName" placeholder="Asset Name">
            <br/>
            <br/>
            <input type="number" name="defaultSkin" placeholder="Default Skin">
            <br/>
            <br/>
            <input type="text" name="defaultLogo" placeholder="Default Logo">
            <br/>
            <br/>
            <input type="text" name="supportGroup" placeholder="Support Group">
            <br/>
            <br/>
            <fieldset>
                <legend>Business Operating Hours</legend>
                <input type="time" name="businessHoursOpen"> to
                <input type="time" name="businessHoursClose">
            </fieldset>
            <br/>
            <br/>
            <input type="text" name="parentCompany" placeholder="Parent Company">
            <br/>
            <br/>
        </form>
    </div>
</div>
<?php
include "dependencies/php/footer.php"; ?>
