<div id="add-promotion">
<input type="hidden" name="kfc_promotionType" value="kickforcash">
<br>
<input id="target-number" name="kfc_target_number" placeholder="Target Number" type="number">
<br>
<input id="cash-prize" name="kfc_cash_prize" placeholder="Cash Prize" type = "number">
    <br>
<input type="hidden" name="scene_id" value="11">
<br>


</div>
<script src="dependencies/js/promotion/formhelperfunctions.js"></script>
<?php
  if($_POST['promotion_settings']){
    echo "<script>getModalData(".$_POST['promotion_id'].",".$_POST['promotion_type'].");</script>";
  }

 ?>
