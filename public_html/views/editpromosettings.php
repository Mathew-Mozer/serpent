<?php
session_start();
require "../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../models/PromotionModel.php";
require "../models/PermissionModel.php";
require_once "../models/PropertyDisplays.php";
$dbcon = new DBCon();
?>
<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 2/28/2018
 * Time: 5:22 AM
 */
print_r($_POST);
$displayProperties = new PropertyDisplays($dbcon->read_Database(), $_POST['propertyId']);
$promotion = new PromotionModel($dbcon->read_Database(), $_POST['promoid']);
$skins = $displayProperties->getSkinTypes($_POST['propertyId']);

?>
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
