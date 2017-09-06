<?php
?>


<div id="add-promotion" data-promo-id="<?php echo($_POST['promotion_id'])?>">
    <br>
    <br>
    <div id="mmstep1">
        <table id="mulCont" class="mmtable" style="text-align: center">
            <tr>
                <td style="font-weight: bolder">Quantity</td>
                <td style="font-weight: bolder">Value</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">
                <table width="100%" id="playerlist">
                    <tr>
                        <td colspan="3" style="text-align: center"> Please enter values.</td>
                    </tr>
                </table>
                </td>
            </tr>
            <tr id="ttlcnt">
                <td colspan="3">
                    <div style="font-weight: bolder" id="mmtpcount"></div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table id="addMMValues">
                        <tr>
                            <td>Quantity</td>
                            <td>Value</td>
                        </tr>
                        <tr>
                            <td>
                                <input onclick="this.select();" type="number" value="1" id="txtqty"/>
                            </td>
                            <td>
                                <input onclick="this.select();" type="text" id="txtmul"/></td>
                            <td>
                                <button type="button" id="addToMMArray" name="txtadd">Add</button>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
    </div>
    <input type="hidden" id="scene-id" name="scene_id" value="13">
    <input type="hidden" id="multi_madness_started" name="multi_madness_started" disabled>
    <input type="text" name="multi_madness_values" id="multi_madness_values"/>
    <button type="button" id="startMMSession" name="startMMSession">Start Session</button>
    <p id="startSessionMessage" hidden>
        Your session has started and can't be modified. If this is an error please contact support.
    </p>
</div>
<script>
    var arr = ["50", "50", "50", "40", "40", "40", "30", "30", "30", "30", "30", "30", "30", "25", "25", "25", "25", "25", "25", "25", "25", "25", "25", "25", "25", "25", "25", "25", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20", "20"];
</script>

</div>

<!-- start item template -->
<script type="text/html" id="playerTemplate">
<tr>
        <td data-content-text="Qty"></td>
        <td data-content-text="Value"></td>
        <td  style="display: block;margin: auto;">
            <button data-template-bind='[{"attribute": "data-val", "value": "Value"}]' id="removeFromMMArray"
                    type="button" class="close mmclose">&times;</button>
        </td>
</tr>
</script>

<!-- end Template -->

<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime() ?>"></script>
<?php
if (isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");
        
        </script>";
    }
}

?>
<script>
    $(function () {
        m2 = document.getElementById('mulCont');
        countMMMultipliers();
    });
</script>
