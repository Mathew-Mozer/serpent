<?php
session_start();
require "../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../models/PromotionModel.php";
require "../models/PropertyDisplays.php";
require "../models/PermissionModel.php";
$dbcon = new DBCon();
?>

<ul id="errorMessage" hidden></ul>
<?php
$displayOptions = new PromotionModel($dbcon->read_Database());
$displayProperties = new PropertyDisplays($dbcon->read_Database(), $_POST['propertyId']);
$display = $displayProperties->getDisplayWithId($_POST['displayId']);
$skins = $displayProperties->getSkinTypes($_POST['propertyId']);
$assignedPromotions = $displayOptions->getPromotionsByDisplayId($_POST['displayId']);
$unassignedPromotions = $displayOptions->getUnassignedPromotions($_POST['displayId'], $_SESSION['userId']);
$permission = new PermissionModel($dbcon->update_database(), $_SESSION['userId']);
?>
<div id="display-info" data-property-id="<?php echo($_POST['propertyId'])?>" data-display-id="<?php echo($_POST['displayId'])?>">
    <button class="display-modal-view-switch" data-tab="display-promotions-modal-view"> Display Promotions </button>
    <?php if ($_SESSION['isGod']) { ?>
        <button class="display-modal-view-switch" data-tab="display-admin-options-modal"> Administrator Options</button>
        <?php
    }
    ?>
</div>
<div id="display-admin-options-modal" class="display-modal-view" hidden>

</div>
<div id="display-promotions-modal-view" class="display-modal-view">
<form>
    <div id="display-id-form" hidden data-display-id="<?php echo $_POST['displayId']; ?>"></div>
    <div id="property-id-form" hidden data-property-id="<?php echo $_POST['propertyId']; ?>"></div>
    <div id="property-name-form" hidden data-property-name="<?php echo $_POST['propertyName']; ?>"></div>

    <?php

    /**
     * Loops through and displays assigned promotions
     */

        foreach ($assignedPromotions as $assignedPromotion) {
    ?>

        <div class="form-group">
            <?php
            if($assignedPromotion['promotion_label']==""){
                $apromoname=$assignedPromotion['promotion_type_title'];
            }else{
                $apromoname=$assignedPromotion['promotion_label'];

            }
                echo '<div class="display-list-artifact"><i class="font-awesome fa ' . $displayOptions->getPromotionArtifactById($assignedPromotion["promo_id"]) . '"></i></div> <img class=checkbox-image src="dependencies/images/' . $assignedPromotion['promotion_type_image'] . '"> &nbsp';
                echo "<label class='display-modal-checkbox' data-toggle='tooltip' title='Promotion ID: " . $assignedPromotion['promo_id'] ."\n".$apromoname. "'>" . $apromoname . "</label>";
            ?>
            <label class="display-modal-label"><?php echo $assignedPromotion['promotion_type_scene_verbage']; ?> </label>

            <input class="scene-duration" type="number"
                   id="<?php echo 'scene-duration-' . $assignedPromotion['promo_id']; ?>"
                   name="<?php echo $assignedPromotion['promo_id']; ?>"
                   value="<?php echo $assignedPromotion['scene_duration'] ?>">

            <label class="display-modal-label">Skin Id </label>

            <select class="skin-id" id="skin-id-<?php echo $assignedPromotion['promo_id']; ?>" name="<?php echo $assignedPromotion['promo_id']; ?>">

                <?php foreach ($skins as $skin) {

                    if ($assignedPromotion['skin_id'] == $skin['skin_id']) {
                        echo '<option value="' . $skin['skin_id'] . '" selected>' . $skin['skin_name'] . '</option>';

                    } else {

                        echo '<option value="' . $skin['skin_id'] . '">' . $skin['skin_name'] . '</option>';
                    }
                }

                ?>

            </select>

            <input type="button" class='save-btn' id="save-btn-<?php echo $assignedPromotion['promo_id']; ?>"
                   name="<?php echo $assignedPromotion['promo_id']; ?>" value="Save" hidden/>

            <?php
                echo "<button type='button'  class='remove-from-display' id='{$assignedPromotion['promo_id']}' name='remove-promotion'> Remove </button>";
            ?>

            </div>

    <?php }

    /**
     * Displays the unassigned promotions
     */
    foreach ($unassignedPromotions as $unassignedPromotion) {
        ?>

        <div class="form-group">
            <?php
            if($unassignedPromotion['promotion_label']==""){
                $promoname=$unassignedPromotion['promotion_type_title'];
            }else{
                $promoname=$unassignedPromotion['promotion_label'];

            }

            echo '<div class="display-list-artifact"><i class="font-awesome fa ' . $displayOptions->getPromotionArtifactById($unassignedPromotion["promotion_id"]) . '"></i></div> <img class=checkbox-image src="dependencies/images/' . $unassignedPromotion['promotion_type_image'] . '"> &nbsp';
            echo "<label class='display-modal-checkbox' data-toggle='tooltip' title='Promotion ID: " . $unassignedPromotion['promotion_id'] . " '>" . $promoname . "</label>";
            echo "<button type='button' data-default-time='".$unassignedPromotion['promotion_type_default_time']."' data-skin-id='".$unassignedPromotion['promotion_skin']."'  class='add-to-display' id='{$unassignedPromotion['promo_property_promo_id']}' 
                    name='add-promotion'> Add </button>";
            ?>

        </div>

    <?php }

    ?>


</form>

<hr>
<form class="form-horizontal" method="post">
    <input type="text" id="display-name-field" name="displayName" value='<?php echo $display->getName() ?>'>
    <p>Display Name</p><br>
    <input type="text" id="display-location-field" name="displayLocation"
           value='<?php echo $display->getDisplayLocation() ?>'>
    <p>Display Location</p><br>
    <button type="button" id="update-display-btn" hidden>Save</button>

    <input type="hidden" id="property-id" value="<?php echo $_POST['propertyId']; ?>">
    <input type="hidden" id="display-id" value="<?php echo $_POST['displayId']; ?>">
    <input type="hidden" id="property-name" value="<?php echo $_POST['propertyName']; ?>">
    <input type="hidden" id="default-skin" value="0">
    <input type="hidden" id="default-scene-duration" value="1">
</form>

</div>
