<div id="promotion-id" data-promotion-id></div>
<label>Cash Prize</label>
<p id="cash-amount-modal"></p>
<label>Target Number</label>
<p id="winning-number-modal"></p>
<label>Name</label>
<br>

<form>
<input id="name-modal" name="name" type = "text"></input>
<br>
<label>Chosen Number</label>
<br>
<input id="chosen-number-modal" name="chosen-number" type="number"></input>
</form>
<br>

<script src="dependencies/js/promotion/kickforcash.js"></script>
<script>
//$("#promotion-view-modal").data('promo-id')
getModalData($("#promotion-view-modal").data('promo-id'));
</script>
