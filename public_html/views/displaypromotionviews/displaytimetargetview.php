<?php
/**
 * This is the update kick for cash form
 */
require "../../models/PromotionModel.php";
require_once("../../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");

//Create database connection object
$dbcon = NEW DbCon();

//Create models
$promotion = new PromotionModel($dbcon->read_database());
//echo(print_r($promotion->getPropertyInformation($_POST['promoid'])));

?>

<div id="add-promotion">

    <table class="table table-striped">
        <thead>
        <tr>
            <td>Seed</td>
            <td>Start</td>
            <td>Increment. Min.</td>
            <td>Add Amt.</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><input id="ttSeed" type="number" name="time_target_default_seed" value="500"></td>
            <td><input id="ttStart" class="filthypillow">

            </td>
            <td><input id="ttIncrementValue" name="time_target_default_Increment" type="number" value="60"></td>
            <td><input id="ttIncrementAmount" name="time_target_default_add_amt" type="number" value="100"></td>
            <td>
                <button type="button" class="add-new-timetarget"> Start New</button>
            </td>
        </tr>
        </tbody>
    </table>
    <input id="ttlockDef" name="time_target_lock_defaults" type="number" value="" hidden>
    <input id="ttlDefhour" name="time_target_def_hour" type="number" value="-1" hidden>
    <input id="ttDefmin" name="time_target_def_minute" type="number" value="-1" hidden>
    <input id="ttprog" name="time_target_progressive" type="number" value="0" hidden>

    <div style="height: 350px; width: 800px; overflow: auto">
    <table class="table table-striped">
        <thead>
        <tr>
            <td>ID</td>
            <td>Seed</td>
            <td>Start Time</td>
            <td>End Time</td>
            <td>Inc. Min.</td>
            <td>Add Amt</td>
            <td></td>
        </tr>
        </thead>
        <tbody id="timetrackerbody">

        </tbody>
    </table>
    </div>
    <script src="dependencies/js/promotion/formhelperfunctions.js"></script>
    <script>

        var d1 = moment().subtract( "seconds", 1 );
        var now =moment().subtract( "seconds", 1 );
        $( "#ttlockDef" ).bind("change paste keyup", function(){
            if($( "#ttlockDef" ).val()=="1"){
                $('#ttIncrementValue').attr('disabled', true);
                $('#ttIncrementAmount').attr('disabled', true);
                $('#ttSeed').attr('disabled', true);
                $('#ttStart').attr('disabled', true);
                if($('#ttlDefhour').val()>-1) {
                    d1.hour($('#ttlDefhour').val())
                }
                if($('#ttDefmin').val()>-1){
                    d1.minute($('#ttDefmin').val());
                }
                if(d1>now){
                    d1 = d1.subtract("days",1);
                    console.log("Time is later than now so I removed a day")
                }else{
                    console.log("Time was fine so I didn't remove a day")
                }
                console.log("disabled");
                enableFP();
            }else{

            }
        });
        getModalData($("#promotion-view-modal").data('promo-id'), 14)

    </script>
    <script>

        loadViewTimes($("#promotion-view-modal").data('promo-id'));
        var enableFP = function () {
            var $fp = $( ".filthypillow" ), now=moment().subtract( "seconds", 1 ) ;
            $fp.val(d1.format( "YYYY-MM-DD HH:mm:00") );
            $fp.filthypillow( {
                calendar: {
                    saveOnDateSelect: false,
                    isPinned: true
                },
                initialDateTime: function( m ) {
                    if($('#ttlDefhour').val()>-1){
                        m.hour($('#ttlDefhour').val())
                    }
                    if($('#ttDefmin').val()>-1){
                        m.minute($('#ttDefmin').val());
                    }
                    return m;
                }
            });
            $fp.on( "focus", function( ) {
                $fp.filthypillow( "show" );
            } );
            $fp.on( "fp:save", function( e, dateObj ) {
                $fp.val( dateObj.format( "YYYY-MM-DD HH:mm:00") );
                $fp.filthypillow( "hide" );
            } );

        }

    </script>
