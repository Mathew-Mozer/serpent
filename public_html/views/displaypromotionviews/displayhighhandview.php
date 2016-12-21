<?php
/**
 * This is the update high hand form
 */
?>

<div id="new-hand">
    <form>

        <input id="player-name-modal" name="title-message" type="text" placeholder="Player Name"/>
        <label for="player-name-modal"> Player Name </label>
        <br>
        <br>

    </form>
    <div class="container">
        <div class="row">
            <img src="dependencies/images/cards/CB.png" class="card standard-card card-index-highlight" id="hh_index1">
            <img src="dependencies/images/cards/CB.png" class="card standard-card" id="hh_index2">
            <img src="dependencies/images/cards/CB.png" class="card standard-card" id="hh_index3">
            <img src="dependencies/images/cards/CB.png" class="card standard-card" id="hh_index4">
            <img src="dependencies/images/cards/CB.png" class="card standard-card" id="hh_index5">
            <img src="dependencies/images/cards/CB.png" class="card standard-card" id="hh_index6">
            <img src="dependencies/images/cards/CB.png" class="card standard-card" id="hh_index7">
            <img src="dependencies/images/cards/CB.png" class="card gold-card" id="hh_index8">
        </div>
    </div>
<hr>
<div class="container">
    <div class="row">
        <img src="dependencies/images/cards/AH.png" class="card standard-card" id="AH">
        <img src="dependencies/images/cards/2H.png" class="card standard-card" id="2H">
        <img src="dependencies/images/cards/3H.png" class="card standard-card" id="3H">
        <img src="dependencies/images/cards/4H.png" class="card standard-card" id="4H">
        <img src="dependencies/images/cards/5H.png" class="card standard-card" id="5H">
        <img src="dependencies/images/cards/6H.png" class="card standard-card" id="6H">
        <img src="dependencies/images/cards/7H.png" class="card standard-card" id="7H">
        <img src="dependencies/images/cards/8H.png" class="card standard-card" id="8H">
        <img src="dependencies/images/cards/9H.png" class="card standard-card" id="9H">
        <img src="dependencies/images/cards/10H.png" class="card standard-card" id="10H">
        <img src="dependencies/images/cards/JH.png" class="card standard-card" id="JH">
        <img src="dependencies/images/cards/QH.png" class="card standard-card" id="QH">
        <img src="dependencies/images/cards/KH.png" class="card standard-card" id="KH">
    </div>

    <div class="row">
        <img src="dependencies/images/cards/AD.png" class="card standard-card" id="AD">
        <img src="dependencies/images/cards/2D.png" class="card standard-card" id="2D">
        <img src="dependencies/images/cards/3D.png" class="card standard-card" id="3D">
        <img src="dependencies/images/cards/4D.png" class="card standard-card" id="4D">
        <img src="dependencies/images/cards/5D.png" class="card standard-card" id="5D">
        <img src="dependencies/images/cards/6D.png" class="card standard-card" id="6D">
        <img src="dependencies/images/cards/7D.png" class="card standard-card" id="7D">
        <img src="dependencies/images/cards/8D.png" class="card standard-card" id="8D">
        <img src="dependencies/images/cards/9D.png" class="card standard-card" id="9D">
        <img src="dependencies/images/cards/10D.png" class="card standard-card" id="10D">
        <img src="dependencies/images/cards/JD.png" class="card standard-card" id="JD">
        <img src="dependencies/images/cards/QD.png" class="card standard-card id="QD">
        <img src="dependencies/images/cards/KD.png" class="card standard-card" id="KD">
    </div>

    <div class="row">
        <img src="dependencies/images/cards/AC.png" class="card standard-card" id="AC">
        <img src="dependencies/images/cards/2C.png" class="card standard-card" id="2C">
        <img src="dependencies/images/cards/3C.png" class="card standard-card" id="3C">
        <img src="dependencies/images/cards/4C.png" class="card standard-card" id="4C">
        <img src="dependencies/images/cards/5C.png" class="card standard-card" id="5C">
        <img src="dependencies/images/cards/6C.png" class="card standard-card" id="6C">
        <img src="dependencies/images/cards/7C.png" class="card standard-card" id="7C">
        <img src="dependencies/images/cards/8C.png" class="card standard-card" id="8C">
        <img src="dependencies/images/cards/9C.png" class="card standard-card" id="9C">
        <img src="dependencies/images/cards/10C.png" class="card standard-card" id="10C">
        <img src="dependencies/images/cards/JC.png" class="card standard-card" id="JC">
        <img src="dependencies/images/cards/QC.png" class="card standard-card" id="QC">
        <img src="dependencies/images/cards/KC.png" class="card standard-card" id="KC">
    </div>

    <div class="row">
        <img src="dependencies/images/cards/AS.png" class="card standard-card" id="AS">
        <img src="dependencies/images/cards/2S.png" class="card standard-card" id="2S">
        <img src="dependencies/images/cards/3S.png" class="card standard-card" id="3S">
        <img src="dependencies/images/cards/4S.png" class="card standard-card" id="4S">
        <img src="dependencies/images/cards/5S.png" class="card standard-card" id="5S">
        <img src="dependencies/images/cards/6S.png" class="card standard-card" id="6S">
        <img src="dependencies/images/cards/7S.png" class="card standard-card" id="7S">
        <img src="dependencies/images/cards/8S.png" class="card standard-card" id="8S">
        <img src="dependencies/images/cards/9S.png" class="card standard-card" id="9S">
        <img src="dependencies/images/cards/10S.png" class="card standard-card" id="10S">
        <img src="dependencies/images/cards/JS.png" class="card standard-card" id="JS">
        <img src="dependencies/images/cards/QS.png" class="card standard-card" id="QS">
        <img src="dependencies/images/cards/KS.png" class="card standard-card" id="KS">
    </div>

    <br>
    <br>
    <button id="view-hands-btn"> View Hands </button>
</div>

</div>
<div id="view-hands">
    <table id="high_hand_table" class="high_hand">
        <thead>

            <th>Hand ID</th>
            <th>Date</th>
            <th>Name</th>
            <th>Hand</th>
            <th>Winner</th>

        </thead>
        <tbody>
        </tbody>
    </table>
    <br>
    <br>
    <button id="create-new-hand"> Create New Hand </button>
</div>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

<script src="dependencies/js/promotion/highhand.js"></script>
<script>

    getAllHands($("#promotion-view-modal").data('promo-id'));
    $('##promotion-view-modal').width="800px";
</script>
