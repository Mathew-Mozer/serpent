<?php
/**
 * This file CRUDs displays
 */

require "../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../models/PropertyDisplays.php";
require "../models/PromotionModel.php";

$dbcon = NEW DbCon();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Get properties for a single display
    if ($_POST['action'] == 'getSingleDisplay') {
        $propertyDisplayModel = new PropertyDisplays($dbcon->read_database(),0);
        $result = $propertyDisplayModel->getDisplayWithId($_POST['displayId']);
        $array = array('id' => $result->getId(), 'name' => $result->getName(), 'propertyId' => $result->getPropertyId(),
            'serial' => $result->getSerial(), 'macAddress' => $result->getMacAddress());


        $promotionModel = new PromotionModel($dbcon->read_database());
        $propertyList = $promotionModel->getPromotionProperties();
        $properties = [];
        foreach ($propertyList as $property){
            $propertyInfo = [];
            $propertyInfo['propertyId'] = $property['property_id'];
            $propertyInfo['propertyName'] = $property['property_name'];
            array_push($properties,$propertyInfo);
        }
        $array['properties'] = $properties;
        echo json_encode($array);
    }

    //Assign a display to a property
    else if ($_POST['action'] == 'assignDisplay'){
        $propertyDisplayModel = new PropertyDisplays($dbcon->update_database(),0);
        $updated['updated'] = false;
        $values = [];
        $values['displayId'] = $_POST['displayId'];
        $values['propertyId'] = $_POST['propertyId'];
        if($propertyDisplayModel->assignDisplayWithId($values)){
            $updated['updated'] = true;
        }
        return json_encode($updated);
    }

    //This updates the display settings
    else if ($_POST['action'] == 'updateDisplaySettings') {
        $displayProperties = new PropertyDisplays($dbcon->update_database(), $_POST['propertyId']);
        $displayProperties->updateDisplayWithId($_POST['displayId'],$_POST['displayName'], $_POST['displayLocation']);
    }

    //This adds a promotion to a display
    else if ($_POST['action'] == 'addPromotion'){
        $displayProperties = new PropertyDisplays($dbcon->insert_database(), null);
        $displayProperties->addPromotionToDisplay();
    }

    //This removes a promotion from a display
    else if ($_POST['action'] == 'removePromotion'){
        $displayProperties = new PropertyDisplays($dbcon->delete_database(), null);
        $displayProperties->removePromotionFromDisplay($_POST['promotionId'],$_POST['displayId']);
    }

    //This updates a promotion display setting
    else if ($_POST['action'] == 'updatePromotionDisplaySettings'){
        $displayProperties = new PropertyDisplays($dbcon->delete_database(), null);
        $displayProperties->updatePromotionDisplaySettings(
            $_POST['promotionId'],$_POST['displayId'],$_POST['sceneDuration'],$_POST['skinId']);

    } 

    //This is going to go away because this is garbage
    else if ($_POST['action'] == 'update') {
        $displayProperties = new PropertyDisplays($dbcon->update_database(), $_POST['propertyId']);
        $displayProperties->updateDisplayWithId($_POST['displayId'],$_POST['displayName'], $_POST['displayLocation']);
        $displayProperties->updatePromotionsInDisplay($dbcon->delete_database(),$dbcon->insert_database(),$_POST['displayId'],$_POST['propertyId'], $_POST['promotions']);
        header('content-type:application/json');
        echo json_encode(array("success"=>"updated display"));
    }

}
?>
