<?php
require "../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../models/DisplayModel.php";
require "../models/CasinoBoxes.php";
$dbcon = new DBCon();
 ?>
<ul id="errorMessage" hidden></ul>

<?php
$displayOptions = new DisplayModel($dbcon->read_Database());
$displayCasinos = new CasinoBoxes($dbcon->read_Database(), $_POST['casinoId']);
$display = $displayCasinos->getBoxWithId($_POST['displayId']);
$displayPromotions = $displayOptions->getAllPromotionsByCasino($_POST['casinoId']);
?>

<form>
    <div id="display-id-form" hidden data-display-id="<?php echo $_POST['displayId']; ?>"></div>
    <div id="casino-id-form" hidden data-casino-id="<?php echo $_POST['casinoId']; ?>"></div>
    <?php
    foreach ($displayPromotions as $row) {
        $checked = $row['display_id']==$_POST['displayId'] ? 'checked' : '';
        echo $row['display_id'] ."==" .$_POST['displayId'];
        echo "<input type='checkbox' class='promotions-in-display' data-display-id='{$row["display_id"]}' name='promotion' $checked value='{$row["promo_id"]}'>{$row["promo_title"]} <br>";
    }
    ?>


</form>

<hr>

<form class="form-horizontal" method="post">

        <input type="text" name="displayName" value='<?php echo $display->getName() ?>'> <p>Display Name</p><br>
        <input type="text" name="displayLocation" value='<?php echo $display->getDisplayLocation() ?>'> <p>Display Location</p>

</form>
