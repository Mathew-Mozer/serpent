<?php
require '../../dependencies/php/HelperFunctions.php';
require getServerPath()."dbcon.php";
include '../Classes/DisplayData.php';
include '../Classes/Scene.php';

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
$macAddress=$_POST["macAddress"];
    switch ($_POST["action"]) {
        case "GetSettings":
            //Get Box Settings
            if (isBoxedRegistered($_POST["macAddress"])) {
                loadSceneData();

            } else {

                registerDisplay($_POST["macAddress"]);
            }
            break;
        case "LogFromBox":
            $msg = "-".$username."- ".$_POST["logdata"];
            SlackTool::slack($msg, "#displaylog",$_POST["displayname"]);
            echo("sucdcess");
            break;
    }
}else{
    echo "test";
}
function UpdateDisplayData($field,$value,$oldvalue,$displayid,$logtoslack){
    if($logtoslack) {
        $msg = 'Attempting to Update ' . $displayid . ' ' . $field . ' from:' . $oldvalue . 'to:' . $value;
        SlackTool::slack($msg, "#api-log", 'DisplayBox');
    }

    global $conn;
    $dbcon = new DbCon();
    $conn = $dbcon->update_database();
    $sql= "UPDATE display SET $field=:newvalue WHERE display_id=:id;";
    $result = $conn->prepare($sql);
    $result->bindValue(':newvalue', $value, PDO::PARAM_STR);
    $result->bindValue(':id', $displayid, PDO::PARAM_STR);
    $result->execute();
}
function CheckDeviceCheck(){
    global $displayData,$conn,$macAddress;

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
        if(($curtime-$displayLastCheckin) > $displayRedThreshold) {
            if($displayMonitor==1) {
                $msg = 'Help, I\'ve fallen and I can\'t get up';
                SlackTool::slack($msg, "#boxhealth", $displayName);
                UpdateDisplayData('display_monitor', 2, 1, $displayID, false);
                }
            //echo($displayName." is past checkin threshhold ".$curtime." - ".$displayLastCheckin);
        }else {
            //echo($displayName." is not past checkin threshhold ".$curtime." - ".$displayLastCheckin);
        }
    }
}
function UpdateDeviceTimeStamp($displayid,$field){
    global $conn;
    $dbcon = new DbCon();
    $conn = $dbcon->update_database();
    $sql= "UPDATE display SET $field=now() WHERE display_id=:id;";
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
    global $displayData,$conn,$macAddress;

    $dbcon = new DbCon();
    $conn = $dbcon->read_database();
    $sql = 'SELECT promotion_status,scene_effectid,display_monitor,promotion_lastupdated,scene_duration,display_appversion,display_name, promotion.promotion_id, promotion.promotion_sceneid, promotion_property.skin_id,promotion_type_id, property.property_id, display.display_id,property.property_asset_bundle_url,property.property_asset_bundle_windows,property.property_asset_name,property.property_default_logo,property.property_name FROM display,property,promotion_property,promotion WHERE promotion_property.property_id=property.property_id and display.property_id and promotion_property.display_id=display.display_id and promotion_property.promotion_id=promotion.promotion_id and promotion_status>0 and display.display_mac_address=?';
    $statement = $conn->prepare($sql);
    $statement->execute(array($macAddress));
    $tmpSceneArray = array();
    foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
        //$displayData->BundleAndroidUrl="http://connect.typhonpacificstudios.com/tv/assetbundles/tpsAndroid.unity3d";
        $displayData->BundleAndroidUrl="http://svr1.typhonpacific.com/Chimera/Connect/TV/AssetBundles/".$result['property_asset_bundle_url'];
        $displayData->BundleWindowsURL="http://svr1.typhonpacific.com/Chimera/Connect/TV/AssetBundles/".$result['property_asset_bundle_windows'];
        $displayData->propertyID=$result['property_id'];
        $displayData->BundleVer=1;
        $displayData->AssetName=$result['property_asset_name'];
        $displayData->DefaultLogo=$result['property_default_logo'];
        $displayData->lockedScene=0;
        $displayData->DisplayName=$result['display_name'];
        $displayData->AppVersion=$result['display_appversion'];
        $displayData->displayID = $result['display_id'];
        $displayData->monitor = $result['display_monitor'];
        //Add Scenes to Display
        //echo("Promoid:".$result[promotion_id]." Promotion Type ID".$result[promotion_type_id]." skinid:".$result[skin_id]." sceneid".$result[promotion_sceneid]."<br><br><br>");
        $tmpScene = new Scene($result['promotion_id'],$result['promotion_type_id'],$result['scene_duration'],$result['skin_id'],$result['promotion_sceneid'],$result['promotion_lastupdated'],$result['scene_effectid']);
        $tmpScene->promotionStatus = $result['promotion_status'];
        array_push($tmpSceneArray,$tmpScene);
        $displayData->sceneList = $tmpSceneArray;

    }
    if($displayData->displayID!=0) {
        if ($_POST["appVersion"] != $displayData->AppVersion) {
            UpdateDisplayData('display_appversion', $_POST["appVersion"], $displayData->AppVersion, $displayData->displayID,true);

        }
        UpdateDeviceTimeStamp($displayData->displayID,'display_lastcheckin');
        if($displayData->monitor==2){
            UpdateDisplayData('display_monitor', 1,1,$displayData->displayID,false);
            UpdateDeviceTimeStamp($displayData->displayID,'display_uptimestart');
            $msg = 'That was rough but i\'m working again';
            SlackTool::slack($msg, "#boxhealth", $displayData->DisplayName);
        }

    }
    //Update Checkin Time

    if($displayData->sceneList===null){
        $tmpScene = new Scene(0,0,0,0,0,0,0);
        $tmpScene->promotionStatus = 0;
        array_push($tmpSceneArray,$tmpScene);
        $displayData->sceneList = $tmpSceneArray;
    }



    //Output DisplayData to DisplayBox
    print_r(json_encode($displayData));

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
    if(!$result)
    {
        echo ($macAddress);
        return false;
    }else{
        return true;
    }

}

?>