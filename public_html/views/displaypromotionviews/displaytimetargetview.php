<?php
/**
 * This is the update kick for cash form
 */
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
            <td><input id="ttSeed" type="number" value="500"></td>
            <td><input id="ttStart" class="filthypillow">

            </td>
            <td><input id="ttIncrementValue" type="number" value="60"></td>
            <td><input id="ttIncrementAmount" type="number" value="100"></td>
            <td>
                <button type="button" class="add-new-timetarget"> Start New</button>
            </td>
        </tr>
        </tbody>
    </table>
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
    <script>

        loadViewTimes($("#promotion-view-modal").data('promo-id'));
        var $fp = $( ".filthypillow" ),
            now = moment( ).subtract( "seconds", 1 );
        $fp.val( moment().format( "YYYY-MM-DD HH:mm:00") );
        $fp.filthypillow( {
            calendar: {
                saveOnDateSelect: true,
                isPinned: true

            }
        });
        $fp.on( "focus", function( ) {
            $fp.filthypillow( "show" );
        } );
        $fp.on( "fp:save", function( e, dateObj ) {
            $fp.val( dateObj.format( "YYYY-MM-DD HH:mm:00") );
            $fp.filthypillow( "hide" );
        } );

    </script>
