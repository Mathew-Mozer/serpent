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
<label>Title Text</label>
<TextArea type="text" value="" name="time_target_title"></TextArea>
    <label>Content Title</label>
    <input type="text" value="" name="time_target_contenttitle"><br>
<label>content</label>
<textarea name="time_target_content"></textarea><br>
    <label>cards</label>
<input type="text" value="5D,4D,5C,4C" name="time_target_cards"><br>
    <label>Default Start Time</label>
    <select name="time_target_def_hour">
        <option value="-1">Current</option>
        <option value="0">12am</option>
        <option value="1">1am</option>
        <option value="2">2am</option>
        <option value="3">3am</option>
        <option value="4">4am</option>
        <option value="5">5am</option>
        <option value="6">6am</option>
        <option value="7">7am</option>
        <option value="8">8am</option>
        <option value="9">9am</option>
        <option value="10">10am</option>
        <option value="11">11am</option>
        <option value="12">12pm</option>
        <option value="13">1pm</option>
        <option value="14">2pm</option>
        <option value="15">3pm</option>
        <option value="16">4pm</option>
        <option value="17">5pm</option>
        <option value="18">6pm</option>
        <option value="19">7pm</option>
        <option value="20">8pm</option>
        <option value="21">9pm</option>
        <option value="22">10pm</option>
        <option value="23">11pm</option>
    </select>
    <select name="time_target_def_minute">
        <option value="-1">Current</option>
        <option value="0">00</option>
        <option value="15">15</option>
        <option value="30">30</option>
        <option value="45">45</option>
    </select><br>
    <label>Default Seed</label>
    <input type="text" value="100" name="time_target_default_seed"><br>
    <label>Default increment time (Minutes)</label>
    <input type="text" value="50" name="time_target_default_Increment"><br>
    <label>How much to add?</label>
    <input type="text" value="50" name="time_target_default_add_amt"><br>
    <label>Max Payout</label>
    <input type="text" value="50" name="time_target_maxpayout"><br>
    <label>Progressive by time?</label>
    <input type="checkbox" name="time_target_progressive"><br>
    <label>Lock Defaults</label>
    <input type="checkbox" name="time_target_lock_defaults"><br>


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
