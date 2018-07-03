<?php
/**
 * Created by PhpStorm.
 * User: zhydian
 * Date: 4/18/2018
 * Time: 10:32 AM
 */
require_once "../models/PropertyDisplays.php";
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
$propertyDisplays = new PropertyDisplays($dbcon->read_database(), 0);
$displays = $propertyDisplays->getAllDisplays();
//echo("Number Of Displays:". count($displays));
$excludeList = array("Unity", "Samsung View", "TPS-Minix", "Mats Phone","Mat's Phone");
//print_r($displays)


?>
<header>
    <!--
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    -->

    <!-- MetisMenu CSS -->
    <link href="../startbootstrap-admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Jquery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Metis Menu Plugin JavaScript-->
    <script src="../startbootstrap-admin/vendor/metisMenu/metisMenu.min.js"></script>
    <!-- BootStrap -->
    <script src="../dependencies/js/filthypillow/moment.js"></script>
    <script src="../dependencies/js/filthypillow/moment-timezone.js"></script>
    <link href="../startbootstrap-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../startbootstrap-admin/dist/js/sb-admin-2.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.5.0/firebase-database.js"></script>
    <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyDCDs9l3uezm9R8UsgIfh9FbUWBi4i9FwQ",
            authDomain: "chimeratvhome.firebaseapp.com",
            databaseURL: "https://chimeratvhome.firebaseio.com",
            projectId: "chimeratvhome",
            storageBucket: "chimeratvhome.appspot.com",
            messagingSenderId: "861035877293"
        };
        firebase.initializeApp(config);
    </script>
    <style>
        .display-container {
            background-color: #1ab7ea;
            width: 225px;
            float: left;
            margin: 5px;
            padding-bottom: 20px;
        }

        .container {
            width: 100%;
            height: 200px;
            margin: auto;
        }
        .apiconnected{
            width: 100%;
            color: white;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        .apired{
            background-color: red;
        }
        .apiyellow{
            background-color:yellow;
            color: black;
        }
        .apigreen{
            background-color: green;
        }
        .connected-fully{
            background-color: green;
        }
        .connected-nofb{
            background-color: orange;
        }
        .connected-noapi{
            background-color: red;
        }
        .DisplayTitle{
            font-weight: bolder;
            color: white;
            font-size: 24px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        .firebaseconnected{
            width: 100%;
            color: white;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        .rTable {
            display: block;
            width: 100%;
        }
        .rTableHeading, .rTableBody, .rTableFoot, .rTableRow{
            clear: both;
        }
        .rTableHead, .rTableFoot{
            background-color: #DDD;
            font-weight: bold;
        }
        .rTableCell, .rTableHead {
            border: 1px solid #999999;
            float: left;
            height: 22px;
            overflow: hidden;
            padding: 3px 1.8%;
            width: 25%;
        }
        .rTable:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }
    </style>
</header>
<div id="DlgLog" title="Basic dialog">
    <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>
<div>
    <select hidden>
        <option timeZoneId="5" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8" selected>(GMT-08:00) Pacific Time (US & Canada)</option>
        <option timeZoneId="68" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Manila, Philippines</option>

        <option timeZoneId="1" gmtAdjustment="GMT-12:00" useDaylightTime="0" value="-12">(GMT-12:00) International Date Line West</option>
        <option timeZoneId="2" gmtAdjustment="GMT-11:00" useDaylightTime="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
        <option timeZoneId="3" gmtAdjustment="GMT-10:00" useDaylightTime="0" value="-10">(GMT-10:00) Hawaii</option>
        <option timeZoneId="4" gmtAdjustment="GMT-09:00" useDaylightTime="1" value="-9">(GMT-09:00) Alaska</option>
        <option timeZoneId="5" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
        <option timeZoneId="6" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
        <option timeZoneId="7" gmtAdjustment="GMT-07:00" useDaylightTime="0" value="-7">(GMT-07:00) Arizona</option>
        <option timeZoneId="8" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
        <option timeZoneId="9" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
        <option timeZoneId="10" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="-6">(GMT-06:00) Central America</option>
        <option timeZoneId="11" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="-6">(GMT-06:00) Central Time (US & Canada)</option>
        <option timeZoneId="12" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
        <option timeZoneId="13" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="-6">(GMT-06:00) Saskatchewan</option>
        <option timeZoneId="14" gmtAdjustment="GMT-05:00" useDaylightTime="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
        <option timeZoneId="15" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
        <option timeZoneId="16" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5">(GMT-05:00) Indiana (East)</option>
        <option timeZoneId="17" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
        <option timeZoneId="18" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
        <option timeZoneId="19" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="-4">(GMT-04:00) Manaus</option>
        <option timeZoneId="20" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="-4">(GMT-04:00) Santiago</option>
        <option timeZoneId="21" gmtAdjustment="GMT-03:30" useDaylightTime="1" value="-3.5">(GMT-03:30) Newfoundland</option>
        <option timeZoneId="22" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Brasilia</option>
        <option timeZoneId="23" gmtAdjustment="GMT-03:00" useDaylightTime="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
        <option timeZoneId="24" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Greenland</option>
        <option timeZoneId="25" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Montevideo</option>
        <option timeZoneId="26" gmtAdjustment="GMT-02:00" useDaylightTime="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
        <option timeZoneId="27" gmtAdjustment="GMT-01:00" useDaylightTime="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
        <option timeZoneId="28" gmtAdjustment="GMT-01:00" useDaylightTime="1" value="-1">(GMT-01:00) Azores</option>
        <option timeZoneId="29" gmtAdjustment="GMT+00:00" useDaylightTime="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
        <option timeZoneId="30" gmtAdjustment="GMT+00:00" useDaylightTime="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
        <option timeZoneId="31" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
        <option timeZoneId="32" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
        <option timeZoneId="33" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
        <option timeZoneId="34" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
        <option timeZoneId="35" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) West Central Africa</option>
        <option timeZoneId="36" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Amman</option>
        <option timeZoneId="37" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
        <option timeZoneId="38" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Beirut</option>
        <option timeZoneId="39" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Cairo</option>
        <option timeZoneId="40" gmtAdjustment="GMT+02:00" useDaylightTime="0" value="2">(GMT+02:00) Harare, Pretoria</option>
        <option timeZoneId="41" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
        <option timeZoneId="42" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Jerusalem</option>
        <option timeZoneId="43" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Minsk</option>
        <option timeZoneId="44" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Windhoek</option>
        <option timeZoneId="45" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
        <option timeZoneId="46" gmtAdjustment="GMT+03:00" useDaylightTime="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
        <option timeZoneId="47" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Nairobi</option>
        <option timeZoneId="48" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Tbilisi</option>
        <option timeZoneId="49" gmtAdjustment="GMT+03:30" useDaylightTime="1" value="3.5">(GMT+03:30) Tehran</option>
        <option timeZoneId="50" gmtAdjustment="GMT+04:00" useDaylightTime="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
        <option timeZoneId="51" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="4">(GMT+04:00) Baku</option>
        <option timeZoneId="52" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="4">(GMT+04:00) Yerevan</option>
        <option timeZoneId="53" gmtAdjustment="GMT+04:30" useDaylightTime="0" value="4.5">(GMT+04:30) Kabul</option>
        <option timeZoneId="54" gmtAdjustment="GMT+05:00" useDaylightTime="1" value="5">(GMT+05:00) Yekaterinburg</option>
        <option timeZoneId="55" gmtAdjustment="GMT+05:00" useDaylightTime="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
        <option timeZoneId="56" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
        <option timeZoneId="57" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
        <option timeZoneId="58" gmtAdjustment="GMT+05:45" useDaylightTime="0" value="5.75">(GMT+05:45) Kathmandu</option>
        <option timeZoneId="59" gmtAdjustment="GMT+06:00" useDaylightTime="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
        <option timeZoneId="60" gmtAdjustment="GMT+06:00" useDaylightTime="0" value="6">(GMT+06:00) Astana, Dhaka</option>
        <option timeZoneId="61" gmtAdjustment="GMT+06:30" useDaylightTime="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
        <option timeZoneId="62" gmtAdjustment="GMT+07:00" useDaylightTime="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
        <option timeZoneId="63" gmtAdjustment="GMT+07:00" useDaylightTime="1" value="7">(GMT+07:00) Krasnoyarsk</option>
        <option timeZoneId="64" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
        <option timeZoneId="65" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
        <option timeZoneId="66" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
        <option timeZoneId="67" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Perth</option>
        <option timeZoneId="68" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Taipei</option>

        <option timeZoneId="69" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
        <option timeZoneId="70" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="9">(GMT+09:00) Seoul</option>
        <option timeZoneId="71" gmtAdjustment="GMT+09:00" useDaylightTime="1" value="9">(GMT+09:00) Yakutsk</option>
        <option timeZoneId="72" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="9.5">(GMT+09:30) Adelaide</option>
        <option timeZoneId="73" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="9.5">(GMT+09:30) Darwin</option>
        <option timeZoneId="74" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="10">(GMT+10:00) Brisbane</option>
        <option timeZoneId="75" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
        <option timeZoneId="76" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Hobart</option>
        <option timeZoneId="77" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
        <option timeZoneId="78" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Vladivostok</option>
        <option timeZoneId="79" gmtAdjustment="GMT+11:00" useDaylightTime="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
        <option timeZoneId="80" gmtAdjustment="GMT+12:00" useDaylightTime="1" value="12">(GMT+12:00) Auckland, Wellington</option>
        <option timeZoneId="81" gmtAdjustment="GMT+12:00" useDaylightTime="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
        <option timeZoneId="82" gmtAdjustment="GMT+13:00" useDaylightTime="0" value="13">(GMT+13:00) Nuku'alofa</option>
    </select>

</div>
<div class="container">
    <?php
    foreach ($displays as $display) {
        $start_date = new DateTime($display["display_lastcheckin"]);
        $since_start = $start_date->diff(new DateTime());
        $days = "";
        if ($since_start->d > 0) {
            $days = $since_start->d . ' days ';
        }
        if (strlen($since_start->h) == 1) {
            $hr = '0' . $since_start->h;
        } else {
            $hr = $since_start->h;
        }
        if (strlen($since_start->i) == 1) {
            $min = '0' . $since_start->i;
        } else {
            $min = $since_start->i;
        }
        if ($hr != "00" && $min != 00 || $days >0) {
            $timeleft= $days . $hr . ':' . $min . '<br>';
            $apiConnected = 'false';
        } else {
            $apiConnected = 'true';
            $timeleft= "<span class=\"glyphicon glyphicon-ok-circle\"></span>API Connected";
        }
        //if (in_array($display["display_name"], $excludeList))
          //  continue;

        ?>
        <div data-fbconnected="false" data-name=" <?php echo $display["display_name"]?>" data-linkcode="<?php echo $display["display_linkcode"] ?>" data-connected="<?php echo $apiConnected?>" class="display-container">
            <div class="DisplayTitle">
                <?php
                echo $display["display_name"]
                ?>
            </div>
            <div class="apiconnected">
                <?php
                echo $timeleft;
                ?>
            </div>
            <div class="firebaseconnected" style="visibility: hidden">
                Firebase Connected
            </div>
        </div>
        <?php
    }

    ?>
</div>

<script>
    DlgLogView = $("#DlgLog").dialog({
        autoOpen: false,
        height: 600,
        width: 800,
        modal: true,
        buttons: {
            Cancel: function() {
                dialog.dialog( "close" );
            }
        },
        close: function() {
        }
    });
</script>
<script>
    checkAPI();
    var displays;
    var myVar = setInterval(adjustSeconds, 1000);
    var myVar = setInterval(checkAPI, 5000);
    function adjustSeconds() {
        var currentdisplays = $(".display-container");
        currentdisplays.each(function () {

            if($(this).attr("apitimeout")>15){
                var d2 = new Date($(this).attr("last_checkin"));
                var d1 = Date.now()
                $(this).children(".apiconnected").html(msToTime(d2))
            }
            //currentdisplay.attr("connected",false)
        });
    }

    function checkAPI() {
        console.log("Checking API")
        $.ajax({
            url: '../controllers/displaycontroller.php',
            type: 'post',
            data: {
                action: 'getAllDisplays'
            },
            cache: false,
            success: function (response) {
                displays = JSON.parse(response)
                displays.forEach(function (display) {
                    //console.log(display)
                    var currentdisplay = $(".display-container[data-linkcode='"+display.display_linkcode+"']");
                    var d2 = new Date(display.display_lastcheckin);
                    var d1 = Date.now()
                    var currentTimeout = ((d1-d2)/1000);
                    currentdisplay.attr("last_checkin",display.display_lastcheckin)
                    currentdisplay.attr("apitimeout",((d1-d2)/1000))
                    currentdisplay.attr("data-connected",true)
                    currentdisplay.attr("display_monitor_threshold_red",display.display_monitor_threshold_red)
                    currentdisplay.attr("display_monitor_threshold_yellow",display.display_monitor_threshold_yellow)

                    //console.log(display.display_lastcheckin + " Seconds: " + ((d1-d2)/1000))

                    status = "Green"
                    if(currentTimeout>display.display_monitor_threshold_yellow){
                        currentdisplay.children(".apiconnected").removeClass("apigreen")
                        currentdisplay.children(".apiconnected").addClass("apiyellow")
                        currentdisplay.attr("data-connected",false)
                        status = "Yellow"
                    }else{
                        currentdisplay.children(".apiconnected").removeClass("apired")
                        currentdisplay.children(".apiconnected").removeClass("apiyellow")
                        currentdisplay.children(".apiconnected").removeClass("apigreen")
                        currentdisplay.children(".apiconnected").addClass("apigreen")
                        currentdisplay.children(".apiconnected").html("<span class=\"glyphicon glyphicon-ok-circle\"></span> API Connected")

                    }
                    if(currentTimeout>display.display_monitor_threshold_red){
                        currentdisplay.children(".apiconnected").removeClass("apigreen")
                        currentdisplay.children(".apiconnected").removeClass("apiyellow")
                        currentdisplay.children(".apiconnected").addClass("apired")
                        currentdisplay.attr("data-connected",false)
                        status = "Red"
                    }

                    //console.log(display.display_name+": " + status + currentTimeout)

                });
                AdjustDisplayColor();
            },
            error: function(xhr, desc, err) {
                console.log(xhr + "\n" + err);
            }

        });

    }
    startFirebaseDisplayListener();

    Displays = {};
    function startFirebaseDisplayListener(){
        //console.log("Started Firebase Manager");
        var userRef = firebase.database().ref('Displays')
        userRef.on('value', function (snapshot) {
            snapshot.forEach(function (userSnapshot) {
                curDisplay = JSON.parse(JSON.stringify(userSnapshot));
                curDisplay.Key = userSnapshot.key;
                Displays[curDisplay["LinkCode"]] = curDisplay;
                var curObj = $(".display-container[data-linkcode='"+curDisplay["LinkCode"]+"']");
                var apicon = curObj.children(".firebaseconnected")
                    if (curDisplay["Connected"] != null) {
                        if(curDisplay["Monitor"]) {
                            if (!curDisplay["Connected"]) {
                                apicon.removeClass("apigreen");
                                apicon.addClass("apired");
                                curObj.attr("data-fbconnected","false")
                                curObj.toggle(true);
                                apicon.html("Firebase Disconnected")
                            } else {
                                apicon.addClass("apigreen");
                                apicon.removeClass("apired");
                                curObj.attr("data-fbconnected","true")

                            }
                        }else{
                            curObj.toggle(false);
                        }
                    }else{
                        curObj.toggle(false);
                    }

                //console.log("found:" + curDisplay["DisplayName"] + " linkcode=" + curDisplay["LinkCode"]);

            });
            AdjustDisplayColor()
        });
    }
    function AdjustDisplayColor() {
        var currentdisplays = $(".display-container");
        currentdisplays.each(function () {
            /*
            if($(this).attr("data-fbconnected")=='true'&&$(this).attr("data-connected")=='true'){
                //console.log($(this).attr("data-name") + ": It's True")
                $(this).addClass("connected-fully");
                $(this).removeClass("connected-nofb");
                $(this).removeClass("connected-noapi");

            }
            if($(this).attr("data-fbconnected")!='true'&&$(this).attr("data-connected")=='true'){
                //console.log($(this).attr("data-name") + ": It's partially true (fb not connected)")
                $(this).removeClass("connected-fully");
                $(this).addClass("connected-nofb");
                $(this).removeClass("connected-noapi");
            }
            if($(this).attr("data-fbconnected")=='true'&&$(this).attr("data-connected")!='true'){
                //console.log($(this).attr("data-name") + ": It's partially true (api not connected)")
                $(this).removeClass("connected-fully");
                $(this).removeClass("connected-nofb");
                $(this).addClass("connected-noapi");
            }
            if($(this).attr("data-fbconnected")!='true'&&$(this).attr("data-connected")!='true'){
                //console.log($(this).attr("data-name") + ": It's partially true (api not connected)")
                $(this).removeClass("connected-fully");
                $(this).removeClass("connected-nofb");
                $(this).addClass("connected-noapi");
            }
            */
            //console.log("It's " + $(this).attr("data-fbconnected") + " - " + $(this).attr("data-connected"))
            //$(this).toggle(false);
            if($(this).attr("data-connected")!='true'){
                //console.log($(this).attr("data-name") + ": It's partially true (api not connected)")
                $(this).removeClass("connected-fully");
                $(this).addClass("connected-noapi");
            }else{
                //console.log($(this).attr("data-name") + ": It's partially true (api not connected)")
                $(this).addClass("connected-fully");
                $(this).removeClass("connected-noapi");
            }
        })
    }
    function msToTime(time) {
        var timenow = moment(time); // some random moment after start (in ms)
        return timenow.fromNow()

        //return moment.utc(diff).format("HH:mm:ss");
    }
    function oldmsToTime(duration) {

        var milliseconds = parseInt((duration%1000)/100)
            , seconds = parseInt((duration/1000)%60)
            , minutes = parseInt((duration/(1000*60))%60)
            , hours = parseInt((duration/(1000*60*60))%24)
            , days = parseInt((duration/(1000*60*60)));

        days = (days < 10) ? "0" + days : days;
        hours = (hours < 10) ? "0" + hours : hours;
        minutes = (minutes < 10) ? "0" + minutes : minutes;
        seconds = (seconds < 10) ? "0" + seconds : seconds;

        return days + "Days " + hours + ":" + minutes + ":" + seconds;
    }
    var showLogBtnClick = function () {
        var parentDiv = $(this).parent().parent()
        console.log("Clicked Log:" + parentDiv.data("linkcode"));
        DlgLogView.load("viewlogs.php", {linkcode: parentDiv.data("linkcode")});
        DlgLogView.dialog("open");
    }
    $(".btnShowLogs").unbind('click').click(showLogBtnClick);


</script>