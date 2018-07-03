<?php
require "../../models/PromotionModel.php";
require_once("../../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");

//Create database connection object
$dbcon = NEW DbCon();

//Create models
$promotion = new PromotionModel($dbcon->read_database());
$properties = $promotion->getAssignableProperties();
?>


<div id="add-promotion">
<input type="hidden" id="promotionTypeName" name="tt_promotionType" value="timetarget">
<input type="hidden" id="promotionTypeId" name="tt_promotionTypeId" value="23">
<br>
<br>
<label>Title Text</label>
<TextArea type="text" value="" name="time_target_title"></TextArea>
    <label>Content Title</label>
    <input type="text" value="" name="time_target_contenttitle"><br>
<label>content</label>
    <textarea name="time_target_content"></textarea><br>
    <label>Change Card Randomly</label>
    <input type="checkbox" name="time_target_randomcard"><br>
    <label>cards</label>
    <select name="time_target_valoption">
        <option value="0">Use Suit and Value</option>
        <option value="1">Use Suit</option>
        <option value="2">Use Value</option>
    </select><br>
    <label>cards</label>
    <select name="time_target_cards">
        <option value="PC">Use Parent Card</option>
        <option value="AH">Ace of Hearts</option>
        <option value="2H">2 of Hearts</option>
        <option value="3H">3 of Hearts</option>
        <option value="4H">4 of Hearts</option>
        <option value="5H">5 of Hearts</option>
        <option value="6H">6 of Hearts</option>
        <option value="7H">7 of Hearts</option>
        <option value="8H">8 of Hearts</option>
        <option value="9H">9 of Hearts</option>
        <option value="10H">10 of Hearts</option>
        <option value="JH">Jack of Hearts</option>
        <option value="QH">Queen of Hearts</option>
        <option value="KH">King of Hearts</option>
        <option value="AC">Ace of Clubs</option>
        <option value="2C">2 of Clubs</option>
        <option value="3C">3 of Clubs</option>
        <option value="4C">4 of Clubs</option>
        <option value="5C">5 of Clubs</option>
        <option value="6C">6 of Clubs</option>
        <option value="7C">7 of Clubs</option>
        <option value="8C">8 of Clubs</option>
        <option value="9C">9 of Clubs</option>
        <option value="10C">10 of Clubs</option>
        <option value="JC">Jack of Clubs</option>
        <option value="QC">Queen of Clubs</option>
        <option value="KC">King of Clubs</option>
        <option value="AD">Ace of Diamonds</option>
        <option value="2D">2 of Diamonds</option>
        <option value="3D">3 of Diamonds</option>
        <option value="4D">4 of Diamonds</option>
        <option value="5D">5 of Diamonds</option>
        <option value="6D">6 of Diamonds</option>
        <option value="7D">7 of Diamonds</option>
        <option value="8D">8 of Diamonds</option>
        <option value="9D">9 of Diamonds</option>
        <option value="10D">10 of Diamonds</option>
        <option value="JD">Jack of Diamonds</option>
        <option value="QD">Queen of Diamonds</option>
        <option value="KD">King of Diamonds</option>
        <option value="AD">Ace of Spades</option>
        <option value="2S">2 of Spades</option>
        <option value="3S">3 of Spades</option>
        <option value="4S">4 of Spades</option>
        <option value="5S">5 of Spades</option>
        <option value="6S">6 of Spades</option>
        <option value="7S">7 of Spades</option>
        <option value="8S">8 of Spades</option>
        <option value="9S">9 of Spades</option>
        <option value="10S">10 of Spades</option>
        <option value="JS">Jack of Spades</option>
        <option value="QS">Queen of Spades</option>
        <option value="KS">King of Spades</option>
    </select><br>
    <label>Max Payout</label>
    <input type="text" value="50" name="time_target_maxpayout"><br>
    <label>Don't allow starting new</label>
    <input type="checkbox" name="time_target_nostartnew"><br>
    <label>Multiply Other Promo Payout</label>
    <input type="checkbox" id="time_target_usemult" name="time_target_usemult"><br>
    <div id="timeTargetstandard">
        <label>Default Start Time</label>
        <select name="time_target_def_hour">
            <option value="-1">Current</option>
            <option value="0">12am</option>
            <option value="1">1am</option>
            <option value="2">2am</option>
            <option value="3">3am</option>
            <option value="4">4am</option>
            <option value="5">5am</option>
            <option value="6">6am</option>
            <option value="7">7am</option>
            <option value="8">8am</option>
            <option value="9">9am</option>
            <option value="10">10am</option>
            <option value="11">11am</option>
            <option value="12">12pm</option>
            <option value="13">1pm</option>
            <option value="14">2pm</option>
            <option value="15">3pm</option>
            <option value="16">4pm</option>
            <option value="17">5pm</option>
            <option value="18">6pm</option>
            <option value="19">7pm</option>
            <option value="20">8pm</option>
            <option value="21">9pm</option>
            <option value="22">10pm</option>
            <option value="23">11pm</option>
        </select>
        <select name="time_target_def_minute">
            <option value="-1">Current</option>
            <option value="0">00</option>
            <option value="15">15</option>
            <option value="30">30</option>
            <option value="45">45</option>
        </select><br>
        <label>Default Seed</label>
        <input type="text" value="100" name="time_target_default_seed"><br>
        <label>Default increment time (Minutes)</label>
        <input type="text" value="50" name="time_target_default_Increment"><br>
        <label>How much to add?</label>
        <input type="text" value="50" name="time_target_default_add_amt"><br>
        <label>Progressive by time?</label>
        <input type="checkbox" name="time_target_progressive"><br>
        <label>Lock Defaults</label>
        <input type="checkbox" name="time_target_lock_defaults"><br>
    </div>
    <div id="timeTargetmultiplier">
        <label>Linked Jackpot Promo</label>
        <select name="time_target_multpromoid">

        <?php
        $promocnt=0;
        foreach ($properties as $property) {
        foreach ($promotion->getAllPromotionsByProperty($property["property_id"], "14",1) as $promo) {
        if ($promo["promotion_id"] != $_POST['promotion_id']) {

        ?>

            <option value="<?php echo($promo["promotion_id"])?>" <?php if($promocnt==0)echo("selected=\"selected\"")?>>
<?php
                if (trim($promo["promotion_label"]) == "") {
                    echo($promo["promotion_id"].'-'.$promo["promotion_type_title"]);
                } else {
                    echo($promo["promotion_id"].'-'.$promo["promotion_label"]);
                }
                ?> </option>
        <?php
            $promocnt++;
                }
            }
        }
        ?>

        </select><br>
        <label>Multiplier</label>
        <input type="number" value="2" name="time_target_multiplier"><br>
        <br>
        <input type="hidden" name="time_target_lastcardchange" value=""/>
        <input type="hidden" id="scene-id" name="scene_id" value="14"/>
<br>
    </div>
</div>
<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime()?>"></script>
<script>
    $("#timeTargetmultiplier").toggle(false)
    $( "#time_target_usemult" ).bind("change", function(){
        checkchange($("#time_target_usemult").is(':checked'))
    });
    function checkchange(){
        console.log("test: "+$("#time_target_usemult").is(':checked'))
        if($("#time_target_usemult").is(':checked')) {

$("#timeTargetmultiplier").toggle(true)
            $("#timeTargetstandard").toggle(false)
        }else{
            $("#timeTargetmultiplier").toggle(false)
            $("#timeTargetstandard").toggle(true)
        }
    }
    var enableFP = function () {
        checkchange($('#time_target_usemult').checked)
    }
</script>
<?php
if(isset($_POST['promotion_settings'])) {
    //echo('promoid: '.$_POST['promotion_id']);
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
    }
}

?>