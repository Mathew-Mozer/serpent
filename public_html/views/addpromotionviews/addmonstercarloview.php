<?php

require_once("../../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
require "../../models/promotionmodels/HighHandModel.php";
$HighHandModel = new HighHandModel($dbcon->read_Database());
$HighHand = $HighHandModel->getCurrentHighHands($_POST['propertyId']);

?>


<div id="add-promotion">
<input type="hidden" id="promotionTypeName" name="tt_promotionType" value="monstercarlo">
<input type="hidden" id="promotionTypeId" name="tt_promotionTypeId" value="19">
<br>
<br>
<label>Connect To High Hand Gold</label>
<select id="monster_carlo_settings_hhid" name="monster_carlo_settings_hhid">
    <option value="0">Not Connected</option>
    <?php
    foreach ($HighHand as $currentHighHands) {
        ?>
<option value="<?php echo($currentHighHands["promotion_id"]) ?>"><?php echo($currentHighHands["promotion_id"]) ?> - <?php echo($currentHighHands["promotion_label"]) ?></option>
        <?php
    }
    ?>
</select><br>
    <div id="mcstep1">
        <div id="cardCont" class="container">
            <div class="row">
                <div class="col-sm-2">Card</div>
                <div class="col-sm-2">Payout</div>
            </div>
            <div class="row" id="ttlcnt">
                <div class="col-sm-2">
                    Total:
                    <div id="mccardcount" style="font-size: x-large"></div>
                </div>
            </div>
            <table>
                <tr>
                    <td>Qty</td>
                    <td>Payout</td>
                </tr>
                <tr>
                    <td>
                        <input onclick="this.select();" type="number" id="txtmcqty" value="1"/></td>
                    <td>
                        <input onclick="this.select();" onkeypress="return runmcAdd(event)" type="number" id="txtpayout" value="0"/></td>
                    <td>
                        <button type="button" onclick="addToMCArray();" name="txtadd">Add</button>
                    </td>
                </tr>

            </table>
        </div>
    </div>

    <br>
    <input type="hidden" name="monster_carlo_settings_payouts" id="monster_carlo_settings_payouts"/>
    <input type="hidden" id="scene-id" name="scene_id" value="1"/>
</div>
<!-- start item template -->
<div style="visibility: hidden" id="mcitmTemplate" class="row">
    <div class="col-sm-2">$cardnumber$</div>
    <div class="col-sm-2">
        $mul$ &nbsp;
        <button type="button" onclick="removeVal($cardnumbers$)" class="close">&times;</button>
    </div>
</div>
<!-- end Template -->
<script>
    var arr=[];
    $(function () {
        m2 = document.getElementById('cardCont');

    });
</script>
<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime()?>"></script>
<?php
if(isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");
  
    </script>";
    }
}

 ?>

