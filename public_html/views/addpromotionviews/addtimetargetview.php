<?php
/**
 * This is the kick for cash form
 */
?>


<div id="add-promotion">
<input type="hidden" id="promotionTypeName" name="kfc_promotionType" value="kickforcash">
<input type="hidden" id="promotionTypeId" name="kfc_promotionTypeId" value="11">
<br>
<br>

Time Target Fields go here!
    don't forget to change the hidden fields

<input type="hidden" id="scene-id" name="scene_id" value="11"/>
<br>


</div>
<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime()?>"></script>
<?php
if(isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
    }
}

 ?>
