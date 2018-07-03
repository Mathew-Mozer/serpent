<?php
if (!isset($_SESSION)) {
    session_start();
    ?>

    <?php
}
/*
* Header
* Author: Stephen King
* Version 2016.10.5.1
*
* This page controls all of the dependencies and opening tags for the website.
*/

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Serpent</title>

    <!-- Bootstrap Core CSS -->
    <link href="startbootstrap-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="startbootstrap-admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <!-- <link href="startbootstrap-admin/dist/css/timeline.css" rel="stylesheet">

     <!--Morris Charts CSS-->
    <link href="startbootstrap-admin/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="startbootstrap-admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="startbootstrap-admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->
    <script src="startbootstrap-admin/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="startbootstrap-admin/vendor/bootstrap/js/bootstrap.min.js"></script>


    <!--Font Awesome-->
    <link rel="stylesheet" href="dependencies/fontawesome/css/font-awesome.min.css">

    <!-- Custom Theme JavaScript -->
    <script src="startbootstrap-admin/dist/js/sb-admin-2.js"></script>
    <script>
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
    </script>


    <!-- TPS Generated Content -->
    <link href="dependencies/css/tiles.css" rel="stylesheet">
    <link href="dependencies/css/text.css" rel="stylesheet">
    <link href="dependencies/css/displays.css" rel="stylesheet">
    <link href="dependencies/css/highhandform.css" rel="stylesheet">
    <link href="dependencies/css/glyphicons.css" rel="stylesheet">
    <link href="dependencies/css/ring.css" rel="stylesheet">
    <link href="dependencies/css/cards.css" rel="stylesheet">
    <link href="dependencies/css/styling.css" rel="stylesheet">
    <link href="dependencies/css/displaymodal.css" rel="stylesheet">

    <?php
    require_once("HelperFunctions.php");
    require_once(getServerPath() . "dbcon.php");
    $dbcon = NEW DbCon();
    ?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Date Time Picker-->
    <script src="dependencies/js/filthypillow/jquery.filthypillow.js"></script>
    <script src="dependencies/js/filthypillow/moment.js"></script>
    <script src="dependencies/js/filthypillow/jquery.filthypillow.min.js"></script>
    <link href="dependencies/js/filthypillow/jquery.filthypillow.css" rel="stylesheet">

    <!-- jQueryUI SwitchButton -->
    <script src="dependencies/js/jQuery-switchButton-master/jquery.switchButton.js"></script>
    <link href="dependencies/js/jQuery-switchButton-master/jquery.switchButton.css" rel="stylesheet">
    <link href="dependencies/js/jQuery-switchButton-master/main.css" rel="stylesheet">

    <!-- Spectrum Color Picker -->
    <script type="text/javascript" src="dependencies/js/spectrum/spectrum.js"></script>
    <!-- Metis Menu Plugin JavaScript-->
    <script src="startbootstrap-admin/vendor/metisMenu/metisMenu.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
    <link href="dependencies/js/spectrum/spectrum.css" rel="stylesheet">
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
    <script>
        var wintimeout;
        function SetWinTimeout() {
            var numOfMinutes = 40
            //console.log( numOfMinutes+" Timeout Ready!" );

            wintimeout = window.setTimeout("window.location.href=location.href;", numOfMinutes * 60 * 1000); //after 5 mins i.e. 5 * 60 * 1000
        }
        $(function() {
            //console.log( "Timeout ready!" );
            $('body').click(function () {
                //console.log("Timeout Reset")
                window.clearTimeout(wintimeout); //when user clicks remove timeout and reset it

                SetWinTimeout();
            });
        });
        SetWinTimeout();
    </script>
</head>
<script>
    $WebsiteVersion = '4';
    if (getCookie("version") != $WebsiteVersion) {
        //alert("Version: " + $WebsiteVersion + " Doesn't Equal Cookie Version: " + getCookie("version"));
        setCookie("version", $WebsiteVersion, 7);
    } else {
        //alert("Version: " + $WebsiteVersion + " Equals Cookie Version: " + getCookie("version"));
    }
    var customScripts = [
        "dependencies/js/promotion.js",
        "dependencies/js/optionsmodal.js",
        "dependencies/js/addpromotionmodal.js",
        "dependencies/js/createproperty.js",
        "dependencies/js/displayview.js",
        "dependencies/js/promotionmodal.js",
        "dependencies/js/editdisplay.js",
        "dependencies/js/addusermodal.js",
        "dependencies/js/editusermodal.js",
        "dependencies/js/editusers.js",
        "dependencies/js/viewdocuments.js",
        "dependencies/js/viewAccount.js",
        "dependencies/js/firebasemanager.js",
        "dependencies/js/promotion/multipliermadness.js",
        "dependencies/js/promotion/monstercarlo.js",
        "dependencies/js/promotion/sessionmanager.js",
        "dependencies/js/promotion/timetracker.js",
        "dependencies/js/promotion/prizeevent.js",
        "dependencies/js/skinmanager.js",
        "dependencies/js/changepromostatus.js",
        "dependencies/js/uploadpicture.js",
        "dependencies/js/promotion/pointsgt.js",
        "dependencies/js/promotion/menuboard.js",
        "dependencies/js/promotion/formhelperfunctions.js",
    ]
    /*
     $(customScripts).each(function (scr) {
         //alert(customScripts[scr]);
         var s = document.createElement('script');
         s.src = customScripts[scr] + "?t=" + $WebsiteVersion;
         document.getElementsByTagName("head")[0].appendChild(s);
     })
 */
</script>