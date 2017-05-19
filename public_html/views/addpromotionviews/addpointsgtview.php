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
                <input id="payout" name="pgt_payout" type="text" placeholder="Payout">

                <br><br>
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
                    <option value="2">Baseball</option>
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
                            <td><input class="pgt-instant-winner" id="enable-instant-winner1-prize" name="pgt_prize_amount1" type="number" min="0"
                                       placeholder="25"></td>
                            <td><input class="pgt-instant-winner" id="enable-instant-winner1-threshold" name="pgt_points1" type="number" min="0"
                                       placeholder="250"></td>
                            <td><input name="pgt_color1" type="text" class="spectrumcl" id="pgt_color1" style="width:75px;"/></td>
                        </tr>
                        <tr>
                            <td> <input name="pgt_instant_winner_id2" type="hidden"><input id="pgt_enable_instant_winner2" name="pgt_enable_instant_winner2" type="checkbox"></td>
                            <td><input class="pgt-instant-winner" id="enable-instant-winner2-prize" name="pgt_prize_amount2" type="number" min="0"
                                       placeholder="50"></td>
                            <td><input class="pgt-instant-winner" id="enable-instant-winner2-threshold" name="pgt_points2" type="number" min="0"
                                       placeholder="500"></td>
                            <td><input name="pgt_color2" type="text" class="spectrumcl" id="pgt_color2" style="width:75px;"/>
                                </td>
                        </tr>
                        <tr>
                            <td><input name="pgt_instant_winner_id3" type="hidden"><input id="pgt_enable_instant_winner2" name="pgt_enable_instant_winner3" type="checkbox"></td>
                            <td><input class="pgt-instant-winner" id="enable-instant-winner3-prize" name="pgt_prize_amount3" type="number" min="0"
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
    var $fp1 = $( "#start-date" ),
        now = moment( ).subtract( "seconds", 1 );
    $fp1.val( moment().format( "YYYY-MM-DD HH:mm:00") );
    $fp1.filthypillow( {
        calendar: {
            saveOnDateSelect: true,
            isPinned: true

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
        now = moment( ).subtract( "seconds", 1 );
    $fp2.val( moment().format( "YYYY-MM-DD HH:mm:00") );
    $fp2.filthypillow( {
        calendar: {
            saveOnDateSelect: true,
            isPinned: true

        }
    });
    $fp2.on( "focus", function( ) {
        $fp2.filthypillow( "show" );
    } );
    $fp2.on( "fp:save", function( e, dateObj ) {
        $fp2.val( dateObj.format( "YYYY-MM-DD HH:mm:00") );
        $fp2.filthypillow( "hide" );
    } );
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

