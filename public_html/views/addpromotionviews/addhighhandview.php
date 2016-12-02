<div id="add-promotion">
    <div id="first-page">
        <form>
            <br>
            <input id="title-message" name="title_message" type="text" placeholder="Title Message"/>
            <br>
            <br>
            <input id="horn-timer" name="horn_timer" type="number" placeholder="Horn Timer"/>
            <br>
            <br>
            <input id="payout-value" name="payout_value" type="number" placeholder="Default Payout"/>
            <br>
            <br>
            <input id="session-timer" name="session_timer" type="number" placeholder="Session Timer"/>
            <br>
            <br>
            <label>Show Multiple Hands</label> <br>
            <div class="option-group">
                <label><input class="high-hand-radio" value="0" name="multiple-hands" type="radio"/> Disabled
                </label><br/>
                <label><input class="high-hand-radio" value="1" name="multiple-hands" type="radio"/> Previous Winners
                </label><br/>
                <label><input class="high-hand-radio" value="2" name="multiple-hands" type="radio"/> Ranked Hands
                </label><br/>
            </div>
            <br>
            <label class="high-hand-label">High Hand Gold</label>
            <input class="high-hand-checkbox" id="high-hand-gold" name="high_hand_gold" type="checkbox"/>
            <br>
            <br>
            <label class="high-hand-label">Use Joker</label>
            <input class="high-hand-checkbox" id="use-joker" name="use_joker" type="checkbox"/>
            <input type="hidden" name="scene_id" value="2"/>
            <br>
            <br>
            <label class="high-hand-label">Template</label>
            <input class="high-hand-checkbox" id="template" name="template" type="checkbox"/>
            <br>
            <br>
            <label class="high-hand-label">Custom Payout</label>
            <input class="high-hand-checkbox" id="custom-payout" name="custom-payout" type="checkbox"/>
        </form>
    </div>
</div>
<script src="dependencies/js/promotion/formhelperfunctions.js"></script>
<script src="dependencies/js/promotion/highhand.js"></script>
<script>
    getTemplate();
</script>
<?php
if ($_POST['promotion_settings']) {
    echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
}
?>
