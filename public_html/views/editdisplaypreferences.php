<?php
session_start();
require "../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../models/PromotionModel.php";
require "../models/PropertyDisplays.php";
require "../models/PermissionModel.php";
$dbcon = new DBCon();
//var_dump($_POST);
$displayProperties = new PropertyDisplays($dbcon->read_Database(), $_POST['propertyId']);
$display = $displayProperties->getDisplayWithId($_POST['displayid']);
$promotion = new PromotionModel($dbcon->read_database());

?>
    <div class="option-group">
        <table style="width: 100%">
            <tr>
                <td style="padding: 5px; text-align: center" colspan="3"><label
                        for="top-title-box"><?php echo($display->getName()) ?></label></td>
            </tr>
            <tr>
                <td style="padding: 5px"><label for="top-title-box">Mac Address: </label>
                    <input id="display-mac" class="display-field" data-column="display_mac" name="pgt_title" type="text" placeholder="Top Title"
                           value="<?php echo($display->getMacAddress()) ?>"></td>
                <td style="padding: 5px">App Version:<?php echo($display->getAppVersion()) ?></td>
                <td style="padding: 5px"></td>
            </tr>
        </table>
    </div>
    <div class="option-group">
        <div style="text-align: center">
            <label for="top-content-box">Dimensions</label><br>
            W <input id="display-width" class="display-field" data-column="display_width" type="text" placeholder="Top Title" value="<?php echo($display->getWidth()) ?>">X
            H<input id="display-height" class="display-field" data-column="display_height" type="text" placeholder="Top Title" value="<?php echo($display->getHeight()) ?>">
            <br>
            <br>
            <input  id="display-fitw" class="display-field" data-column="display_fitw" type="checkbox" <?php echo(isChecked($display->getFitW())) ?>>Fit W <input
                id="display-fith" class="display-field" data-column="display_fith" type="checkbox" <?php echo(isChecked($display->getFitH())) ?>>Fit H
        </div>
    </div>
    <div class="option-group">
    <table style="width: 100%; text-align: center">
        <tr>
            <td><label for="top-content-box">Display Property</label><br>
                <select class="display-field" data-column="display_propertyid" id="display-propertyID" name="propertyID">
                    <?php
                    if (isset($_SESSION['userId'])) {
                        $properties = $promotion->getAssignableProperties();
                        echo "<option value='0'>Unassign</option>";
                        foreach ($properties as $property) {
                            echo "<option value='" . $property['property_id'] . "' ".isSelected($property['property_id'],$_POST['propertyId']).">" . $property['property_name'] . "</option>";
                        }
                    }
                    ?>
                </select></td>
            <td><label for="top-content-box">Display API</label><br>
                <select  class="display-field" data-column="display_api_id" id="display-api-id" name="propertyID">
                    <?php
                    if (isset($_SESSION['userId'])) {
                        $apis = $displayProperties->getAPIs();
                        foreach ($apis as $api) {
                            echo "<option value='" . $api['api_id'] . "'".isSelected($api['api_id'],$display->getApiId()).">" . $api['api_name'] . "</option>";
                        }
                    }
                    ?>
                </select></td>
            <td>
                <label for="top-content-box">Flip</label><br>
                <input  id="display-flip" class="display-field" data-column="display_flip" type="checkbox" <?php echo(isChecked($display->getFlip())) ?>>

            </td>
            <td>
                <label for="top-content-box">Debug</label><br>
                <input  id="display-debug" class="display-field" data-column="display_flip" type="checkbox" <?php echo(isChecked($display->getDebug())) ?>>
            </td>
        </tr>
    </table>
    </div>
    <button type="button" id="save-display-options"> Save Display Info</button>
<?php
function isChecked($val)
{
    if ($val) {
        return 'checked';
    }
}
function isSelected($val1,$val2){
    if($val1==$val2){
        return'selected';
    }else{
        return'';
    }
}

?>