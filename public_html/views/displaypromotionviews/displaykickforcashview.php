<div id="add-promotion">
<input id="name-modal" name="kfc_name" placeholder="Name" type = "text">
<br>
<input id="chosen-number-modal" name="kfc_chosen_number" placeholder="Chosen Number" type="number">

<br>

<input id="game-label" name="kfc_gamelabel" placeholder="Game Label" type = "text">

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
