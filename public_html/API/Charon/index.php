<?php
require_once '../../dependencies/php/HelperFunctions.php';
require_once(getServerPath() . "dbcon.php");
include '../Classes/CharonBot.php';
include '../Classes/moduleIncludes.php';
$dbcon = NEW DbCon();
header('Content-Type: application/json; charset=utf-8');
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 2/9/2017
 * Time: 4:15 AM
 */

if (isset($_POST["Activity"])) {
    if (isset($_POST["macAddress"])) {
        $macAddress = $_POST["macAddress"];
    }
    SlackTool::slack("It Started:".$_POST['macAddress'], "#debuglog", "TestAPI");

    switch ($_POST["Activity"]) {

        case "CharonCommand":
            CharonCommand($_POST);
            break;
    }
}

function CharonCommand(){
        $msg = "";

        $charonBot = new CharonBot($_POST["macAddress"]);

        if ($charonBot->found)
        {
            if(isset($_POST["Message"])) {


                switch ($_POST["Message"]) {
                    case "Started":

                        if ($charonBot->version != $_POST["Version"]) {

                            if ($charonBot->updateCharonSettings(0, $_POST["Version"]) == 1) {
                                $msg = "Charon Version Updated to:" . $_POST["Version"];
                            } else {
                                $msg = "Database Error";
                            }

                        }
                        break;
                    case "TokenUpdate":

                        $msg = "Token Update: " + $_POST["Data"];
                        $charonBot->updateCharonSettings(1, $_POST["Data"]);
                        break;
                    case "ConnectionCheck":
                        $msg = "";

                        break;
                    default:
                        $msg = $_POST["Message"];
                        break;
                }
                if (!$msg == "") {
                    SlackTool::slack($msg, "#debuglog", $charonBot->displayData->DisplayName);
                }
            }else{
                echo('no message Sent');
            }
        }
}
?>