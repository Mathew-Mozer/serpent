<?php
    require ('../models/BoxModel.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($_POST['action'] == 'getSingleBox'){
            $box = new BoxModel();
            $result = $box->getBoxWithId($_POST['boxId']);
            $array = array('id'=>$result->getId(),'name'=>$result->getName(),'casinoId'=>$result->getCasinoId(),
                    'serial'=>$result->getSerial(),'macAddress'=>$result->getMacAddress());
            echo json_encode($array);
        }
    }
?>