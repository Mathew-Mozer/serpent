<?php
/**
 * This is the update kick for cash form
 */
?>

<div id="add-promotion">

    <table class="panel-collapse panel panel-default" style="border-style: solid">
        <tbody>
        <tr>
            <td style="padding: 0px" class="auto-style3">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>

                        <th>Name</th>
                        <th>Prize</th>
                        <th>Type/Name</th>
                        <th>Left Icon</th>
                        <th>Right Icon</th>

                        <th>Modify</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input type="hidden" ID="curID"/>
                            <input type="text" ID="pew_name" style="width: 125px"/></td>
                        <td>
                            <input type="text" ID="pew_prize" style="width: 125px"/></td>
                        <td>
                            <input type="text" ID="pew_type" style="width: 125px"/></td>
                        <td>
                            <select ID="pew_left_icon">
                                <option>None</option>
                                <option>Medal Gold</option>
                                <option>Medal Silver</option>
                                <option>Medal Bronze</option>
                            </select></td>
                        <td>
                            <select ID="pew_right_icon">
                                <option>None</option>
                                <option>Medal Gold</option>
                                <option>Medal Silver</option>
                                <option>Medal Bronze</option>
                            </select></td>

                        <td>
                            <button type="button" class="add-new-prize-event">Add</button>
                            <button type="button" class="cancel-new-prize-event">Cancel</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                        <table id="dltest" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Prize ID</th>
                                <th>Name</th>
                                <th>Prize</th>
                                <th>Type/Name</th>
                                <th>Left Icon</th>
                                <th>Right Icon</th>
                                <th>TimeStamp</th>
                                <th>Modify</th>
                            </tr>
                            </thead>
                            <tbody id="prizeeventbody">

                            </tbody>

                            </table>
    <script>

        loadPrizeWinners($("#promotion-view-modal").data('promo-id'));
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
