<?php
session_start();
require "dependencies/php/header.php";
require "models/PromotionModel.php";
require "models/PermissionModel.php";
$promotion = new PromotionModal($dbcon->read_database());
?>
<body>
<div id="page">
</div>
<!-- End Casino -->

<!-- Modal Divs -->
<div id="settings" style="display: none;" title="Settings">

</div>

<div id="addPromotion" style="display: none;" title="Promotion">
    <form id="add-promotion-form" action="controllers/addpromotioncontroller.php" method="post">
        <input type="hidden" name="casinoId" value=""></input>
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

<div id="loginModal" style="display: none;" title="Log In">
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

<div id="createCasino" style="display: none;" title="Create Casino">
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
<!-- End Modal Divs -->

<footer>

</footer>

</body>
<script src="dependencies/js/login.js"></script>
<script src="dependencies/js/optionsmodal.js"></script>
<script src="dependencies/js/addpromotionmodal.js"></script>
<script src="dependencies/js/createcasino.js"></script>
<script>
    <?php

    if ($_SESSION['loggedIn'] != 'true') {

        echo "$('#page').hide();";

        echo "loginModal.dialog('open');";

    } else {

        echo "$('#page').load('views/mainview.php', {id : " . $_SESSION['userId'] . "});";

        echo "$('#page').show();";


    }
    ?>
</script>
