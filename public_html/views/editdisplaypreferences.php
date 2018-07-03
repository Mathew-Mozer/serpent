<?php
session_start();
require "../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../models/PromotionModel.php";
require_once "../models/PropertyDisplays.php";
require "../models/PermissionModel.php";
$dbcon = new DBCon();
//var_dump($_POST);
$displayProperties = new PropertyDisplays($dbcon->read_Database(), $_POST['propertyId']);
$display = $displayProperties->getDisplayWithId($_POST['displayid']);
$promotion = new PromotionModel($dbcon->read_database());
?>
<style>
    .FileList{
        overflow: scroll;
        height: 150px;
        width: 225px;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>
<script>
    $(function () {
        $("#tabs").tabs();
    });
</script>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Display Properties</a></li>
        <li><a href="#tabs-2">Commands</a></li>
        <li><a href="#tabs-3">Software</a></li>
        <li><a href="#tabs-4">Logs</a></li>
    </ul>
    <div id="tabs-1">
        <div class="option-group">
            <table style="width: 100%">
                <tr>
                    <td style="padding: 5px; text-align: center" colspan="3"><label
                            for="top-title-box"><?php echo($display->getName()) ?></label></td>
                    <input type="hidden" id="display-id" value="<?php echo($_POST['displayid']) ?>">
                </tr>
                <tr>
                    <td style="padding: 5px"><label for="top-title-box">Mac Address: </label>
                        <input id="display-mac" class="display-field" data-column="display_mac" name="pgt_title"
                               type="text"
                               placeholder="Top Title"
                               value="<?php echo($display->getMacAddress()) ?>"></td>
                    <td style="padding: 5px">App Version:<?php echo($display->getAppVersion()) ?></td>
                    <td style="padding: 5px">LinkCode:<input id="display-linkcode" class="display-field"
                                                             data-column="display_linkcode" name="pgt_title" type="text"
                                                             placeholder="Top Title"
                                                             value="<?php echo($display->getLinkCode()) ?>"></td>


                    <td style="padding: 5px"></td>
                </tr>
                <tr>
                    <td colspan="4"><span id="display-firebase" title="Not Connected" class="glyphicon glyphicon-fire"
                                          style="color:gray; font-size: 40px"></span><span id="display-firebase-cloud"
                                                                                           class="glyphicon glyphicon-cloud"
                                                                                           title="Not Connected"
                                                                                           style="color:gray; font-size: 40px">
                    </td>
                </tr>
            </table>
        </div>
        <div class="option-group">
            <div style="text-align: center">
                <label for="top-content-box">Dimensions</label><br>
                W <input id="display-width" class="display-field" data-column="display_width" type="text"
                         placeholder="Top Title" value="<?php echo($display->getWidth()) ?>">X
                H<input id="display-height" class="display-field" data-column="display_height" type="text"
                        placeholder="Top Title" value="<?php echo($display->getHeight()) ?>">
                <br>
                <br>
                <input id="display-fitw" class="display-field" data-column="display_fitw"
                       type="checkbox" <?php echo(isChecked($display->getFitW())) ?>>Fit W <input
                    id="display-fith" class="display-field" data-column="display_fith"
                    type="checkbox" <?php echo(isChecked($display->getFitH())) ?>>Fit H
            </div>


        </div>
        <div class="option-group">
            <table style="width: 100%; text-align: center">
                <tr>
                    <td><label for="top-content-box">Display Property</label><br>
                        <select class="display-field" data-column="display_propertyid" id="display-propertyID"
                                name="propertyID">
                            <?php
                            if (isset($_SESSION['userId'])) {
                                $properties = $promotion->getAssignableProperties();
                                echo "<option value='0'>Unassign</option>";
                                foreach ($properties as $property) {
                                    echo "<option value='" . $property['property_id'] . "' " . isSelected($property['property_id'], $_POST['propertyId']) . ">" . $property['property_name'] . "</option>";
                                }
                            }
                            ?>
                        </select></td>
                    <td><label for="top-content-box">Display API</label><br>
                        <select class="display-field" data-column="display_api_id" id="display-api-id"
                                name="propertyID">
                            <?php
                            if (isset($_SESSION['userId'])) {
                                $apis = $displayProperties->getAPIs();
                                foreach ($apis as $api) {
                                    echo "<option value='" . $api['api_id'] . "'" . isSelected($api['api_id'], $display->getApiId()) . ">" . $api['api_name'] . "</option>";
                                }
                            }
                            ?>
                        </select></td>
                    <td>
                        <label for="top-content-box">Flip</label><br>
                        <input id="display-flip" class="display-field" data-column="display_flip"
                               type="checkbox" <?php echo(isChecked($display->getFlip())) ?>>
                    </td>
                    <td>
                        <label for="top-content-box">Flip Vertical</label><br>
                        <input id="display-flipv" class="display-field" data-column="display_flipv"
                               type="checkbox" <?php echo(isChecked($display->getFlipv())) ?>>

                    </td>
                    <td>
                        <label for="top-content-box">Debug</label><br>
                        <input id="display-debug" class="display-field" data-column="display_flip"
                               type="checkbox" <?php echo(isChecked($display->getDebug())) ?>>
                    </td>
                    <td>
                        <label for="top-content-box">Vertical</label><br>
                        <input id="display-vertical" class="display-field" data-column="display_vertical"
                               type="checkbox" <?php echo(isChecked($display->getVertical())) ?>>
                    </td>
                    <td>
                        <label for="top-content-box">Kiosk Mode</label><br>
                        <input id="display-kiosk" class="display-field" data-column="display_kiosk"
                               type="checkbox">
                    </td>
                    <td>
                        <label for="top-content-box">Log Errors</label><br>
                        <input id="display-log" class="display-field" data-column="display_log"
                               type="checkbox">
                    </td>
                </tr>
                <tr>
                    <td><label for="top-content-box">Monitor</label><br>
                        <input id="" class="display-field firebase-display-settings" data-setting="Monitor"
                               type="checkbox"></td>
                    <td><label for="top-content-box">Server Time</label><br>
                        <input id="" class="display-field firebase-display-settings" data-setting="ServerTime"
                               type="checkbox"></td>
                    <td style="padding-left: 20px; padding-right: 20px"><label for="top-content-box">Min Mem</label><br>
                        <input id="" class="display-field firebase-display-settings" data-setting="memUsageMinThreshhold"
                               style="width: 40px" type="number"></td>
                    <td style="padding-left: 20px; padding-right: 20px"><label for="top-content-box">Max Mem</label><br>
                        <input id="" style="width: 40px" class="display-field firebase-display-settings" data-setting="memUsageMaxThreshhold"
                               type="number"></td>

                </tr>
                <button type="button" id="save-display-options">Save Display Info</button>
            </table>
        </div>
    </div>
    <div id="tabs-2">

        <button type="button" id="view-api-data">View API Data</button>
        <br>
        <button type="button" class="send-fcm-command" data-display-id="<?php echo($_POST['displayid']) ?>"
                data-command="getSettings">Update Display Settings
        </button>
        <button type="button" class="send-fcm-command" data-display-id="<?php echo($_POST['displayid']) ?>"
                data-command="LaunchApp" data-package-name="com.typhonpacific.ChimeraTV">Launch ChimeraTV
        </button>

        <button type="button" class="send-fcm-command" data-display-id="<?php echo($_POST['displayid']) ?>"
                data-command="LaunchApp" data-package-name="com.teamviewer.host.market">Restart TeamViewer
        </button>
        <button type="button" class="send-fcm-command" data-token="CTV"
                data-display-id="<?php echo($_POST['displayid']) ?>"
                data-command="Quit" data-package-name="Test111">Quit ChimeraTV
        </button>
        <button type="button" class="send-fcm-command" data-token=""
                data-display-id="<?php echo($_POST['displayid']) ?>"
                data-command="BringHomeToFront" data-package-name="Test111">Home To Front
        </button>
        <button type="button" class="send-fcm-command" data-token="CTV"
                data-display-id="<?php echo($_POST['displayid']) ?>"
                data-command="AttemptReconnectFirebase" data-package-name="Test111">Force Connect
        </button>
    </div>
    <div id="tabs-3">
        <div style="float: left">
            <label for="top-content-box">Downloaded</label><br>
            <div class="FileList">
                <table class="apk">
                    <?php
                    $dir = "../apk/chimeratv";
                    $files = array_diff(scandir($dir), array('..', '.'));
                    foreach ($files as $file) {
                        ?>
                        <tr>
                            <td></td>
                            <td><?php echo($file) ?></td>
                            <td>
                                <button class="btn btn-sm btn-success">Push</button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        <div  style="float: left">
            <label for="top-content-box">ChimeraTV</label><br>
            <div class="FileList">
                <table class="apk">
                    <?php
                    $dir = "../apk/chimeratv";
                    $files = array_diff(scandir($dir), array('..', '.'));
                    foreach ($files as $file) {
                        ?>
                        <tr>
                            <td></td>
                            <td><?php echo($file) ?></td>
                            <td>
                                <button class="btn btn-sm btn-success">Push</button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        <div  style="float: left">
            <label for="top-content-box">Chimera Home</label><br>
            <div class="FileList">
                <table class="apk">
                    <?php
                    $dir = "../apk/home";
                    $files = array_diff(scandir($dir), array('..', '.'));
                    foreach ($files as $file) {
                        ?>
                        <tr>
                            <td></td>
                            <td><?php echo($file) ?></td>
                            <td>
                                <button class="btn btn-sm btn-success">Push</button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        <br style="clear: left;" />
    </div>
    <div id="tabs-4">
        <table class="table thead-dark" id="LogTable">
            <thead>
            <tr><th>Timestamp</th><th>App</th><th>Category</th><th>Category</th><th></th></tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <br style="clear: left;" />
        <button type="button" class="btn btn-danger btnClearLogs" data-linkcode="<?php echo($display->getLinkCode()) ?>">Clear All Logs!</button>
    </div>
</div>


<?php
function isChecked($val)
{
    if ($val) {
        return 'checked';
    }
}

function isSelected($val1, $val2)
{
    if ($val1 == $val2) {
        return 'selected';
    } else {
        return '';
    }
}

?>
<script>
    var DisplayKey = null;
    var Display = "";
    function ConnectToFirebase($key) {
        console.log("Attempting")
        $("#display-key").hide();
        firebase.database().ref('Displays').orderByChild("LinkCode").equalTo('<?php echo($display->getLinkCode()) ?>').once('value').then(function (snapshot) {
            snapshot.forEach(function (userSnapshot) {
                if (DisplayKey == null) {
                    DisplayKey = userSnapshot.key;
                    console.log("Key:" + DisplayKey);
                    StartFirebaseDisplayListener("connect function");
                }
            });
        });
    }

    function ConnectToLog($key) {
        console.log("Attempting To View Log")
        var userRef = firebase.database().ref('/DisplayLogs/<?php echo($display->getLinkCode()) ?>').orderByKey().limitToLast(50);
       /*
        userRef.once('value', function (snapshot) {
            snapshot.forEach(function (userSnapshot) {
                console.log("Log Key:" + DisplayKey);
                         AddLogToList(userSnapshot)
                });
        });
        */

       userRef.on('value', function (snapshot) {
           $("#LogTable > tbody").empty()
               snapshot.forEach(function (userSnapshot) {

                   AddLogToList(userSnapshot)
               });
        });
    }
    function AddLogToList(userSnapshot) {
        //console.log("Log" + JSON.stringify(userSnapshot))
        logitem = JSON.parse(JSON.stringify(userSnapshot))
        logitem.key = userSnapshot.key;
        console.log("Log Item Key:" + logitem.key);
        var date =moment.utc(logitem.Timestamp).format('M/D/YY h:mm:ss A')
        $row = "<tr><td>"+logitem.Application+"</td><td>"+logitem.Details+"</td><td>"+date+"</td><td>"+logitem.Category+"</td><td><button type='button' data-logkey="+logitem.key+" class='btn btn-warning removeLogItem'>X</button></td></tr>"
        $("#LogTable > tbody").prepend($row)


    }
    function StartFirebaseDisplayListener($str) {
        //console.log("Started from:" + $str);
        var userRef = firebase.database().ref('/Displays/' + DisplayKey);
        userRef.on('value', function (snapshot) {
            Display = JSON.parse(JSON.stringify(snapshot));
          //  console.log(JSON.stringify(snapshot));
            $("#display-kiosk").prop('checked', Display.Kiosk);
            $("#display-log").prop('checked', Display.logErrors);

            $("#display-key").show();
            $("#display-key").prop('title', DisplayKey)
            if (DisplayKey != null) {
                $("#display-firebase").css("color", "Green");
                $("#display-firebase").prop("title", DisplayKey);
            } else {
            //    console.log("FCM Token NOT Found:")
                $("#display-firebase").css("color", "Grey");
                $("#display-firebase").prop("title", "");
            }
            if (Display.FCMToken != null) {
                $("#display-firebase-cloud").css("color", "Green");
                $("#display-firebase-cloud").prop("title", Display.FCMToken);
            } else {
                $("#display-firebase-cloud").css("color", "Grey");
                $("#display-firebase-cloud").prop("title", "Not Connected");
            }
            if (Display.Monitor != null) {
                $(".firebase-display-settings[data-setting='Monitor']").prop('checked', Display.Monitor);
            }
            if (Display.ServerTime != null) {
                $(".firebase-display-settings[data-setting='ServerTime']").prop('checked', Display.ServerTime);
            }
            if (Display.memUsageMaxThreshhold != null) {
                $(".firebase-display-settings[data-setting='memUsageMaxThreshhold']").val(Display.memUsageMaxThreshhold);
            }
            if (Display.memUsageMinThreshhold != null) {
                $(".firebase-display-settings[data-setting='memUsageMinThreshhold']").val(Display.memUsageMinThreshhold);
            }
        });
    }
    ConnectToFirebase();
    ConnectToLog();
    $(document).ready(function () {

        $("#display-kiosk").change(function () {
            Display.Kiosk = $("#display-kiosk").prop('checked');
            console.log("clicked?");
            saveFirebaseDisplay();

        });
        $("#display-log").change(function () {
            Display.logErrors = $("#display-log").prop('checked');
            console.log("clicked log?" + $("#display-log").prop('checked'));
            saveFirebaseDisplay();

        });
        $(".firebase-display-settings").change(function () {
            //Display[$(".firebase-display-settings").data("setting")] = $(this).prop('checked')

            var type = $(this).attr('type');

            switch (type){
                case "checkbox":
                    Display[$(this).data("setting")] = $(this).prop('checked')

                    break;
                case "number":
                    Display[$(this).data("setting")] = +$(this).val();
                    break;
                default:
                    console.log("Type: " + type)
            }


            console.log("Changed" + $(this).data("setting") + "to: " + Display[$(this).data("setting")]);
            saveFirebaseDisplay();

        });
        $('#save-display-options').click(function () {
            Display.LinkCode = $('#display-linkcode').val();
            saveFirebaseDisplay();
        })
        $(document).on('click', '.removeLogItem', function(){
            console.log("Removing <?php echo($display->getLinkCode()) ?>/"+ $(this).data("logkey"))
            var logRef = firebase.database().ref('/DisplayLogs/<?php echo($display->getLinkCode()) ?>/'+ $(this).data("logkey"))
            logRef.remove()
        });

        $('.btnClearLogs').click(function () {
            if (confirm('Are you sure you want to clear EVERY LOG?')) {
                console.log("Deleting logs of: <?php echo($display->getLinkCode()) ?>");
                var userRef = firebase.database().ref('/DisplayLogs/<?php echo($display->getLinkCode()) ?>')
                //var userRef = firebase.database().ref('/DisplayLogs/')
                userRef.remove();
            } else {
                console.log("Logs are safe:");
            }
        })

        $('#display-firebase').click(function () {
            if (DisplayKey == null) {
                console.log("Trying to save firebase");
                DisplayKey = firebase.database().ref('Displays').push().key;
                var Updates = {};
                Display = {
                    LinkCode: $('#display-linkcode').val(),
                    Kiosk: $("#display-kiosk").prop('checked'),
                    DisplayName: "<?php echo($display->getName()) ?>",
                    API: $("#display-api-id option:selected").val(),
                    Monitor: true,
                    logErrors: false,
                    ServerTime:true
                };
                Updates[DisplayKey] = Display;
                firebase.database().ref('Displays').update(Updates);
                StartFirebaseDisplayListener("create Firebase Entry");
            } else {
                console.log("key exists:" + DisplayKey);
            }
        })
    });
    function saveFirebaseDisplay() {
        if (DisplayKey != null) {
            if (Display.DisplayName = "Unnamed") {
                Display.DisplayName = "<?php echo($display->getName()) ?>";
            }
            firebase.database().ref('Displays/' + DisplayKey).set(Display);
        }
    }
</script>
