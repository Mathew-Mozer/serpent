<?php

/**
 * This file retrieves and updates display information
 */

require "../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../models/PropertyDisplays.php";
require "../models/PromotionModel.php";

$dbcon = NEW DbCon();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

    } else if ($_POST['action'] == 'assignDisplay'){
        $propertyDisplayModel = new PropertyDisplays($dbcon->update_database(),0);
        $updated['updated'] = false;
        $values = [];
        $values['displayId'] = $_POST['displayId'];
        $values['propertyId'] = $_POST['propertyId'];
        if($propertyDisplayModel->assignDisplayWithId($values)){
            $updated['updated'] = true;
        }
        return json_encode($updated);

    } else if ($_POST['action'] == 'update') {
        $displayProperties = new PropertyDisplays($dbcon->update_database(), $_POST['propertyId']);
        $displayProperties->updateDisplayWithId($_POST['displayId'],$_POST['displayName'], $_POST['displayLocation']);
        $displayProperties->updatePromotionsInDisplay($dbcon->delete_database(),$dbcon->insert_database(),$_POST['displayId'],$_POST['propertyId'], $_POST['promotions']);
        header('content-type:application/json');
        echo json_encode(array("success"=>"updated display"));
    }

}
?>
