<div id="add-promotion">
<input type="hidden" name="kfc_promotionType" value="kickforcash"></input>
<br>
<label>Target Number</label>
<br>
<input id="target-number" name="kfc_target_number" type="number"></input>
<br>
<label>Cash Prize </label>
<br>
<input id="cash-prize" name="kfc_cash_prize" type = "number"></input>

<br>


</div>
<script src="dependencies/js/promotion/formhelperfunctions.js"></script>
<script>
  getModalData($("#promotion-view-modal").data('promo-id'),11);
</script>
