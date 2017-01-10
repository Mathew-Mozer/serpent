<?php
/**
 * This is the kick for cash form
 */
?>


<div id="add-promotion">
    <input type="hidden" id="promotionTypeName" name="kfc_promotionType" value="kickforcash">
    <input type="hidden" id="promotionTypeId" name="kfc_promotionTypeId" value="11">
    <br>
    <br>
    <div id="mmstep1">
        <div id="mulCont" class="container">
            <div class="row">
                <div class="col-sm-2">Quantity</div>
                <div class="col-sm-2">Multiplier</div>
            </div>
            <div class="row" id="ttlcnt">
                <div class="col-sm-2">
                    Total:
                    <div id="tpcount"></div>
                </div>
            </div>
            <table>
                <tr>
                    <td>Multiplier</td>
                    <td>Qty:</td>
                </tr>
                <tr>
                    <td>
                        <input onclick="this.select();" type="number" id="txtmul" value="0"/></td>
                    <td>
                        <input onclick="this.select();" onkeypress="return runAdd(event)" type="number" id="txtqty"/>
                    </td>
                    <td>
                        <button type="button" onclick="addToArray();" name="txtadd">Add</button>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>
<script>
    var arr = ["50", "50", "50", "40", "40", "40", "30", "30", "30", "30", "30", "30", "30", "25", "25", "25", "25", "25", "25", "25", "25", "25", "25", "25", "25", "25", "25", "25", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20"];
</script>


<input type="hidden" name="HiddenField1" id="HiddenField1"/>

<input type="hidden" id="scene-id" name="scene_id" value="11"/>
<br>

</div>

<!-- start item template -->
<div style="visibility: hidden" id="itmTemplate" class="row">
    <div class="col-sm-2">$qty$</div>
    <div class="col-sm-2">
        $mul$ &nbsp;
        <button type="button" onclick="removeVal($muls$)" class="close">&times;</button>
    </div>
</div>
<!-- end Template -->

<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime() ?>"></script>
<?php
if (isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
    }
}

?>
<script>
    $(function () {

        m2 = document.getElementById('mulCont');
        countMultipliers();
    });
</script>
