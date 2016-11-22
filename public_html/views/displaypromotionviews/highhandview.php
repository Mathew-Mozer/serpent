<div id="first-page">
    <form>
    <br>
    <label>Title Message</label>
    <input id="title-message-modal" name="title-message" type="text"/>
    <br>
    <br>
    <label>Horn Timer</label>
    <input id="horn-timer-modal" name="horn-timer" type = "number"/>
    <br>
    <br>
    <label>Payout Value</label>
    <input id="payout-value-modal" name="payout-value" type = "number"/>
    <br>
    <br>
    <label>Session Timer</label>
    <input id="session-timer-modal" name="session-timer" type = "number"/>
    <br>
    <br>
    <label>Show Multiple Hands</label> <br>
        <span class="high-hand-span">Disabled</span> <input class="high-hand-radio" value="0"
                                                name="multiple-hands-modal" type = "radio"/>  <br/>
        Previous Winners <input class="high-hand-radio" value="1" name="multiple-hands-modal" type = "radio"/> <br/>
        Ranked Hands <input class="high-hand-radio" value="2" name="multiple-hands-modal" type = "radio"/> <br/>
    <br>
    <br>
    <label class="high-hand-label">High Hand Gold</label>
    <input class="high-hand-checkbox" id="high-hand-gold-modal" name="high-hand-gold" type = "checkbox"/>
    <br>
    <br>
    <label class="high-hand-label">Use Joker</label>
    <input class="high-hand-checkbox" id="use-joker-modal" name="use-joker" type = "checkbox"/>
    </form>
</div>

<script src="dependencies/js/promotion/highhand.js"></script>
<script>
    getHighHandData($("#promotion-view-modal").data('promo-id'));
</script>