<div id="add-promotion">
<input type="hidden" name="promotionType" value="poinstgt"></input>
<input id="top-title-box" name="pgt_title" type="text" placeholder="Promotion Title"></input>
<br><br>
<input id="left-title-box" name="pgt_left_title" type="text" placeholder="Information Title"></input>
<br><br>
<input id="right-title-box" name="pgt_right_title" type="text" placeholder="Rules Title"></input>
<br><br>
<input id="top-content-box" name="pgt_subtitle" type="text" placeholder="Promotion Text"></input>
<br><br>
<input id="right-content-box" name="pgt_right_content" type="text" placeholder="Rules Text"></input>
<br><br>
<input id="left-content-box" name="pgt_left_content" type="text" placeholder="Information Text"></input>
<br><br>
<input id="payout" name="pgt_payout" type="text" placeholder="Payout"></input>
<br><br>
<input id="start-date" name="pgt_race_begin" type="date"></input>
<br><br>
<input id="end-date" name="pgt_race_end" type="date"></input>
<br><br>
<input id="enable-instant-winners" name="enable-instant-winners" type="checkbox">Allow Instant Winners?</input>
<br><br>

<div id="instant-winner-options" class="hidden">
    <input id="enable-instant-winner1" name="enable-instant-winner1" type="checkbox">Enable Instant Winner 1</input>
    <br><br>
        <div>
            <input id="enable-instant-winner1-threshold" name="pgt_points1" type="number" placeholder="250"></input>
            <br><br>
            <input id="enable-instant-winner1-prize" name="pgt_prize_amount1" type="number" placeholder="25"></input>
            <br><br>
        </div>
    <input id="enable-instant-winner2" name="enable-instant-winner2" type="checkbox">Enable Instant Winner 2</input>
    <br><br>
    <div>
        <input id="enable-instant-winner2-threshold" name="pgt_points2" type="number" placeholder="500"></input>
        <br><br>
        <input id="enable-instant-winner2-prize" name="pgt_prize_amount2" type="number" placeholder="50"></input>
        <br><br>
    </div>
    <input id="enable-instant-winner3" name="enable-instant-winner3" type="checkbox">Enable Instant Winner 3</input>
    <br><br>
    <div>
        <input id="enable-instant-winner3-threshold" name="pgt_points3" type="number" placeholder="750"></input>
        <br><br>
        <input id="enable-instant-winner3-prize" name="pgt_prize_amount3" type="number" placeholder="75"></input>
        <br><br>
    </div>

</div>
</div>
<script src="dependencies/js/promotion/formhelperfunctions.js"></script>
<script>
  getModalData($("#promotion-view-modal").data('promo-id'),11);
</script>
