<?php
require "../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../models/CasinoDisplays.php";
require "../models/PromotionModel.php";

$dbcon = NEW DbCon();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['action'] == 'getSingleDisplay') {
        $casinoDisplayModel = new CasinoDisplays($dbcon->read_database(),0);
        $result = $casinoDisplayModel->getDisplayWithId($_POST['displayId']);
        $array = array('id' => $result->getId(), 'name' => $result->getName(), 'casinoId' => $result->getCasinoId(),
            'serial' => $result->getSerial(), 'macAddress' => $result->getMacAddress());

        $promotionModel = new PromotionModel($dbcon->read_database());
        $casinoList = $promotionModel->getPromotionCasinos();
        $casinos = [];
        foreach ($casinoList as $casino){
            $casinoInfo = [];
            $casinoInfo['casinoId'] = $casino['id'];
            $casinoInfo['casinoName'] = $casino['casinoName'];
            array_push($casinos,$casinoInfo);
        }
        $array['casinos'] = $casinos;
        echo json_encode($array);
    } else if ($_POST['action'] == 'assignDisplay'){
        $casinoDisplayModel = new CasinoDisplays($dbcon->update_database(),0);
        $updated['updated'] = false;
        $values = [];
        $values['displayId'] = $_POST['displayId'];
        $values['casinoId'] = $_POST['casinoId'];
        if($casinoDisplayModel->assignDisplayWithId($values)){
            $updated['updated'] = true;
        }
        return json_encode($updated);
    } else if ($_POST['action'] == 'update') {
        $displayCasinos = new CasinoDisplays($dbcon->update_database(), $_POST['casinoId']);
        $displayCasinos->updateDisplayWithId($_POST['displayId'],$_POST['displayName'], $_POST['displayLocation']);
        $displayCasinos->updatePromotionsInDisplay($dbcon->delete_database(), $dbcon->insert_database(),
            $_POST['displayId'],$_POST['casinoId'], $_POST['promotions']);
        header('content-type:application/json');
        echo json_encode(array("success"=>"updated display"));
    }

}
?>
