<?php
/**
 * This is the pointsGT form
 */
?>


<div id="add-promotion">
<input type="hidden" name="promotionTypeName" value="poinstgt">
    <input type="hidden" id="promotionTypeId" name="pgt_promotionTypeId" value="4">



    <input id="top-title-box" name="pgt_title" type="text" placeholder="Top Title">
    <label for="top-title-box">Top Title</label>
    <br><br>

    <textarea id="top-content-box" name="pgt_subtitle" placeholder="Top Content"></textarea>
    <label for="top-content-box">Top Content</label>
<br><br>

<input id="left-title-box" name="pgt_left_title" type="text" placeholder="Left Title">
    <label for="left-title-box">Left Title</label>
    <br><br>

    <textarea id="left-content-box" name="pgt_left_content" placeholder="Left Content"></textarea>
    <label for="left-content-box">Left Content</label>
<br><br>

<input id="right-title-box" name="pgt_right_title" type="text" placeholder="Right Title">
    <label for="right-title-box">Right Title</label>
<br><br>

<textarea id="right-content-box" name="pgt_right_content" type="text" placeholder="Right Content"></textarea>
    <label for="right-content-box">Right Text</label>

<br><br>

<input id="payout" name="pgt_payout" type="text" placeholder="Payout">
    <label for="payout">Payout Value</label>
<br><br>

<input id="start-date" name="pgt_race_begin" type="date">
    <label for="start-date">Start Date</label>
<br><br>

<input id="end-date" name="pgt_race_end" type="date">
    <label for="end-date">End Date</label>
<br><br>
<input id="enable-instant-winners" name="enable-instant-winners" type="checkbox"><label>Allow Instant Winners?</label>
<br><br>
    <script src="dependencies/js/jscolor.js"></script>
<div id="instant-winner-options" style="display: none">
    <input id="enable-instant-winner1" name="enable-instant-winner1" type="checkbox"><label>Enable Instant Winner 1</label>
    <br><br>
        <div>
            <input name="ct1" type="text" class="jscolor" id="txtiwcolor1" style="width:75px;" />
            <button class="jscolor {valueElement:'txtiwcolor1'}">
                &nbsp;
            </button>
            <br>
            <input id="enable-instant-winner1-threshold" name="pgt_points1" type="number" min="0" placeholder="250">
            <br><br>
            <input id="enable-instant-winner1-prize" name="pgt_prize_amount1" type="number" min="0" placeholder="25">
            <br><br>
        </div>
    <input id="enable-instant-winner2" name="enable-instant-winner2" type="checkbox"><label>Enable Instant Winner 2</label>
    <br><br>
    <div>
        <input name="ct2" type="text" class="jscolor" id="txtiwcolor2" style="width:75px;" />
        <button class="jscolor {valueElement:'txtiwcolor2'}">
            &nbsp;
        </button>
        <br>
        <input id="enable-instant-winner2-threshold" name="pgt_points2" type="number" min="0" placeholder="500">
        <br><br>
        <input id="enable-instant-winner2-prize" name="pgt_prize_amount2" type="number" min="0" placeholder="50">
        <br><br>
    </div>
    <input id="enable-instant-winner3" name="enable-instant-winner3" type="checkbox"><label>Enable Instant Winner 3</label>
    <br><br>
    <div>
        <input name="ct3" type="text" class="jscolor" id="txtiwcolor3" style="width:75px;" />
        <button class="jscolor {valueElement:'txtiwcolor3'}">
            &nbsp;
        </button>
        <br>
        <input id="enable-instant-winner3-threshold" name="pgt_points3" type="number" min="0" placeholder="750">
        <br><br>
        <input id="enable-instant-winner3-prize" name="pgt_prize_amount3" type="number" min="0" placeholder="75">
        <br><br>
    </div>

</div>
<input type="hidden" id="scene-id" name="scene_id" value="4">
</div>
<script>
    $('#enable-instant-winners').change(function(){
        if($('#enable-instant-winners').is(':checked')){
            $('#instant-winner-options').show();
        }else{
            $('#instant-winner-options').hide();
        }
    });

</script>
<script src="dependencies/js/promotion/formhelperfunctions.js"></script>
<?php
if(isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
        echo "<script>$('#instant-winner-options').show();</script>";
    }
}
 ?>
