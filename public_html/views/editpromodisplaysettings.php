<?php
session_start();
require "../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../models/PromotionModel.php";
require_once "../models/PropertyDisplays.php";
require "../models/PermissionModel.php";
$dbcon = new DBCon();
?>
<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 2/28/2018
 * Time: 5:22 AM
 */
//print_r($_POST);
$displayOptions = new PromotionModel($dbcon->read_Database());
$displayProperties = new PropertyDisplays($dbcon->read_Database(), $_POST['propertyId']);
//$display = $displayProperties->getDisplayWithId($_POST['displayId']);
$skins = $displayProperties->getSkinTypes($_POST['propertyId']);
$assignedPromotions = $displayOptions->getPromotionsByDisplayId($_POST['displayId']);
$assignedPromotion = $displayOptions->getPromotionById($_POST['promoid']);
//$unassignedPromotions = $displayOptions->getUnassignedPromotions($_POST['displayId'], $_SESSION['userId']);
//$permission = new PermissionModel($dbcon->update_database(), $_SESSION['userId']);
?>
<input style="width: 50px" id="update-promo-scene-duration" class="" type="number"
       id="<?php echo 'scene-duration-' . $assignedPromotion['promo_id']; ?>"
       name="<?php echo $_POST['promoid']; ?>"
       value="<?php echo $_POST['duration'] ?>">
<label class="display-modal-label"><?php echo $assignedPromotion['promotion_type_scene_verbage']; ?> </label><br>
<br>
Scene Skin
<select class="skin-id" id="update-promo-scene-skin" data-promo-id="<?php echo $_POST['promoid']; ?>" name="<?php echo $_POST['promoid']; ?>">
    <option value="0">Select Skin</option>
    <?php foreach ($skins as $skin) {

        if ($_POST['skinId'] == $skin['skin_id']) {
            echo '<option value="' . $skin['skin_id'] . '" selected>' . $skin['skin_name'] . '</option>';

        } else {

            echo '<option value="' . $skin['skin_id'] . '">' . $skin['skin_name'] . '</option>';
        }
    }

    ?>

</select>
