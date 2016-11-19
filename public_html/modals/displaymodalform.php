<?php
require "../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../models/PromotionModel.php";
require "../models/PropertyDisplays.php";
$dbcon = new DBCon();
 ?>
<ul id="errorMessage" hidden></ul>

<?php
$displayOptions = new PromotionModel($dbcon->read_Database());
$displayProperties = new PropertyDisplays($dbcon->read_Database(), $_POST['propertyId']);
$display = $displayProperties->getDisplayWithId($_POST['displayId']);
$displayPromotions = $displayOptions->getAllPromotionsByProperty($_POST['propertyId']);
?>

<form>
    <div id="display-id-form" hidden data-display-id="<?php echo $_POST['displayId']; ?>"></div>
    <div id="property-id-form" hidden data-property-id="<?php echo $_POST['propertyId']; ?>"></div>
    <?php
    foreach ($displayPromotions as $row) {

        $checked = $row['display_id']==$_POST['displayId'] ? 'checked' : '';
        echo '<img class=checkbox-image src="dependencies/images/' . $row['promo_image'] . '"> &nbsp';
        echo "<input type='checkbox' class='promotions-in-display' data-display-id='{$row["display_id"]}' name='promotion' $checked value='{$row["promo_id"]}'>{$row["promo_title"]} <br>";
    }
    ?>


</form>

<hr>

<form class="form-horizontal" method="post">

        <input type="text" name="displayName" value='<?php echo $display->getName() ?>'> <p>Display Name</p><br>
        <input type="text" name="displayLocation" value='<?php echo $display->getDisplayLocation() ?>'> <p>Display Location</p>

</form>
