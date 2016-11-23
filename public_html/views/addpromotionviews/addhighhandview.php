<div id="add-promotion">
<div id="first-page">
    <form>
    <br>
    <label>Title Message
    <input id="title-message" name="title_message" type="text"/>
    </label>
    <br>
    <br>
    <label>Horn Timer
    <input id="horn-timer" name="horn_timer" type = "number"/>
    </label>

    <label>Payout Value
    <input id="payout-value" name="payout_value" type = "number"/>
    </label>

    <label>Session Timer
    <input id="session-timer" name="session_timer" type = "number"/>
    </label>
    
    <br>
    <label>Show Multiple Hands</label> <br>
        <label><span class="high-hand-span">Disabled</span> <input class="high-hand-radio" value="0"
                                                                   name="multiple_hands" type = "radio"/>  </label><br/>
        <label>Previous Winners <input class="high-hand-radio" value="1" name="multiple_hands" type = "radio"/> </label><br/>
        <label>Ranked Hands <input class="high-hand-radio" value="2" name="multiple_hands" type = "radio"/> </label><br/>
    <br>
        <label>Show Multiple Hands</label> <br>
        <div class="option-group">

                <label><span class="high-hand-span"></span>
                    <input class="high-hand-radio" value="0" name="multiple-hands" type = "radio"/> Disabled </label><br/>
            <label><input class="high-hand-radio" value="1" name="multiple-hands" type = "radio"/> Previous Winners </label><br/>
            <label><input class="high-hand-radio" value="2" name="multiple-hands" type = "radio"/> Ranked Hands </label><br/>
        </div>
    <br>
    <label class="high-hand-label">High Hand Gold
    <input class="high-hand-checkbox" id="high-hand-gold" name="high_hand_gold" type = "checkbox"/>
    </label>
    <br>
    <label class="high-hand-label">Use Joker
    <input class="high-hand-checkbox" id="use-joker" name="use_joker" type = "checkbox"/>
    <input type="hidden" name="scene_id" value="2"></input>
    </label>
    <br>
    <br>
    <label class="high-hand-label">Template
    <input class="high-hand-checkbox" id="template" name="template" type = "checkbox"/>
    </label>
    </form>
</div>
</div>
<script src="dependencies/js/promotion/formhelperfunctions.js"></script>
<script src="dependencies/js/promotion/highhand.js"></script>
<script>
    getTemplate();
</script>
<?php
  if($_POST['promotion_settings']){
    echo "<script>getModalData(".$_POST['promotion_id'].",".$_POST['promotion_type'].");</script>";
  }
 ?>
