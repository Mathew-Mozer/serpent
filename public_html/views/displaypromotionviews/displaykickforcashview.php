<?php
/**
 * This is the update kick for cash form
 */
?>

<div id="add-promotion">
<input id="name-modal" name="kfc_name" type="text" placeholder="Name">
  <label for="name-modal">Name</label>
<br>
<br>

<input id="chosen-number-modal" name="kfc_chosen_number" type="number" placeholder="Chosen Number">
  <label for="chosen-number-modal">Chosen Number</label>

<br>
<br>
  <label for="game-label"></label>
<input id="game-label" name="kfc_gamelabel" type="text" placeholder="Game Label">
<label for="game-label">Game Label</label>
<br>
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
