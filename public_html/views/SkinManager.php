<?php
if(!isset($_SESSION)) {
    session_start();
}
require "../models/PromotionModel.php";
require "../models/SkinModel.php";
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
$promotion = new PromotionModel($dbcon->read_database());
$skin = new SkinModel($dbcon->read_database());
$scenes = $skin->getScenes();
?>

<div id="skin-manager">
    <div class="option-group">
        <label>Promotion:</label>
        <select id="skinmanager-select-property">
            <option>Select Scene</option>
            <?php


            foreach ($scenes as $scene){
                echo "<option value='" . $scene['scenes_id'] . "'>" . $scene['scenes_name'] . "</option>";
            }
            ?>
            <?php

            ?>
        </select>
        <label>Skins:</label>
        <select id="skinmanager-select-skin">
            <option>Select Skin</option>
            <?php
            $skins = $skin->getSkins();
            foreach ($skins as $currentskin){
                echo "<option value='" . $currentskin['skin_id'] . "'>" . $currentskin['skin_name'] . "</option>";
            }
            ?>
            <?php

            ?>
        </select>

    </div>
    <div id="skin-tags">

    </div>
    <div id="skin-data">

    </div>
</div>
