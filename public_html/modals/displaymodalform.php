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
    ?>
        <div class="form-group">
            <?php
            $checked = $row['display_id']==$_POST['displayId'] ? 'checked' : '';
            echo '<img class=checkbox-image src="dependencies/images/' . $row['promo_image'] . '"> &nbsp';
            echo "<input type='checkbox'  class='promotions-in-display' id='{$row['promo_id']}' data-display-id='{$row["display_id"]}' 
                    name='promotion' $checked value='{$row["promo_id"]}'> 
                    <label class='display-modal-checkbox'>{$row["promo_title"]} </label>";
            ?>
            <span id="<?php echo 'scene-input-'.$row['promo_id'] ?>" <?php if($checked != 'checked'){ echo 'hidden';} ?>>
            <label class="display-modal-label">Scene Duration </label>
            <input class="display-modal-scene-input" type="number"
                   id="<?php echo 'scene-duration-'.$row['promo_id'];?>" value="<?php echo $row['scene_duration']?>">
            </span>
        </div>
    <?php }
    ?>

</form>

<hr>

<form class="form-horizontal" method="post">

        <input type="text" name="displayName" value='<?php echo $display->getName() ?>'> <p>Display Name</p><br>
        <input type="text" name="displayLocation" value='<?php echo $display->getDisplayLocation() ?>'> <p>Display Location</p>

</form>
<script>
    $('.promotions-in-display').click(function () {
        if(this.checked) {
            $('#scene-input-'+this.id).show();
        } else {
            $('#scene-input-'+this.id).hide();
        }
    });
</script>