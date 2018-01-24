<?php
/**
 * This file CRUDs displays
 */

require "../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../models/PropertyDisplays.php";
require "../models/PromotionModel.php";
$dbcon = NEW DbCon();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'getSingleDisplay') {
        $propertyDisplayModel = new PropertyDisplays($dbcon->read_database(), 0);
        $result = $propertyDisplayModel->getDisplayWithId($_POST['displayId']);
        $array = array('id' => $result->getId(), 'name' => $result->getName(), 'propertyId' => $result->getPropertyId(),
            'serial' => $result->getSerial(), 'macAddress' => $result->getMacAddress(),'linkcode'=>$result->getLinkCode());
        $promotionModel = new PromotionModel($dbcon->read_database());
        $propertyList = $promotionModel->getPromotionProperties();
        $properties = [];
        foreach ($propertyList as $property) {
            $propertyInfo = [];
            $propertyInfo['propertyId'] = $property['property_id'];
            $propertyInfo['propertyName'] = $property['property_name'];
            array_push($properties, $propertyInfo);
        }
        $array['properties'] = $properties;
        echo json_encode($array);
    } else if ($_POST['action'] == 'assignDisplay') {
        $propertyDisplayModel = new PropertyDisplays($dbcon->update_database(), 0);
        $updated['updated'] = false;
        $values = [];
        $values['displayId'] = $_POST['displayId'];
        $values['propertyId'] = $_POST['propertyId'];
        if ($propertyDisplayModel->assignDisplayWithId($_POST)) {
            $updated['updated'] = true;
        }
        return json_encode($updated);
    } else if ($_POST['action'] == 'updateDisplaySettings') {
        $displayProperties = new PropertyDisplays($dbcon->update_database(), $_POST['propertyId']);
        $displayProperties->updateDisplayWithId($_POST['displayId'], $_POST['displayName'], $_POST['displayLocation']);
    } else if ($_POST['action'] == 'addPromotion') {
        $displayProperties = new PropertyDisplays($dbcon->insert_database(), null);
        $displayProperties->addPromotionToDisplay($_POST);
    } else if ($_POST['action'] == 'removePromotion') {
        $displayProperties = new PropertyDisplays($dbcon->delete_database(), null);
        $displayProperties->removePromotionFromDisplay($_POST['promotionId'], $_POST['displayId']);
    } else if ($_POST['action'] == 'updatePromotionDisplaySettings') {
        $displayProperties = new PropertyDisplays($dbcon->delete_database(), null);
        $displayProperties->updatePromotionDisplaySettings(
            $_POST['promotionId'], $_POST['displayId'], $_POST['sceneDuration'], $_POST['skinId']);
    } else if ($_POST['action'] == 'updateLockStatus') {
        $displayProperties = new PropertyDisplays($dbcon->update_database(), null);
        $displayProperties->setLockedPromotion($_POST['promotionId'], $_POST['displayId']);

    } else if ($_POST['action'] == 'changeMonitorStatus') {
        $displayProperties = new PropertyDisplays($dbcon->update_database(), null);
        $response = $displayProperties->updateDisplayMonitorState($_POST['displayId'], $_POST['monitorState']);
        header('content-type:application/json');
        echo json_encode($response);
    } else if ($_POST['action'] == 'updatePromotionDisplayOptions') {
        $displayProperties = new PropertyDisplays($dbcon->update_database(), null);
        $response = $displayProperties->updatePromotionDisplayOptions($_POST);
        echo(var_dump($response));
        var_dump($_POST);
    } else if ($_POST['action'] == 'SendCommandToDisplay') {
        $displayProperties = new PropertyDisplays($dbcon->update_database(), null);
        $display = $displayProperties->getDisplayWithId($_POST['display_id']);
        $command = array();
        $command['command'] = $_POST['command'];
        if(isset( $_POST['packageName'])){
            $command['packageName'] = $_POST['packageName'];
        }

        if($display->getFCMToken()==""||!isset($_POST['FCMToken'])){
            $fcmToken = 0;
            $fcmKey = $_POST['FCMToken'];
        }else{
            $fcmToken = 1;
            $fcmKey = $display->getFCMToken();
        }
        $response = $display->sendMessage($command,$fcmKey,$fcmToken);
        echo $response;
        var_dump($_POST);
    }

}
?>