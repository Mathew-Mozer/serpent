<?php
/**
 * This is the update pointsGT form
 */
?>
<label for="add-promotion">Edit Player Points</label>
<style>
    .RedCircle{
        color: red;
    }
    .GreenCircle{
        color: green;
    }

</style>
<div id="add-promotion">
    <input type="text" value="0" name="pgt_race_begin" id="pgt_race_begin" hidden>
    <input type="text" value="0" name="pgt_race_end" id="pgt_race_end" hidden>
    <input type="text" value="0" name="playerCount" id="playerCount" hidden>
    <?php

    switch ($_POST['pointstorage']) {
    case 0:
        echo '<script>$("#playerCount").val("20")</script>';
        ?>
        <button type="button" id="btnClearPlayers">Clear Players</button>

        <table class=".table-striped">
            <tr>
                <td>
<table class="table table-striped">
                    <?php
                    for ($i = 1; $i <= 20; $i++) {
                        echo("<tr><td>");
                        ?>
                        <div class="">&nbsp;<?php echo $i; ?> &nbsp; <input type="hidden"
                                                                                       id="txtID<?php echo $i; ?>"
                                                                                       name="pgt_player_id<?php echo $i; ?>"><input
                                type="text" id="txtName<?php echo $i; ?>"
                                name="pgt_player_name<?php echo $i; ?>"><input id="txtPoints<?php echo $i; ?>"
                                                                               type="number" min="0"
                                                                               name="pgt_current_points<?php echo $i; ?>">
                        </div>

                    <?php
                    echo("</tr></td>");
                    } ?></table>
                </td>
                <td style="vertical-align: top"> <div class="center">
                        <h4>Copy and Paste Report</h4>
                        <textarea id="TextBox1" name="pastedReport" cols="25" placeholder="Copy and Paste Report" onchange="//myHandler()"
                                  onkeypress="this.onchange();" oninput="this.onchange();" onchange="//myHandler();"
                                  onpaste="this.onchange();"></textarea>
                    </div>
                    <div>
                        <table class="table" style="width: 200px">
                            <tr>Report Verification</tr>
                            <tr><td><span id="chkBeginDate" class="glyphicon glyphicon-remove-circle RedCircle">&nbsp;</span> Begin Date<br> <span id="correctBeginDate"></span></td></tr>
                            <tr><td><span  id="chkBeginTime" class="glyphicon glyphicon-remove-circle  RedCircle">&nbsp;</span> Begin Time <br><span id="correctBeginTime"></span></td></tr>
                            <tr><td><span id="chkEndDate" class="glyphicon glyphicon-remove-circle RedCircle">&nbsp;</span> End Date<br><span id="correctEndDate"></span></td><tr><td><span  id="chkEndTime" class="glyphicon glyphicon-remove-circle RedCircle">&nbsp;</span> End Time <br> <span id="correctEndTime"></span></td></tr>
                        </table>
                    </div>

                </td>
            </tr>
        </table>
        </div>
    <br>
    <hr>

    <?php
    break;
    case 1:
    ?>
        <script>
            $(".ui-dialog-buttonset").toggle(false);
        </script>
        <table>
            <tr>
                <td style="vertical-align: top">
                    Click points to modify
                    <table>
                        <tr>
                            <td>
                                <div class="newPlayer">
                                    <input type="text" value="" id="pgt_player_newname">
                                    <button type="button" class="btn btn-lg btn-info btn-new-player">Add Player
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div id="playerlist" width="450px"
                                     style="vertical-align: top; overflow: scroll; height: 500px">

                                </div>
                            </td>
                        </tr>

                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table id="pulltab-button-layout" hidden>
                        <tr>
                            <td>
                                <span id="pgtoperator">+</span><span id="newpoints"
                                                                     style="font-size: x-large">0</span></td>
                        </tr>
                        <tr>

                            <td type="button" class="btn btn-lg btn-info  pull-tab-button-calc-add">7</td>
                            <td type="button" class="btn btn-info btn-lg pull-tab-button-calc-add">8</td>
                            <td type="button" class="btn btn-info btn-lg pull-tab-button-calc-add">9</td>

                        <tr>

                            <td type="button" class="btn btn-info  btn-lg pull-tab-button-calc-add">4</td>
                            <td type="button" class="btn btn-info btn-lg pull-tab-button-calc-add">5</td>
                            <td type="button" class="btn btn-info btn-lg pull-tab-button-calc-add">6</td>
                        </tr>
                        <tr>
                            <td type="button" class="btn btn-info btn-lg pull-tab-button-calc-add">1</td>
                            <td type="button" class="btn btn-info btn-lg pull-tab-button-calc-add">2</td>
                            <td type="button" class="btn btn-info btn-lg pull-tab-button-calc-add">3</td>
                        </tr>
                        <tr>
                            <td type="button" class="btn btn-info btn-lg pull-tab-button-calc-add">0</td>
                            <td type="button" class="btn btn-info btn-lg pull-tab-button-minus">-</td>

                        </tr>
                        <tr>
                            <td>

                        <tr hidden>
                            <td colspan="3" style="text-align: center">&nbsp;Quick Add Points</td>
                        </tr>
                        <tr hidden>
                            <td class="btn btn-info btn-lg pull-tab-button-quick-add">25</td>
                            <td class="btn btn-info btn-lg pull-tab-button-quick-add">100</td>
                            <td class="btn btn-info btn-lg pull-tab-button-quick-add">33</td>
                        </tr>
                        <tr hidden>
                            <td class="btn btn-info btn-lg pull-tab-button-quick-add">66</td>
                            <td class="btn btn-info btn-lg pull-tab-button-quick-add">99</td>
                            <td class="btn btn-info btn-lg pull-tab-button-quick-add">250</td>
                        </tr>
                        <tr>
                            <td class="btn btn-success btn-lg pull-tab-button pull-tab-button-commit"
                                style="text-align: center"
                                colspan="2">Apply
                            </td>
                            <td class="btn btn-danger btn-lg pull-tab-button pull-tab-button-cancel">Cancel</td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
    <br>
        <?php
        break;
    }
    ?>
</div>
<script type="text/html" id="playerTemplate">

    <div class="playerForms"
         data-template-bind='[{"attribute": "data-player-id", "value": "pgt_player_id"},{"attribute": "data-player-tally", "value": "playertally"}]'>
        <input type="hidden" data-template-bind='[{"attribute": "name", "value": "playerid"}]'
               data-value="pgt_player_id" data-id="playerid">
        <input data-value="pgt_player_name" data-template-bind='[{"attribute": "name", "value": "nameid"}]'
               data-id="nameid" type="text" value="">
        <input class="pointbox" data-value="pgt_current_points"
               data-template-bind='[{"attribute": "name", "value": "pointsid"}]' data-id="pointsid" type="number"
               min="0" readonly>
    </div>
</script>

<script>
    function convertMilTime(input) {
        return moment(input, 'HH:mm:ss').format('h:mm:ss A');
    }
    function fixTime(input) {
        return moment(input, 'h:mm A').format('h:mm:ss A');
    }
    var isCorrect = false;
function fixDate(date) {
    var dateParts = date.split('-');
    return dateParts[1] + "/" + dateParts[2] + "/" + dateParts[0].substr(2)
}
    function secondarypoints() {
        var tmpBox = pastebox.val().split('Points');
        tmp = tmpBox[1].split('Report Totals');
        var lines = tmp[0].split('\n');
        var player = [""];
        var playercnt = 0;
        var cnt=0;
        extrafld = [""];
        var flds = tmpBox[0].split('\n');
        var nflds = flds[2].split(' ');
        var beginDate = $('#pgt_race_begin').val().split(' ');
        var endDate = $('#pgt_race_end').val().split(' ');
        beginDate[0] = fixDate(beginDate[0]);
        endDate[0] = fixDate(endDate[0]);
        if(nflds[3]==beginDate[0]){
            $('#chkBeginDate').toggleClass("glyphicon-remove-circle RedCircle",false).toggleClass("glyphicon-ok-circle GreenCircle",true)
            $('#correctBeginDate').text("")
        }else{
            $('#chkBeginDate').toggleClass("glyphicon-remove-circle RedCircle",true).toggleClass("glyphicon-ok-circle GreenCircle",false)
            $('#correctBeginDate').text("Needed:" +beginDate[0] )
        }
        if(nflds[7]==endDate[0]){
            $('#chkEndDate').toggleClass("glyphicon-remove-circle RedCircle",false).toggleClass("glyphicon-ok-circle GreenCircle",true)
            $('#correctEndDate').text("")
        }else{
            $('#chkEndDate').toggleClass("glyphicon-remove-circle RedCircle",true).toggleClass("glyphicon-ok-circle GreenCircle",false)
            $('#correctEndDate').text("Needed:" +endDate[0])
        }

        if(convertMilTime(beginDate[1])== fixTime(nflds[4] + nflds[5])){
            $('#chkBeginTime').toggleClass("glyphicon-remove-circle RedCircle",false).toggleClass("glyphicon-ok-circle GreenCircle",true)
            $('#correctBeginTime').text("")
        }else{
            $('#chkBeginTime').toggleClass("glyphicon-remove-circle RedCircle",true).toggleClass("glyphicon-ok-circle GreenCircle",false)
            $('#correctBeginTime').text("Needed:" +convertMilTime(beginDate[1]))
        }
        if(convertMilTime(endDate[1])== fixTime(nflds[8] + nflds[9])){
            $('#chkEndTime').toggleClass("glyphicon-remove-circle RedCircle",false).toggleClass("glyphicon-ok-circle GreenCircle",true)
            $('#correctEndTime').text("")
        }else{
            $('#chkEndTime').toggleClass("glyphicon-remove-circle RedCircle",true).toggleClass("glyphicon-ok-circle GreenCircle",false)
            $('#correctEndTime').text("Needed:" +convertMilTime(endDate[1]))
        }

        for (i = 0; i < lines.length; i++) {
            //if(i<3){
            // alert(lines[i]);

            cnt++;
            if (lines[i].indexOf(",") > 0 && lines[i].indexOf("/") > 0) {
                var tmpplayer = lines[i].split(String.fromCharCode(9))
                fld = 0;

                for (r = 0; r < tmpplayer.length; r++) {
                    tmpplayer[r] = tmpplayer[r].trim();
                    if (tmpplayer[r].length > 0) {
                        //console.log(tmpplayer[r]);
                        if(fld==1){
                            if(tmpplayer[r].indexOf("Level")==-1){
                                player[fld] = tmpplayer[r];
                                fld++;
                                player[fld] = extrafld[0];
                                fld++;
                            }else{
                                player[fld] = extrafld[0];
                                fld++;
                                player[fld] = tmpplayer[r];
                                fld++;
                                player[fld] = extrafld[1];
                                fld++;
                            }
                        }else{
                            player[fld] = tmpplayer[r];
                            fld++;
                        }



                        //console.log("Player:" + player[0]);

                    }

                }
                var nm = player[0].split(', ');
                if(nm.length>1){
                    document.getElementById('txtName' + (playercnt+1)).value = (nm[1] +" " + nm[0]).replace(/ *\([^)]*\) */g, " ");
                }else{
                    document.getElementById('txtName' + (playercnt+1)).value = (nm[0]).replace(/ *\([^)]*\) */g, " ").replace(',',"");
                }

                //document.getElementById('txtName' + (playercnt+1)).value = document.getElementById('txtName' + (playercnt+1)).value.replace(/ *\([^)]*\) */g, " ")
                document.getElementById('txtPoints' + (playercnt+1)).value = parseInt(player[13].replace(',',''));
                playercnt++;
                //console.log(player);



            } else {
                if (lines[i].indexOf("Level") > 0) {
                    extrafld[0] = lines[i].trim();
                } else {
                    var tmpFields = lines[i].split(' ')
                    tfld = 0;
                    for (r = 0; r < tmpFields.length; r++) {
                        tmpFields[r] = tmpFields[r].trim();
                        if (tmpFields[r].length > 0) {
                            extrafld[tfld] = tmpFields[r];
                            tfld++;
                        }
                    }
                }
                //console.log(cnt + " " + extrafld);
            }

            //}
        }
    }
    var pastebox = $("#TextBox1");
    //pastebox.bind("propertychange change keyup input paste", function(event){
    pastebox.bind("propertychange change keyup input paste", function (event) {
        //alert(event.);
        myHandler();
    });
    $("#btnClearPlayers").bind("click", function (event) {
        for (r = 1; r < 21; r++) {
            document.getElementById('txtName' + (r)).value = " ";
            document.getElementById('txtPoints' + (r)).value = 0;
        }
    });

    function myHandler() {
        var pastebox = document.getElementById('TextBox1');
        if (pastebox.value.indexOf("Rated Play")>-1) {
            //console.log("secondary points")
            secondarypoints();
        } else {


            newstr = pastebox.value;
            //alert("a" + newstr);
            //pastebox.value = pastebox.value.replace(',', '');
            if (pastebox.value.indexOf('Last Time\n') != -1) {
                var tmp = pastebox.value.split('Last Time\n');
                if (tmp[1] == undefined) {
                    //alert("Last Time");
                } else {
                    pastebox.value = tmp[1];
                    newstr = tmp[1];
                }
            }
            if (pastebox.value.indexOf('Customer\n') != -1) {
                var tmp = pastebox.value.split('Customer \n');
                //alert(tmp[1]);
                if (tmp[1] == undefined) {
                    //alert("Customer");
                } else {
                    pastebox.value = tmp[1];
                    newstr = tmp[1];
                }
            }
            if (pastebox.value.indexOf('ID\n') != -1) {
                var tmp = pastebox.value.split('ID\n');

                if (tmp[1] == undefined) {
                    alert("ID");
                } else {
                    pastebox.value = tmp[1];
                    newstr = tmp[1];
                }
            }

            if (pastebox == undefined) {
                var pastebox = document.getElementById('TextBox1');
            }
            if (pastebox != null)

                var eachLine = pastebox.value.split("\n");
            var cnt = 1;

            for (var l = 0, len = eachLine.length; l < len; l++) {
                if (cnt < 21) {
                    var dnewstr = eachLine[l].split(String.fromCharCode(9));
                    if (dnewstr.length > 3) {
                        if (dnewstr[2] != !isNaN && dnewstr[0] != !isNaN) {
                            alert(dnewstr[1]);
                            document.getElementById('txtName' + (cnt)).value = dnewstr[1];
                            document.getElementById('txtPoints' + (cnt)).value = dnewstr[2].replace(',', '');
                            $('#playerCount').val(cnt);
                            cnt++;
                        } else {
                            //alert(dnewstr[0]);
                        }


                    }
                    //    alert(dnewstr[1] + " has " + dnewstr[2] + " points");
                    //alert(eachLine[l]);
                }
            }
        }

    }


    function insertIntoArray(array, location,value){
        console.log ("length is:" + array.length);
        for(var r = array.length; r>=location; r--){
            array[r] = array[r-1];
            //console.log ("Making " + r + " into " + r-1)
            //console.log ("r= " + r );
        }
        array[location] = value;

    }
    getModalData($("#promotion-view-modal").data('promo-id'), 4);
</script>
