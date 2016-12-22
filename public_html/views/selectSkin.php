<?php
/**
 * Created by PhpStorm.
 * User: zhydi
 * Date: 12/22/2016
 * Time: 1:22 AM
 */
require "../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../models/PropertyDisplays.php";
$dbcon = new DBCon();
$displayProperties = new PropertyDisplays($dbcon->read_Database(), $_POST['propertyId']);
$skins = $displayProperties->getSkinTypes($_POST['propertyId']);
?>
Select a skin to use for this promotion:
<div id="select-skin">
    <select class="skin-id" id="skin-chooser" name="skin-choosen">
        <option value="0">Default Display Skin</option>
        <?php foreach ($skins as $skin) {
            echo '<option value="' . $skin['skin_id'] . '">' . $skin['skin_name'] . '</option>';
            }
        ?>
    </select>
</div>
