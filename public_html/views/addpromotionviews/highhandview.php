<div id="first-page">
    <form>
    <br>
    <label>Title Message</label>
    <input id="title-message" name="title-message" type="text"/>
    <br>
    <br>
    <label>Horn Timer</label>
    <input id="horn-timer" name="horn-timer" type = "number"/>
    <br>
    <br>
    <label>Payout Value</label>
    <input id="payout-value" name="payout-value" type = "number"/>
    <br>
    <br>
    <label>Session Timer</label>
    <input id="session-timer" name="session-timer" type = "number"/>
    <br>
    <br>
    <label>Show Multiple Hands</label> <br>
        <span class="high-hand-span">Disabled</span> <input class="high-hand-radio" value="0" name="multiple-hands" type = "radio"/>  <br/>
        Previous Winners <input class="high-hand-radio" value="1" name="multiple-hands" type = "radio"/> <br/>
        Ranked Hands <input class="high-hand-radio" value="2" name="multiple-hands" type = "radio"/> <br/>
    <br>
    <br>
    <label class="high-hand-label">High Hand Gold</label>
    <input class="high-hand-checkbox" id="high-hand-gold" name="high-hand-gold" type = "checkbox"/>
    <br>
    <br>
    <label class="high-hand-label">Use Joker</label>
    <input class="high-hand-checkbox" id="use-joker" name="use-joker" type = "checkbox"/>
    </form>
</div>


<div id="second-page" hidden>
    <br>
    <label>
        Scene Type
    </label>
        <input id="scene-type" name="scene-type" value="1" type="radio">Scene 1</input><br>
        <input id="scene-type" name="scene-type" value="2" type="radio">Scene 2</input><br>
        <input id="scene-type" name="scene-type" value="3" type="radio">Scene 3</input><br>

</div>

<script src="dependencies/js/promotion/highhand.js"></script>