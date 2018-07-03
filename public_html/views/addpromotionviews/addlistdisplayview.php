<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 1/24/2018
 * Time: 3:24 AM
 */
//
require "../../models/PromotionModel.php";
require_once("../../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");

//Create database connection object
$dbcon = NEW DbCon();

//Create models
$promotion = new PromotionModel($dbcon->read_database());

$properties = $promotion->getAssignableProperties();
?>

<div id="add-promotion">
    <br><br>
    <label for="right-title-box">Promotion Title</label><br>
    <input id="right-title-box" name="listdisplay_text1title" type="text" placeholder="Right Title">

    <br><br>
    <label for="right-content-box">Promotion Text</label><br>
    <textarea class="pointsgt-textarea" id="right-content-box" name="listdisplay_text1" type="text"
              placeholder="Right Content"></textarea>
    <br>
    <select name="listdisplay_slideshowid" id="listdisplay_slideshowid">
        <option value="0">None</option>
        <?php
        foreach ($properties as $property) {
            foreach ($promotion->getAllPromotionsByProperty($property["property_id"], "5") as $promo) {
                ?>
                <option value="<?php echo($promo["promotion_id"]) ?>"><?php
                    if (trim($promo["promotion_label"]) == "") {
                        $title = $promo["promotion_type_title"];
                    } else {
                        $title = $promo["promotion_label"];
                    }
                    echo($promo["promotion_id"] . " - " . $title);
                    ?>
                </option>
                <?php
            }
        }
        ?>
    </select>
<!-- Make sure to set the scene ID correctly  -->
<input type="hidden" id="scene-id" name="scene_id" value="17">
</div>

<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime() ?>"></script>

<?php
if (isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
        echo "<script>
 
</script>";
    }
}
?>

