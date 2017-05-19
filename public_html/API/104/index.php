<?php
require '../../dependencies/php/HelperFunctions.php';
require getServerPath() . "dbcon.php";
include '../Classes/DisplayData.php';
include '../Classes/Scene.php';
require_once "../../models/PromotionModel.php";
require "../../models/promotionmodels/TimeTargetModel.php";

require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
$TimeTargetModel = new TimeTargetModel($dbcon->insert_database());
$promotion = new PromotionModel($dbcon->insert_database());
header('Content-Type: application/json; charset=utf-8');
date_default_timezone_set('America/Los_Angeles');
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 10/27/2016
 * Time: 12:25 PM
 */
//Global Variables
$displayData = new DisplayData();
$conn;
CheckDeviceCheck();
if (isset($_POST["action"])) {
    if (isset($_POST["macAddress"])) {
        $macAddress = $_POST["macAddress"];
    }

    switch ($_POST["action"]) {
        case "GetSettings":
            //Get Box Settings
            if (isBoxedRegistered($_POST["macAddress"])) {
                loadSceneData();
                if(isset($_POST["FireBaseToken"])) {
                    UpdateFireBaseToken($_POST["macAddress"], $_POST["FireBaseToken"]);
                }
            } else {
                registerDisplay($_POST["macAddress"]);
            }
            break;
        case "LogFromBox":
            $msg = "-" . $username . "- " . $_POST["logdata"];
            SlackTool::slack($msg, "#displaylog", $_POST["displayname"]);
            echo("success");
            break;
        case "UpdateFireBaseToken":
            UpdateFireBaseToken($_POST["macAddress"],$_POST["FireBaseToken"]);
            break;
        case "endTimeTarget":
            $TimeTargetModel->endTimeTarget($_POST);
            $promotion->setUpdatedTimestamp($_POST['promotionId']);
            echo("success");
            break;
        case "SaveSkinSettings":
            $skinElement = json_decode($_POST['skinData']);
            echo("The current Text Color is:".$skinElement->{'textcolor'});
            break;
    }
} else {
    echo "test";
}
function UpdateFireBaseToken($mac,$token){
    $dbcon = new DbCon();
    $conn = $dbcon->update_database();
    $sql = "UPDATE display SET display_gcmid=:newvalue WHERE display_mac_address=:mac;";
    $result = $conn->prepare($sql);
    $result->bindValue(':newvalue', $token, PDO::PARAM_STR);
    $result->bindValue(':mac', $mac, PDO::PARAM_STR);
    $result->execute();
}
function UpdateDisplayData($field, $value, $oldvalue, $displayid, $logtoslack)
{
    if ($logtoslack) {
        $msg = 'Attempting to Update ' . $displayid . ' ' . $field . ' from:' . $oldvalue . 'to:' . $value;
        SlackTool::slack($msg, "#api-log", 'DisplayBox');
    }
    global $conn;
    $dbcon = new DbCon();
    $conn = $dbcon->update_database();
    $sql = "UPDATE display SET $field=:newvalue WHERE display_id=:id;";
    $result = $conn->prepare($sql);
    $result->bindValue(':newvalue', $value, PDO::PARAM_STR);
    $result->bindValue(':id', $displayid, PDO::PARAM_STR);
    $result->execute();
}

function CheckDeviceCheck()
{
    global $displayData, $conn, $macAddress;

    $dbcon = new DbCon();
    $conn = $dbcon->read_database();
    $sql = 'select * from display where display_monitor>0';
    $statement = $conn->prepare($sql);
    $statement->execute(array($macAddress));
    foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
        $displayID = $result['display_id'];
        $displayName = $result['display_name'];
        $displayRedThreshold = $result['display_monitor_threshold_red'];
        $displayLastCheckin = strtotime($result['display_lastcheckin']);
        $displayMonitor = $result['display_monitor'];
        $curtime = time();
        if (($curtime - $displayLastCheckin) > $displayRedThreshold) {
            if ($displayMonitor == 1) {
                $msg = 'Help, I\'ve fallen and I can\'t get up';
                SlackTool::slack($msg, "#boxhealth", $displayName);
                UpdateDisplayData('display_monitor', 2, 1, $displayID, false);
            }
            //echo($displayName." is past checkin threshhold ".$curtime." - ".$displayLastCheckin);
        } else {
            //echo($displayName." is not past checkin threshhold ".$curtime." - ".$displayLastCheckin);
        }
    }
}

function UpdateDeviceTimeStamp($displayid, $field)
{
    global $conn;
    $dbcon = new DbCon();
    $conn = $dbcon->update_database();
    $sql = "UPDATE display SET $field=now() WHERE display_id=:id;";
    $result = $conn->prepare($sql);
    $result->bindValue(':id', $displayid, PDO::PARAM_STR);

    $tmpres = $result->execute();
}

function registerDisplay($macAddress)
{
    global $conn;
    $dbcon = new DbCon();
    $conn = $dbcon->insert_database();
    $sql = "INSERT INTO display (display_mac_address) VALUES (:macid);";
    $result = $conn->prepare($sql);
    $result->bindValue(':macid', $macAddress, PDO::PARAM_STR);
    $result->execute();

}

//Registers a display in the database by creating a new record with

function loadSceneData()
{
    global $displayData, $conn, $macAddress;

    $dbcon = new DbCon();
    $conn = $dbcon->read_database();
    //$sql = 'SELECT *,display.property_id as prid,promotion_skin,promotion_status,scene_effectid,display_monitor,display_lockedpromo,promotion_lastupdated,scene_duration,display_appversion,display_name, promotion.promotion_id, promotion.promotion_sceneid, promotion_property.skin_id,promotion_type_id, property.property_id, display.display_id,property.property_asset_bundle_url,property.property_asset_bundle_windows,property.property_asset_name,property.property_default_logo,property.property_name FROM display,property,promotion_property,promotion,api WHERE api_id=display_api_id and promotion_property.property_id=property.property_id and display.property_id and promotion_property.display_id=display.display_id and promotion_property.promotion_id=promotion.promotion_id and promotion_status>0 and display.display_mac_address=?';
    $sql = "SELECT *,display.property_id as prid FROM display, property, api WHERE api_id=display_api_id and display.property_id=property.property_id and display.display_mac_address=?";
    $statement = $conn->prepare($sql);
    $statement->execute(array($macAddress));
    $tmpSceneArray = array();
    foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
        //$displayData->BundleAndroidUrl="http://connect.typhonpacificstudios.com/tv/assetbundles/tpsAndroid.unity3d";
        $displayData->BundleAndroidUrl = "http://svr1.typhonpacific.com/Chimera/Connect/TV/AssetBundles/" . $result['property_asset_bundle_url'];
        $displayData->BundleWindowsURL = "http://svr1.typhonpacific.com/Chimera/Connect/TV/AssetBundles/" . $result['property_asset_bundle_windows'];
        $displayData->propertyID = $result['prid'];
        $displayData->BundleVer = 1;
        $displayData->AssetName = $result['property_asset_name'];
        $displayData->DefaultLogo = $result['property_default_logo'];
        $displayData->lockedScene = $result['display_lockedpromo'];
        $displayData->DisplayName = $result['display_name'];
        $displayData->AppVersion = $result['display_appversion'];
        $displayData->displayID = $result['display_id'];
        $displayData->monitor = $result['display_monitor'];
        $displayData->apiurl = $result['api_url'];
        $displayData->width = $result['display_width'];
        $displayData->height = $result['display_height'];
        $displayData->fitw = (bool)$result['display_fitw'];
        $displayData->fith = (bool)$result['display_fith'];
        $displayData->flip = (bool)$result['display_flip'];
        $displayData->debug = (bool)$result['display_debug'];
        $displayData->sceneList = loadScenes($result);
        //Add Scenes to Display
        //echo("Promoid:".$result[promotion_id]." Promotion Type ID".$result[promotion_type_id]." skinid:".$result[skin_id]." sceneid".$result[promotion_sceneid]."<br><br><br>");

    }

    if ($displayData->displayID != 0) {
        if ($_POST["appVersion"] != $displayData->AppVersion) {
            UpdateDisplayData('display_appversion', $_POST["appVersion"], $displayData->AppVersion, $displayData->displayID, true);

        }
        UpdateDeviceTimeStamp($displayData->displayID, 'display_lastcheckin');
        if ($displayData->monitor == 2) {
            UpdateDisplayData('display_monitor', 1, 1, $displayData->displayID, false);
            UpdateDeviceTimeStamp($displayData->displayID, 'display_uptimestart');
            $msg = 'That was rough but i\'m working again';
            SlackTool::slack($msg, "#boxhealth", $displayData->DisplayName);
        }

    }
    //Update Checkin Time

    if ($displayData->sceneList === null) {
        $tmpScene = new Scene(0, 0, 0, 0, 0, 0, 0, 0,0);
        $tmpScene->promotionStatus = 0;
        array_push($tmpSceneArray, $tmpScene);
        $displayData->sceneList = $tmpSceneArray;
    }


    //Output DisplayData to DisplayBox
    print_r(json_encode($displayData));

}

function loadScenes($display)
{

    global $displayData, $conn, $macAddress;

    $dbcon = new DbCon();
    $conn = $dbcon->read_database();
    $sql = "SELECT * FROM promotion_property,promotion WHERE promotion_property.display_id=? and promotion_property.promotion_id=promotion.promotion_id and promotion_status>0";
    $statement = $conn->prepare($sql);
    $statement->execute(array($display['display_id']));
    $tmpSceneArray = array();
    foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {

        //if ($result['promotion_skin'] != 0) {
         //   $tmpSkinID = $result['promotion_skin'];
        //}else{

        //}
        $tmpSkinID = $result['skin_id'];
        $tmpScene = new Scene($result['promotion_id'], $result['promotion_type_id'], $result['scene_duration'], $tmpSkinID, $result['promotion_sceneid'], $result['promotion_lastupdated'], $result['scene_effectid'], $display['prid'],$result['promotion_animation']);
        $tmpScene->PromoPropertyID=$result['promotion_property_id'];
        $tmpScene->tmpSkinID = $tmpSkinID;
        switch ($result['promotion_status']) {
            case 0:
            case 1:
            case 2:
                $tmpScene->promotionStatus = $result['promotion_status'];
                break;
            case 3:
                if (shouldShowPromo($result['promotion_id'])) {
                    $tmpScene->promotionStatus = '1';
                } else {
                    $tmpScene->promotionStatus = '2';
                }
                break;

        }
        //array_push($tmpSceneArray, $tmpScene);
        if ($display['display_lockedpromo'] == 0) {
            array_push($tmpSceneArray, $tmpScene);

        } else {
            if ($displayData->lockedScene == $tmpScene->promoID) {
                array_push($tmpSceneArray, $tmpScene);

            } else {
                //echo("didn't add: ".$tmpScene->promoID." lockedpromo: ".$displayData->lockedScene."\n");
            }
        }

    }






    return $tmpSceneArray;
}

function currentTime()
{
    //return "10:01:00";
    return date('H:i:s');
}

function currentDay($ses)
{
    //$curday = 5;
    $curDay = $ses;

    return $curDay;
}

function shouldShowPromo($promoid)
{
    global $dbcon;
    $val = false;
    $promotion = new PromotionModel($dbcon->read_database());
    $values['promoId'] = $promoid;
    $sessions = $promotion->getSessions($values);

    foreach ($sessions as $session) {

        //echo("\n\ncurrent time: " . currentTime() . "\nstarttime: " . $session['promotion_sessiontime_starttime'] . "\nendtime: " . $session['promotion_sessiontime_endtime'] . "\n");
        //echo("\ncurdayow: " . currentDay($session['curdayow']) . "\nStart Day:" . $session['promotion_sessiontime_startday'] . "\nEnd Day:" . $session['promotion_sessiontime_endday'] . "\n\n");
        //
        //current day is the same as the start day and end day
        if ($session['promotion_sessiontime_startday'] == $session['promotion_sessiontime_endday']) {

            //if current day is the start day
            if (currentDay($session['curdayow']) == $session['promotion_sessiontime_startday']) {
                //if start time is before the end time (single day)
                if ($session['promotion_sessiontime_starttime'] < $session['promotion_sessiontime_endtime']) {
                    //if current time is before end time
                    if (currentTime() < $session['promotion_sessiontime_endtime'] & currentTime() > $session['promotion_sessiontime_starttime']) {

                        return true;
                        //if current time is after end time
                    } else {
                        $val = false;

                    }
                } //if start time is after end time on same day the following week
                elseif ($session['promotion_sessiontime_starttime'] > $session['promotion_sessiontime_endtime']) {
                    //if current time is after end time
                    if (currentTime() > $session['promotion_sessiontime_endtime']) {

                        $val = false;
                    } //if current time is before end time
                    else {

                        return true;
                    }
                }
            } else {
                if ($session['promotion_sessiontime_endtime'] < $session['promotion_sessiontime_starttime']) {
                    if (currentTime() > $session['promotion_sessiontime_starttime'] || currentTime() < $session['promotion_sessiontime_endtime']) {


                        return true;
                    } else {

                        $val = false;
                    }
                }

            }
        }//if start day is after end day (ends the next week)
        elseif ($session['promotion_sessiontime_startday'] > $session['promotion_sessiontime_endday']) {

            if (currentDay($session['curdayow']) >= $session['promotion_sessiontime_startday']) {
                if (currentTime() > $session['promotion_sessiontime_starttime']) {

                    return true;

                } else {

                    $val = false;

                }
            } elseif (currentDay($session['curdayow']) <= $session['promotion_sessiontime_endday']) {
                if (currentTime() < $session['promotion_sessiontime_endtime']) {
                    return true;
                } else {

                    $val = false;

                }

            } elseif (currentDay($session['curdayow']) < $session['promotion_sessiontime_startday'] & currentDay($session['curdayow']) > $session['promotion_sessiontime_endday']) {

                $val = false;

            }


        }//if start day is before end day
        elseif ($session['promotion_sessiontime_startday'] < $session['promotion_sessiontime_endday']) {
            if (currentTime() > $session['promotion_sessiontime_starttime']) {
                return true;
            } else {
                $val = false;
            }


        }
        // promotion_sessiontime_startday
        // promotion_sessiontime_starttime
        // promotion_sessiontime_endday
        // promotion_sessiontime_endtime
        //
        //$val=true;
    }
    return $val;
}

function isBoxedRegistered($macAddress)
{
    //If box registered to 0 then return message saying box isn't registered to a casino
    //Else return settings
    global $conn;
    $dbcon = new DbCon();
    $conn = $dbcon->read_database();
    $sql = 'SELECT * FROM display WHERE display_mac_address=?';
    $statement = $conn->prepare($sql);
    $statement->execute(array($macAddress));

    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo($macAddress);
        return false;
    } else {
        return true;
    }

}

?>