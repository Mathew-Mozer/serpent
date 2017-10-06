<?php
/**
 * This is the kick for cash form
 */
?>


<div id="add-promotion">
<input type="hidden" id="promotionTypeName" name="tt_promotionType" value="timetargetx">
<input type="hidden" id="promotionTypeId" name="tt_promotionTypeId" value="15">
<br>
<br>
    <!--
<label>Title Text</label>
<TextArea type="text" value="" name="time_target_title"></TextArea>
    <label>Content Title</label>
    <input type="text" value="" name="time_target_contenttitle"><br>
<label>content</label>
<textarea name="time_target_content"></textarea><br>
    <label>cards</label>
<input type="text" value="5D,4D,5C,4C" name="time_target_cards">


<br>


</div>
-->
    <input type="hidden" id="scene-id" name="scene_id" value="15"/>
    This is a promotion combiner. There are no settings. In order to use this promotion you will need 2 to 4 Time Target Promotions.

<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime()?>"></script>
<?php
if(isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
    }
}

 ?>
