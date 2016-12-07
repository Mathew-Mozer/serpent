<?php
/**
 * This is the kick for cash form
 */
?>


<div id="add-promotion">
<input type="hidden" name="kfc_promotionType" value="kickforcash">
<br>
<br>

<input id="target-number" name="kfc_target_number" type="number" placeholder="Target Number"/>
    <label for="target-number">Target Number</label>
<br>
<br>

<input id="cash-prize" name="kfc_cash_prize" type = "number" placeholder="Initial Cash Prize"/>
    <label for="cash-prize">Initial Cash Prize</label>

<input type="hidden" name="scene_id" value="11"/>
<br>


</div>
<script src="dependencies/js/promotion/formhelperfunctions.js"></script>
<?php
  if($_POST['promotion_settings']){
    echo "<script>getModalData(".$_POST['promotion_id'].",".$_POST['promotion_type'].");</script>";
  }

 ?>
