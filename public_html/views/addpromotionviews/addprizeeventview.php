<?php
/**
 * This is the kick for cash form
 */
?>


<div id="add-promotion">
    <input type="hidden" id="scene-id" name="scene_id" value="8"/>
    <input type="hidden" id="promotionTypeName" name="tt_promotionType" value="prizeevent">
    <input type="hidden" id="promotionTypeId" name="tt_promotionTypeId" value="8">
    <br>
    <br>
    <label>Title Text</label><br>
    <TextArea type="text" value="" name="prize_event_title"></TextArea>


    <br>
    <label>Layout Options</label>
    <div class="option-group">

        <input class="high-hand-checkbox" id="prize-event-randomprize" name="prize_event_randomprize"
               type="checkbox"/>
        <label class="high-hand-label">Randomize Entries</label>
        <br>
        <input class="high-hand-checkbox" id="prize_event_incrementnumber" name="prize_event_incrementnumber" type="checkbox"/>
        <label class="high-hand-label">Incremental Jackpot</label>
        <br>




    </div>
    <label>Jackpot Amount</label>
    <div class="option-group">

        <input class="high-hand-radio" value="1" name="prize_event_useprizes" id="holdem"
               type="radio"
               checked/>
        <label for="disabled"> Total Prizes </label>
        <br/>
        <input class="high-hand-radio" value="0" name="prize_event_useprizes" id="paigow"
               type="radio"/>
        <label for="previous"> Set Amount </label>
        <br/>
        <label class="high-hand-label">Jackpot Amount</label><br>
        <input id="prize-event-odoamount" name="prize_event_odoamount" type="text"/>

        <br/>
    </div>

    <label for="horn-timer">Horn Timer</label><br>
    <input id="horn-timer" name="prize_event_secondtohorn" type="number" value="0" placeholder="Horn Timer"/><br><br>
    <label>Timer Visibility Options</label>
    <div class="option-group">

        <input class="high-hand-checkbox" id="prize_event_clockvisible" name="prize_event_clockvisible"
               type="checkbox"/>
        <label class="high-hand-label">Clock Visible</label>
        <br>
        <input class="high-hand-checkbox" id="prize_event_nexttimevisible" name="prize_event_nexttimevisible" type="checkbox"/>
        <label class="high-hand-label">Next Time Visible</label>
        <br>
    </div>
    <label>Session Timer</label><br>
    <div class="option-group" id="session-timer">
        <input class="high-hand-radio" value="2" name="prize_event_timertype" id="15" type="radio"
               checked/>
        <label for="15">15 min</label>
        <br>
        <input class="high-hand-radio" value="3" name="prize_event_timertype" id="30" type="radio"/>
        <label for="30">30 min</label>
        <br>
        <input class="high-hand-radio" value="1" name="prize_event_timertype" id="hr" type="radio"/>
        <label for="hr">1 hr</label>
        <br>
        <div id="hr-option" hidden>
            <input class="high-hand-radio" value="0" name="prize_event_isoddhr" id="odd" type="radio"
                   checked/>
            <label for="odd">Odd</label>
            <br>
            <input class="high-hand-radio" value="1" name="prize_event_isoddhr" id="even" type="radio"/>
            <label for="even">Even</label>
        </div>
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
