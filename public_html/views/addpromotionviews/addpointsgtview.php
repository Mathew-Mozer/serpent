<?php
/**
 * This is the pointsGT form
 */
?>


<div id="add-promotion">
    <table>
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <input type="hidden" name="promotionTypeName" value="poinstgt">
                <input type="hidden" id="promotionTypeId" name="pgt_promotionTypeId" value="4">
                <label for="top-title-box">Top Title</label><br>
                <input id="top-title-box" name="pgt_title" type="text" placeholder="Top Title">
                <br>
                <br>
                <label for="top-content-box">Top Content</label><br>
                <textarea class="pointsgt-textarea" id="top-content-box" name="pgt_subtitle" placeholder="Top Content"></textarea>
                <br>
                <br>
                <label for="left-title-box">Left Title</label><br>
                <input id="left-title-box" name="pgt_left_title" type="text" placeholder="Left Title">
                <br>
                <br>
                <label for="left-content-box">Left Content</label><br>
                <textarea class="pointsgt-textarea" id="left-content-box" name="pgt_left_content" placeholder="Left Content"></textarea>

                <br><br>
                <label for="right-title-box">Right Title</label><br>
                <input id="right-title-box" name="pgt_right_title" type="text" placeholder="Right Title">

                <br><br>
                <label for="right-content-box">Right Text</label><br>
                <textarea class="pointsgt-textarea" id="right-content-box" name="pgt_right_content" type="text"
                          placeholder="Right Content"></textarea>

            </td>
            <td style="vertical-align: top; width: 50%;">
                <label for="payout">Payout Value</label><br>
                <input id="payout" class="csvToList" name="pgt_payout" type="text" placeholder="Payout">

                <br><br>

                <button id="btnminusDayPGT" type="button">-</button><button id="btnAddDayPGT" type="button">+</button><button id="btnAddDaysPGT" type="button">+7</button>

                <label for="start-date">Starts</label><br>
                <input id="start-date" class="filthypillow" name="pgt_race_begin">

                <br><br>
                <label for="end-date">Ends</label><br>
                <input id="end-date" class="filthypillow" name="pgt_race_end">
                <br><br>
                <label for="end-date">Theme</label><br><br>
                <Select id="pgt-atlas" name="pgt_atlas">
                    <option value="0">Race Cars</option>
                    <option value="1">Chinese Dragon</option>
                    <option value="6">Chinese New Year 2018</option>
                    <option value="2">Baseball</option>
                    <option value="3">Motorcycles</option>
                    <option value="4">Chip Drop</option>
                    <option value="5">Christmas Points Only</option>
                </Select>


                <br><br>
                <input id="pgt_enable_instant_winners" name="pgt_enable_instant_winners" type="checkbox"><label>Allow
                    Instant
                    Winners?</label>
                <br><br>
                <script src="dependencies/js/jscolor.js"></script>
                <div id="instant-winner-options" style="display: none">

                    <table>
                        <thead>
                        <td></td>
                        <td>Prize</td>
                        <td>Points</td>
                        <td>Color</td>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input name="pgt_instant_winner_id1" type="hidden"><input id="pgt_enable_instant_winner1" name="pgt_enable_instant_winner1" type="checkbox"></td>
                            <td><input class="pgt-instant-winner" id="enable-instant-winner1-prize" name="pgt_prize_amount1" type="text" min="0"
                                       placeholder="25"></td>
                            <td><input class="pgt-instant-winner" id="enable-instant-winner1-threshold" name="pgt_points1" type="number" min="0"
                                       placeholder="250"></td>
                            <td><input name="pgt_color1" type="text" class="spectrumcl" id="pgt_color1" style="width:75px;"/></td>
                        </tr>
                        <tr>
                            <td> <input name="pgt_instant_winner_id2" type="hidden"><input id="pgt_enable_instant_winner2" name="pgt_enable_instant_winner2" type="checkbox"></td>
                            <td><input class="pgt-instant-winner" id="enable-instant-winner2-prize" name="pgt_prize_amount2" type="text" min="0"
                                       placeholder="50"></td>
                            <td><input class="pgt-instant-winner" id="enable-instant-winner2-threshold" name="pgt_points2" type="number" min="0"
                                       placeholder="500"></td>
                            <td><input name="pgt_color2" type="text" class="spectrumcl" id="pgt_color2" style="width:75px;"/>
                                </td>
                        </tr>
                        <tr>
                            <td><input name="pgt_instant_winner_id3" type="hidden"><input id="pgt_enable_instant_winner2" name="pgt_enable_instant_winner3" type="checkbox"></td>
                            <td><input class="pgt-instant-winner" id="enable-instant-winner3-prize" name="pgt_prize_amount3" type="text" min="0"
                                       placeholder="75"></td>
                            <td><input class="pgt-instant-winner" id="enable-instant-winner3-threshold" name="pgt_points3" type="number" min="0"
                                       placeholder="750"></td>
                            <td><input name="pgt_color3" type="text" class="spectrumcl" id="pgt_color3" style="width:75px;" value="#440000"/>
                                </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>


    <input type="hidden" id="scene-id" name="scene_id" value="4">
    <input type="hidden" id="scene-id" name="updateSettings" value="true">
</div>
<script>
    $('#pgt_enable_instant_winners').change(function () {
        if ($('#pgt_enable_instant_winners').is(':checked')) {
            $('#instant-winner-options').show();
        } else {
            $('#instant-winner-options').hide();
        }
    });
    //first fp
    var enableFP = function () {
        changeCSVToList();
        var $fp1 = $( "#start-date" ),
            now = moment().subtract( "seconds", 1 );
        $fp1.val( moment($( "#start-date" ).val()).format( "YYYY-MM-DD HH:mm:00") );
        $fp1.filthypillow( {
            calendar: {
                saveOnDateSelect: false,
                isPinned: true

            },
            initialDateTime: function( m ) {

                return moment($( "#start-date" ).val());
            }
        });
        $fp1.on( "focus", function( ) {
            $fp1.filthypillow( "show" );
        } );
        $fp1.on( "fp:save", function( e, dateObj ) {
            $fp1.val( dateObj.format( "YYYY-MM-DD HH:mm:00") );
            $fp1.filthypillow( "hide" );
        } );
        //second fp
        var $fp2 = $( "#end-date" ),
            now = moment().subtract( "seconds", 1 );
        $fp2.val( moment($( "#end-date" ).val()).format( "YYYY-MM-DD HH:mm:00") );
        $fp2.filthypillow( {
            calendar: {
                saveOnDateSelect: false,
                isPinned: true

            },
            initialDateTime: function( m ) {

                return moment($( "#end-date" ).val());
            }
        });
        $fp2.on( "focus", function( ) {
            $fp2.filthypillow( "show" );
        } );
        $fp2.on( "fp:save", function( e, dateObj ) {
            $fp2.val( dateObj.format( "YYYY-MM-DD HH:mm:00") );
            $fp2.filthypillow( "hide" );
        } );


    }



</script>
<script>
    $(".csvToList").toggle(true);

    var changeCSVToList = function () {
      /*
        var replaced = $(".csvToList");
        if($("div[convertedid='"+$(replaced).attr("id")+"']").length==0) {
            console.log("Converting now")
            var parentDiv = $(".csvToList").parent();
            replaceContent(replaced);
            var itm2 ="<table style='width:350px '><tr><td>Option 1</td><td>Option 2</td><td></td></tr>";
            itm2 +="<tr><td><input type='text' placeholder='Option 1'> </td><td><input type='text' placeholder='Option 1'> </td><td><button type=\"button\" class=\"btn btn-success\">+</button></td></tr>"
            itm2 +="</table>"
            $(itm2).insertBefore(replaced)
        }
        $(document).on("click", ".btnDeleteEntry", function () {
            console.log('Click Delete')
            $(this).parent().parent().remove()
        });
*/
    }
    var replaceContent = function (replaced) {
        var array = $('.csvToList').val().split(",");
        var itmText="<table style='width:350px '><tr><td>Order</td><td>Opt. 1</td><td>Option 2</td><td></td></tr>";
        console.log("Array:" + array.length)
        for (var i = 0; i < array.length; i++) {
            var indItm = array[i].split(";");
            console.log("len:" + indItm.length)
            if(indItm.length==1){
                indItm.push("&lt;none&gt;")
            }else{

            }
            itmText += "<tr><td>"+ parseInt(i+1) + " - </td><td>&nbsp;" + indItm[0] + "</td><td>"+indItm[1]+"</td><td><button type='button' class='btn btn-sm btn-danger btnDeleteEntry'>X</button></td></tr>";
        }
        var itm = "<div convertedID='" + $(replaced).attr("id") + "' style='width: 400px; height: 110px;overflow: auto;'>" +
            itmText;
        itm +="</div>"
        $(itm).insertBefore(replaced)
    }
</script>
<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime() ?>"></script>

<?php
if (isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
        echo "<script>
 
</script>";
    }
}
?>

