<!doctype html>
<?php
if(!isset($_SESSION)) {
    session_start();
}
require "dependencies/php/header.php";
require_once "models/PromotionModel.php";
require "models/PermissionModel.php";
date_default_timezone_set('America/Los_Angeles');

/**
 * This is the main page that finds them, bring them all and in the darkness
 * bind them.
 */
$promotion = new PromotionModel($dbcon->read_database());
?>
<body>
<div class="loader hidden">
    <div class="donut">
        <div class='thinking-donut' style='transform:scale(0.50);'></div>
    </div>
</div>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
   <div id="sidenavPage">

   </div>
</div>
<div id="page">
</div>

<div id="dialog" title="Promotion Status">

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
        <div id="select-skin-container">
        </div>
        <div id="select-scene-style">
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
        <img src="http://www.typhonpacific.com/logo.png" style="display: block; margin: auto;" />
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
    <input type="text" id="unassigneddisplayname">
    <select id="displayProperties"></select>
</div>

<div id=promotion-view-modal data-promo-id="" style="display: none; width: 1080px";>

</div>

<div id="editDisplayModal" style="display: none;" title="Edit Display">
</div>

<div id="editUsersModal" style="display: none;" title="Edit Users">
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

<div class="donut loader hidden">
    <div class='thinking-donut' style='transform:scale(0.50);'></div>
</div>
<div id="promo-display-settings-dialog" title="Promotion Display Settings">


</div>
</body>
<script src="dependencies/js/login.js"></script>
<script>

    <?php

    if (!isset($_SESSION['loggedIn'])||$_SESSION['loggedIn'] != 'true') {

        echo "$('#page').hide();";
        echo "loginModal.dialog('open');";
    } else {
        echo '$(".loader").removeClass("hidden");';
        echo "$('#page').load('views/mainview.php', {id :" . $_SESSION['userId'] . "});";
        echo "$('#page').show();";
    }
//
    ?>

</script>
<!--  Testing! -->
<style>
    body {
        font-family: "Lato", sans-serif;
    }

    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 45;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;

    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }
#page{
    transition: margin-left .5s;
}
    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }
</style>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "325px";
        document.getElementById("page").style.marginLeft = "325px";
    }

    function closeNav() {
        document.getElementById("sidenavPage").innerHTML = ""
        document.getElementById("mySidenav").style.width = "0";

        document.getElementById("page").style.marginLeft = "0px";
        $( ".selector" ).sortable( "destroy" );
        $( ".dragToPromos" ).draggable( "destroy" );
        $('.moveTile').toggle(false);
    }
</script>
