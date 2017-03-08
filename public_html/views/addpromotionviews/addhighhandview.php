<?php
/**
 * This is the create high hand form
 */
if (!isset($_POST['promotion_template'])) {
    include "../sessionmanager.php";
}
?>


<div id="add-promotion">
    <div id="first-page">
        <table>
            <tr>
                <td>
                    <div>
                        <input type="hidden" name="promotionTypeName" value="highhand">
                        <input type="hidden" id="promotionTypeId" name="promotionTypeId" value="1">
                        <br><label for="title-message">Description</label><br>
                        <textarea id="title-message" style="width: 250px;height: 100px" name="title_message" type="text"
                                  placeholder="Title Message"></textarea>
                        <br>
                        <br>
                        <label for="horn-timer">Horn Timer</label><br>
                        <input id="horn-timer" name="horn_timer" type="number" value="0" placeholder="Horn Timer"/>

                        <br>
                        <br>
                        <label for="payout-value">Default Payout</label><br>
                        <input id="payout-value" name="payout_value" type="number" value="250"
                               placeholder="Default Payout"/>
                    </div>
                </td>
                <td>
                    <table>
                        <tr>
                            <td style="width: 250px"><label>Session Timer</label><br>
                                <table class="option-group">
                                    <tr>
                                        <td>

                                <div class="option-group" id="session-timer">
                                    <input class="high-hand-radio" value="2" name="session_timer" id="15" type="radio"
                                           checked/>
                                    <label for="15">15 min</label>
                                    <br>
                                    <input class="high-hand-radio" value="3" name="session_timer" id="30" type="radio"/>
                                    <label for="30">30 min</label>
                                    <br>
                                    <input class="high-hand-radio" value="0" name="session_timer" id="1hr"
                                           type="radio"/>
                                    <label for="30">1 hr</label>
                                    <br>
                                    <input class="high-hand-radio" value="1" name="session_timer" id="2hr"
                                           type="radio"/><label for="hr">2 hr</label>

                                </div>
                            </td>
                            <td>
                                <br>
                                <div id="2hr-option" class="option-group" hidden>
                                    <input class="high-hand-radio" value="1" name="high_hand_isodd" id="odd" type="radio"
                                           checked/>
                                    <label for="odd">Odd</label>
                                    <br>
                                    <input class="high-hand-radio" value="0" name="high_hand_isodd" id="even" type="radio"/>
                                    <label for="even">Even</label>
                                </div>
                            </td>
                        </tr>
                                </table>
                        </td>
                        <td style="width: 250px"><label>Show Multiple Hands</label> <br>
                            <div class="option-group">
                                <input class="high-hand-radio" value="0" name="multiple_hands" id="disabled"
                                       type="radio"
                                       checked/>
                                <label for="disabled"> Disabled (Show Title Message) </label>
                                <br/>
                                <input class="high-hand-radio" value="1" name="multiple_hands" id="previous"
                                       type="radio"/>
                                <label for="previous"> Previous Winners </label>
                                <br/>
                                <input class="high-hand-radio" value="2" name="multiple_hands" id="ranked"
                                       type="radio"/>
                                <label for="ranked"> Ranked Hands </label>
                                <br/>
                            </div>
                        </td>

                        </tr>
                        <tr>
                            <td style="width: 250px">
                                <div class="option-group">
                                    <label>Cards Per Hand</label> <br>
                                    <input class="high-hand-radio" value="5" name="high_hand_cardcount" id="holdem"
                                           type="radio"
                                           checked/>
                                    <label for="disabled"> 5 Cards </label>
                                    <br/>
                                    <input class="high-hand-radio" value="7" name="high_hand_cardcount" id="paigow"
                                           type="radio"/>
                                    <label for="previous"> 7 Cards </label>
                                    <br/>
                                    <br/>

                                    <br/>
                                </div>
                            </td>
                            <td style="width: 250px">
                                <div class="option-group">
                                    <label>Other Options</label> <br>
                                    <input class="high-hand-checkbox" id="high-hand-gold" name="high_hand_attachmc"
                                           type="checkbox"/>
                                    <label class="high-hand-label">High Hand Gold</label>
                                    <br>

                                    <input class="high-hand-checkbox" id="use-joker" name="use_joker" type="checkbox"/>
                                    <label class="high-hand-label">Use Joker</label>
                                    <br>

                                    <input class="high-hand-checkbox" id="custom-payout" name="high_hand_custom_payout"
                                           type="checkbox"/>
                                    <label class="high-hand-label">Custom Payout</label><br>
                                    <input class="high-hand-checkbox" id="high_hand_locktotime"
                                           name="high_hand_locktotime"
                                           type="checkbox"/>
                                    <label class="high-hand-label">Lock Hand To Time</label>

                                    <input type="hidden" id="scene-id" name="scene_id" value="2"/>
                                    <input type="hidden" id="enable-scene-select" name="enable_scene_id" value="true"/>

                                </div>
                            </td>
                        </tr>
                    </table>
                    <div>


                    </div>
                </td>
            </tr>
        </table>
        <form>

    </div>
</div>
<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime() ?>"></script>

<?php
if (isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
    }
}
?>
