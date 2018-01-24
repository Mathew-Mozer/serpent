<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 5/25/2017
 * Time: 4:18 AM
 */


?>

<div id="add-promotion">
    <input type="hidden" id="promotionTypeName" name="kfc_promotionType" value="kickforcash">
    <input type="hidden" id="promotionTypeId" name="kfc_promotionTypeId" value="5">
    <br>
    <br>
    <div class="option-group">
        <label>Picture Slideshow Type</label>   <br/>


        <input class="high-hand-radio" value="0" name="picview_settings_type" id="holdem"

               type="radio"
               checked/>
        <label for="disabled"> Shows pictures only when scene displayed </label>
        <br/>
        <input class="high-hand-radio" value="1" name="picview_settings_type" id="paigow"
               type="radio" hidden/>
        <label for="previous" hidden> Shows pictures on every scene(Displays on top of other scenes)</label>
        <br/>
        <input type="checkbox" name="picview_settings_vertical"><label for="disabled"> Vertical Images </label><br>
        <br/>

        <br/>
    </div>
    <input type="hidden" id="scene-id" name="scene_id" value="5"/>
    <br>


</div>
<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime()?>"></script>
<?php
if(isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
    }
}

?>
