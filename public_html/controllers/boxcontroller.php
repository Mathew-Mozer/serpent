<?php
require "../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../models/CasinoBoxes.php";
require "../models/PromotionModel.php";

$dbcon = NEW DbCon();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    if ($_POST['action'] == 'getSingleBox') {
        $casinoBoxModel = new CasinoBoxes($dbcon->read_database(),0);
        $result = $casinoBoxModel->getBoxWithId($_POST['boxId']);
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
        //var_dump($array);
        echo json_encode($array);
    } else if ($_POST['action'] == 'updateBox'){
        var_dump($_POST);
        $casinoBoxModel = new CasinoBoxes($dbcon->update_database(),0);
        $updated['updated'] = false;
        $values = [];
        $values['boxId'] = $_POST['boxId'];
        $values['casinoId'] = $_POST['casinoId'];
        if($casinoBoxModel->updateBoxWithId($values)){
            $updated['updated'] = true;
        }
        return json_encode($updated);
    }

}
?>