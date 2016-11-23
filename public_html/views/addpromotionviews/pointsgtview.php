<form>
<div class="option-group">
    <input id="top-title-box" name="top-title-box" type="text" placeholder="Top Title">
    <br><br>
    <textarea id="top-content-box" name="top-content-box" placeholder="Enter Text"></textarea>
</div>

<br>

<div class="option-group">
    <input id="right-title-box" name="right-title-box" type="text" placeholder="Lower Right Title">
    <br><br>
    <textarea id="right-content-box" name="right-content-box" placeholder="Enter Text"></textarea>
</div>

<br>

<div class="option-group">
    <input id="left-content-box" name="left-content-box" type="text" placeholder="Lower Left Title">
    <br><br>
    <textarea id="left-title-box" name="left-title-box" placeholder="Enter Text"></textarea>
</div>

<br>

<div class="option-group">
    <label for="start-date">Start Date</label>
        <input id="start-date" name="start-date" type="date">
    <br><br>
    <label for="end-date">End Date</label>
        <input id="end-date" name="end-date" type="date">
</div>

<br><br>


    <label for="enable-instant-winners">Allow Instant Winners?</label>
        <input id="enable-instant-winners" name="enable-instant-winners" type="checkbox">
    <br><br>


    <div id="instant-winner-options" class="hidden">
        <br><br>

        <div class="option-group">
        <label for="enable-instant-winner1">Enable Instant Winner 1</label>
            <input id="enable-instant-winner1" name="enable-instant-winner1" type="checkbox">
        <br><br>

        <div>
            <input id="enable-instant-winner1-threshold" name="enable-instant-winner1-threshold" type="number" placeholder="Points Required">
        </div>

            <br><br>

            <input id="enable-instant-winner1-prize" name="enable-instant-winner1-prize" type="number" placeholder="Prize Value">
        </div>
            <br><br>



        <div class="option-group">
            <label for="enable-instant-winner2">Enable Instant Winner 2</label>
            <input id="enable-instant-winner2" name="enable-instant-winner2" type="checkbox">
        <br><br>


            <input id="enable-instant-winner2-threshold" name="enable-instant-winner2-threshold" type="number" placeholder="Points Required">
            <br><br>
            <input id="enable-instant-winner2-prize" name="enable-instant-winner2-prize" type="number" placeholder="Prize Value">
        </div>
            <br><br>


        <div class="option-group">
        <label for="enable-instant-winner3">Enable Instant Winner 3</label>
        <input id="enable-instant-winner3" name="enable-instant-winner3" type="checkbox">
        <br><br>


            <input id="enable-instant-winner3-threshold" name="enable-instant-winner3-threshold" type="number" placeholder="Points Required">
            <br><br>
            <input id="enable-instant-winner3-prize" name="enable-instant-winner3-prize" type="number" placeholder="Prize Value">
        </div>
            <br><br>

</div>
</form>
<script src="dependencies/js/promotion/pointsgt.js"></script>
