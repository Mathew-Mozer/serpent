<?php
/**
 * This is the kick for cash form
 */
?>


<div id="add-promotion">
<input type="hidden" id="promotionTypeName" name="tt_promotionType" value="timetarget">
<input type="hidden" id="promotionTypeId" name="tt_promotionTypeId" value="23">
<br>
<br>
<label>Seed Jackpot</label>
<input type="number" value="500" name="time_target_seed"><br>
    <label>Start</label>
    <input type="datetime" value="<?php echo(date('Y/m/d h:00:00 a', time())) ?>" name="time_target_start"><br>
<label>Increment Minutes</label>

<input type="number" value="15" name="time_target_increment_min"><br>
    <label>To Add</label>
<input type="number" value="25" name="time_target_add">

<input type="hidden" id="scene-id" name="scene_id" value="14"/>
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
