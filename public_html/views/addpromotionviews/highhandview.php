<div id="first-page">
    <form>
    <br>
    <label>Title Message
    <input id="title-message" name="title-message" type="text"/>
    </label>
    <br>
    <br>
    <label>Horn Timer
    <input id="horn-timer" name="horn-timer" type = "number"/>
    </label>
    <br>
    <br>
    <label>Payout Value
    <input id="payout-value" name="payout-value" type = "number"/>
    </label>
    <br>
    <br>
    <label>Session Timer
    <input id="session-timer" name="session-timer" type = "number"/>
    </label>
    <br>
    <br>
    <label>Scene Type
    <input id="scene-type" name="scene-type" type="number">
    </label>
    <br>
    <br>
    <label>Show Multiple Hands</label> <br>
        <label><span class="high-hand-span">Disabled</span> <input class="high-hand-radio" value="0"
                                                                   name="multiple-hands" type = "radio"/>  </label><br/>
        <label>Previous Winners <input class="high-hand-radio" value="1" name="multiple-hands" type = "radio"/> </label><br/>
        <label>Ranked Hands <input class="high-hand-radio" value="2" name="multiple-hands" type = "radio"/> </label><br/>
    <br>
    <br>
    <label class="high-hand-label">High Hand Gold
    <input class="high-hand-checkbox" id="high-hand-gold" name="high-hand-gold" type = "checkbox"/>
    </label>
    <br>
    <br>
    <label class="high-hand-label">Use Joker
    <input class="high-hand-checkbox" id="use-joker" name="use-joker" type = "checkbox"/>
    </label>
    <br>
    <br>
    <label class="high-hand-label">Template
    <input class="high-hand-checkbox" id="template" name="template" type = "checkbox"/>
    </label>
    </form>
</div>

<script src="dependencies/js/promotion/highhand.js"></script>
<script>
    getTemplate();
</script>