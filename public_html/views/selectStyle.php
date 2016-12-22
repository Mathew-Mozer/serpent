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
            <label for="disabled"> Version 1</label>
            <br/>
            <input class="skin-radio" value="7" name="style_id" id="v7" type="radio"/>
            <label for="previous"> Version 2 </label>
            <br/>
            <input class="skin-radio" value="9" name="style_id" id="v9" type="radio"/>
            <label for="ranked"> Version 3 </label>
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
