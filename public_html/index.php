<?php

session_start();
require "dependencies/php/header.php";



?>
<body>
    <div id="page">
    </div>

<div id="settings" style="display: none;" title="Settings">

</div>
<div id="addPromotion" style="display: none;" title="Promotion">
  <form id="add-promotion-form" action="controllers/addpromotioncontroller.php" method="post">
    <div id="promotion-select">
      <input type="hidden" name="casinoId" value=""></input>
            <hr>
            <div id ="promotion_type_select">

            </div>
      </div>
        <div id="promotion-details">
        </div>
        <script id="add-promotion-function"></script>
    </form>

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

    <?php
    include "views/displayView.php"

    ?>

   <footer>

   </footer>

  </body>
  <script src = "dependencies/js/login.js"></script>
  <script src = "dependencies/js/optionsmodal.js"></script>

  <script>
          <?php

            if($_SESSION['loggedIn'] != 'true') {

                    echo "$('#page').hide();";

                    echo "loginModal.dialog('open');";

            } else {

                echo  "$('#page').load('views/mainView.php', {id :".$_SESSION['userId']."});";

                echo "$('#page').show();";


            }

        ?>

  </script>
