<div id="add-promotion">
<input id="name-modal" name="kfc_name" type = "text"></input>
<br>
<label>Chosen Number</label>
<br>
<input id="chosen-number-modal" name="kfc_chosen_number" type="number"></input>

<br>
<label>Game Label</label>
<br>
<input id="game-label" name="kfc_gamelabel" type = "text"></input>

<br>
<label>Team 1   vs   Team 2</label><br>

<select id="team1" name="kfc_team1">
  <?php include '../citiesview.html';?>
</select>

<select id="vs" name="kfc_vs">
  <option>@</option>
  <option>vs</option>
</select>

<select id="team2" name="kfc_team2">
    <?php include '../citiesview.html';?>
</select>
</div>

<script src="dependencies/js/promotion/formhelperfunctions.js"></script>
<script>

getModalData($("#promotion-view-modal").data('promo-id'), 11);
</script>
