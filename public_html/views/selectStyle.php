<?php
/**
 * Created by PhpStorm.
 * User: zhydi
 * Date: 12/22/2016
 * Time: 1:22 AM
 */
?>

<div id="select-style">
        <label>Select a style to use for this promotion:</label> <br>
        <div class="option-group">
<?php
switch ($_POST['promotionTypeId']){
    case 1:

        ?>
            <input class="skin-radio" value="2" name="style_id" id="v2" type="radio" checked/>
            <img class="style-select" src="..\dependencies\images\screenshots\hhv1.png">

            <br/>
            <input class="skin-radio" value="7" name="style_id" id="v7" type="radio"/>
            <img class="style-select" src="..\dependencies\images\screenshots\hhv2.png">
            <br/>
            <input class="skin-radio" value="9" name="style_id" id="v9" type="radio"/>
            <img class="style-select" src="..\dependencies\images\screenshots\hhv3.png">
            <br/>
        <?php
        break;
    case 4:
        break;
    case 11:
        break;
}
?>
</div>

</div>
