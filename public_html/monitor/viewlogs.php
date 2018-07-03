<?php
/**
 * Created by PhpStorm.
 * User: zhydian
 * Date: 4/26/2018
 * Time: 2:41 AM
 */?>
<div id="deviceLogs">
    <div class="rTable">
        <div class="rTableRow">
            <div class="rTableHead">Timestamp</div>
            <div class="rTableHead"><strong>Application</strong></div>
            <div class="rTableHead"><span style="font-weight: bold;">Category</span></div>
            <div class="rTableHead">Details</div>
        </div>
    </div>
</div>
<script>
    /*
    //startFirebaseDisplayLogListener()
    DisplayLogs = {};
    function startFirebaseDisplayLogListener(linkcode){
        console.log("Started Firebase Log View");
        var userRef = firebase.database().ref('DisplayLogs/'+linkcode)
        userRef.on('value', function (snapshot) {

            snapshot.forEach(function (userSnapshot) {
                curDisplayLog = JSON.parse(JSON.stringify(userSnapshot));
                curDisplayLog.Key = userSnapshot.key;
                console.log("Found it:" + curDisplayLog.Key);
                DisplayLogs[curDisplayLog.Key] = curDisplay;
                //console.log("found:" + curDisplay["DisplayName"] + " linkcode=" + curDisplay["LinkCode"]);
                $("#rTable").append("        <div class=\"rTableRow\">\n" +
                    "            <div class=\"rTableCell\">Cassie</div>\n" +
                    "            <div class=\"rTableCell\"><a href=\"tel:9876532432\">9876 532 432</a></div>\n" +
                    "            <div class=\"rTableCell\"><img src=\"images/check.gif\" alt=\"checked\" /></div>\n" +
                    "        </div>\n")
            });
            AdjustDisplayColor()
        });
    }
    */

</script>
