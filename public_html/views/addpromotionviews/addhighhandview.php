<?php
/**
 * This is the create high hand form
 */
if(isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        include "../sessionmanager.php";
    }
}
?>


<div id="add-promotion">
    <div id="first-page">
        <form>
            <input type="hidden" name="promotionTypeName" value="highhand">
            <input type="hidden" id="promotionTypeId" name="promotionTypeId" value="1">
            <br><label for="title-message">Title Message</label>
            <textarea id="title-message" style="width: 250px;height: 100px" name="title_message" type="text" placeholder="Title Message">

            </textarea>


            <br>
            <br>
            <label for="horn-timer">Horn Timer</label>
            <input id="horn-timer" name="horn_timer" type="number" placeholder="Horn Timer"/>

            <br>
            <br>
            <label for="payout-value">Default Payout</label>
            <input id="payout-value" name="payout_value" type="number" placeholder="Default Payout"/>

            <br>
            <br>
            <label>Session Timer</label>
            <div class="option-group" id="session-timer">
                <input class="high-hand-radio" value="2" name="session_timer" id="15" type="radio" checked/>
                <label for="15">15 min</label>
                <br>
                <input class="high-hand-radio" value="3" name="session_timer" id="30" type="radio"/>
                <label for="30">30 min</label>
                <br>
                <input class="high-hand-radio" value="1" name="session_timer" id="hr" type="radio"/>
                <label for="hr">1 hr</label>
                <br>
                <div id="hr-option" hidden>
                    <input class="high-hand-radio" value="0" name="isodd" id="odd" type="radio" checked/>
                    <label for="odd">Odd</label>
                    <br>
                    <input class="high-hand-radio" value="1" name="isodd" id="even" type="radio"/>
                    <label for="even">Even</label>
                </div>
            </div>
            <br>
            <br>
            <label>Show Multiple Hands</label> <br>
            <div class="option-group">
                <input class="high-hand-radio" value="0" name="multiple_hands" id="disabled" type="radio" checked/>
                <label for="disabled"> Disabled </label>
                <br/>
                <input class="high-hand-radio" value="1" name="multiple_hands" id="previous" type="radio"/>
                <label for="previous"> Previous Winners </label>
                <br/>
                <input class="high-hand-radio" value="2" name="multiple_hands" id="ranked" type="radio"/>
                <label for="ranked"> Ranked Hands </label>
                <br/>
            </div>
            <br>

            <input class="high-hand-checkbox" id="high-hand-gold" name="high_hand_attachmc" type="checkbox"/>
            <label class="high-hand-label">High Hand Gold</label>
            <br>

            <input class="high-hand-checkbox" id="use-joker" name="use_joker" type="checkbox"/>
            <label class="high-hand-label">Use Joker</label>
            <br>

            <input class="high-hand-checkbox" id="custom-payout" name="high_hand_custom_payout" type="checkbox"/>
            <label class="high-hand-label">Custom Payout</label>

            <input type="hidden" id="scene-id" name="scene_id" value="2"/>
            <input type="hidden" id="enable-scene-select" name="enable_scene_id" value="true"/>

    </div>
</div>
<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime()?>"></script>

<?php
if(isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
    }
}
?>
