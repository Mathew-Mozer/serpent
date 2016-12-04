<?php
require "../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../models/PromotionModel.php";
require "../models/PropertyDisplays.php";
$dbcon = new DBCon();
?>

<ul id="errorMessage" hidden></ul>
<?php
$displayOptions = new PromotionModel($dbcon->read_Database());
$displayProperties = new PropertyDisplays($dbcon->read_Database(), $_POST['propertyId']);
$display = $displayProperties->getDisplayWithId($_POST['displayId']);
$skins = $displayProperties->getSkinTypes($_POST['propertyId']);
$assignedPromotions = $displayOptions->getPromotionsByDisplayId($_POST['displayId']);
$unassignedPromotions = $displayOptions->getUnassignedPromotions($_POST['displayId'], $_POST['propertyId']);
?>

<form>
    <div id="display-id-form" hidden data-display-id="<?php echo $_POST['displayId']; ?>"></div>
    <div id="property-id-form" hidden data-property-id="<?php echo $_POST['propertyId']; ?>"></div>

    <?php

    /**
     * Loops through and displays assigned promotions
     */

        foreach ($assignedPromotions as $row) {
    ?>

        <div class="form-group">
            <?php
                echo '<img class=checkbox-image src="dependencies/images/' . $row['promotion_type_image'] . '"> &nbsp';
                echo "<label class='display-modal-checkbox'>" . $assignedPromotions["promotion_type_title"] . '</label>';
                echo "<button type='button'  class='remove-from-display' id='{$row['promo_id']}' name='promotion'> Remove </button>";
            ?>
            <label class="display-modal-label"><?php echo $row['promotion_type_scene_verbage']; ?> </label>

            <input class="scene-duration" type="number"
                   id="<?php echo 'scene-duration-' . $row['promo_id']; ?>"
                   name="<?php echo $row['promo_id']; ?>"
                   value="<?php echo $row['scene_duration'] ?>">

            <label class="display-modal-label">Skin Id </label>

            <select class="skin-id" id="skin-id-<?php echo $row['promo_id']; ?>" name="<?php echo $row['promo_id']; ?>">

                <?php foreach ($skins as $skin) {

                    if ($row['skin_id'] == $skin['skin_id']) {
                        echo '<option value="' . $skin['skin_id'] . '" selected>' . $skin['skin_name'] . '</option>';

                    } else {

                        echo '<option value="' . $skin['skin_id'] . '">' . $skin['skin_name'] . '</option>';
                    }
                } ?>

            </select>

            <input type="button" class='save-btn' id="save-btn-<?php echo $row['promo_id']; ?>"
                   name="<?php echo $row['promo_id']; ?>" value="Save" hidden/>

        </div>

    <?php }

    /**
     * Displays the unassigned promotions
     */
    foreach ($unassignedPromotions as $unassignedPromotion) {

        ?>

        <div class="form-group">
            <?php
            echo '<img class=checkbox-image src="dependencies/images/' . $unassignedPromotion['promotion_type_image'] . '"> &nbsp';
            echo "<label class='display-modal-checkbox'>" . $unassignedPromotion["promotion_type_title"] . '</label>';
            echo "<button type='button' class='add-to-display' id='{$unassignedPromotion['promotion_id']}'
                   data-display-id='{$unassignedPromotion["display_id"]}'
                   name='promotion' value='{$unassignedPromotion["promotion_id"]}'> Add </button>";
            ?>

        </div>

    <?php }

    ?>


</form>
<hr>
<form class="form-horizontal" method="post">
    <input type="hidden" id="property-id" value="<?php echo $_POST['propertyId']; ?>"><br>
    <input type="hidden" id="display-id" value="<?php echo $_POST['displayId']; ?>"><br>
    <input type="text" id="display-name" name="displayName" value='<?php echo $display->getName() ?>'>
    <p>Display Name</p><br>
    <input type="text" id="display-location" name="displayLocation"
           value='<?php echo $display->getDisplayLocation() ?>'>
    <p>Display Location</p><br>
    <button type="button" id="update-display-btn">Save</button>
</form>

<script src="dependencies/js/editdisplay.js"></script>