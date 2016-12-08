<?php
session_start();
require "dependencies/php/header.php";
require "models/PromotionModel.php";
require "models/PermissionModel.php";


/**
 * This is the main page that finds them, bring them all and in the darkness
 * bind them.
 */

$promotion = new PromotionModel($dbcon->read_database());
?>
<body>
<div id="page">
</div>

<div id="settings" style="display: none;" title="Settings">

</div>

<div id="addPromotion" style="display: none;" title="Promotion">
    <form id="add-promotion-form" action="controllers/addpromotioncontroller.php" method="post">
        <div id="promotion-select">
            <input type="hidden" name="propertyId" value=""/>
            <hr>
            <div id ="promotion_type_select">
            </div>
        </div>
        <div id="promotion-details">
        </div>
        <div id="use-template">
        </div>
        <div id="template-form">
        </div>
        <div id="create-template">
        </div>
        <div id="add-promotion-buttons">
        </div>
        <script id="add-promotion-function"></script>
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
<div id="assign-display" style="display: none;" title="Assign Display">
    <p>Index: <span id="displayId"></span><p>
    <p id="displayName"></p>
    <p id="displaySerial"></p>
    <p id="displayMacAddress"></p>
    <select id="displayProperties"></select>
</div>

<div id=promotion-view-modal data-promo-id="" style="display: none";>

</div>

<div id="editDisplayModal" style="display: none;" title="Edit Display">
</div>


<div id="createProperty" style="display: none;" title="Create Property">

    <form id="propertyForm">

        <input type="text" id="propertyName" name="propertyName" placeholder="Property Name">
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

</body>
<script src="dependencies/js/login.js"></script>
<script>
    <?php

    if ($_SESSION['loggedIn'] != 'true') {
        echo "$('#page').hide();";
        echo "loginModal.dialog('open');";
    } else {
        echo "$('#page').load('views/mainview.php', {id :" . $_SESSION['userId'] . "});";
        echo "$('#page').show();";
    }

    ?>

</script>
