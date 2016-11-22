<div id="promotion-id" data-promotion-id></div>
<label>Cash Prize</label>
<p id="cash-amount-modal"></p>
<label>Target Number</label>
<p id="winning-number-modal"></p>
<label>Name</label>
<br>
<input id="name-modal" name="name" type = "text"></input>
<br>
<label>Chosen Number</label>
<br>
<input id="chosen-number-modal" name="chosen-number" type="number"></input>

<br>
<label>Game Label</label>
<br>
<input id="game-label" name="game-label" type = "text"></input>

<br>
<label>Team 1   vs   Team 2</label><br>

<select id="team1">
  <?php include '../citiesview.html';?>
</select>

<select id="vs">
  <option>@</option>
  <option>vs</option>
</select>

<select id="team2">
    <?php include '../citiesview.html';?>
</select>

<script src="dependencies/js/promotion/kickforcash.js"></script>
<script>

  getModalData($("#promotion-view-modal").data('promo-id'));
</script>
