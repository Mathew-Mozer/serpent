<?php
require "../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../models/PromotionModel.php";
date_default_timezone_set('America/Los_Angeles');
$conn = new DbCon();
//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'add') {
        $promotion = new PromotionModel($conn->insert_database());
        $className = $promotion->getPromotionModelName($_POST['promotionTypeId']);
        require '../models/promotionmodels/'.$className.'.php';
        $addedPromotion = $promotion->addPromotion($_POST['promotionTypeId'], $_POST['propertyId'], $_POST['scene_id'],$_POST['chosenSkin']);
        $_POST['promotionId'] = $addedPromotion['promo_id'];
        $reflectionClass = new ReflectionClass($className);
        $classReference = $reflectionClass->newInstanceArgs(array($conn->insert_database()));
        $classReference->add($_POST);
        $response = $addedPromotion;
        header('content-type:application/json');
        echo json_encode($response);
    } else if ($_POST['action'] == 'update'){
        $promotion = new PromotionModel($conn->insert_database());
        $className = $promotion->getPromotionModelName($_POST['promotionTypeId']);
        require '../models/promotionmodels/'.$className.'.php';
        $reflectionClass = new ReflectionClass($className);
        $classReference = $reflectionClass->newInstanceArgs(array($conn->insert_database()));
        $oldRecord = $classReference->get($_POST['promotionId']);
        $newRecord = array_merge($oldRecord, $_POST);
        $classReference->update($newRecord);
        $promotion->setUpdatedTimestamp($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($newRecord);
    } else if($_POST['action'] == 'read'){
        $promotion = new PromotionModel($conn->insert_database());
        $className = $promotion->getPromotionModelName($_POST['promotionTypeId']);
        require '../models/promotionmodels/'.$className.'.php';
        $reflectionClass = new ReflectionClass($className);
        $classReference = $reflectionClass->newInstanceArgs(array($conn->insert_database()));
        $response = $classReference->get($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    } else if($_POST['action'] == 'saveTemplate'){
        $promotion = new PromotionModel($conn->insert_database());
        $className = $promotion->getPromotionModelName($_POST['promotionTypeId']);
        require '../models/promotionmodels/'.$className.'.php';
        $addedPromotion = $promotion->saveTemplate($_POST);
        $_POST['promotionId'] = $addedPromotion;
        $reflectionClass = new ReflectionClass($className);
        $classReference = $reflectionClass->newInstanceArgs(array($conn->insert_database()));
        $classReference->add($_POST);
    } else if($_POST['action'] == 'getTemplates') {
        $promotion = new PromotionModel($conn->read_database());
        $response = $promotion->getTemplates($_POST);
        header('content-type:application/json');
        echo json_encode($response);
    } else if ($_POST['action'] == 'getTemplateValues') {
        $promotion = new PromotionModel($conn->insert_database());
        $className = $promotion->getPromotionModelName($_POST['promotionTypeId']);
        require '../models/promotionmodels/'.$className.'.php';
        $reflectionClass = new ReflectionClass($className);
        $classReference = $reflectionClass->newInstanceArgs(array($conn->insert_database()));
        $response = $classReference->get($_POST['templateId']);
        header('content-type:application/json');
        echo json_encode($response);
    }else if (($_POST['action'] == 'updatePromotionStatus')){
        $promotion = new PromotionModel($conn->insert_database());
        $response = $promotion->updatePromotionStatus($_POST['promotionId'],$_POST['nextStatus']);
        header('content-type:application/json');
        echo json_encode($response);
    }else if (($_POST['action'] == 'updateLockStutus')){
        $promotion = new PromotionModel($conn->insert_database());
        $response = $promotion->updateLockStatus($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    }else if (($_POST['action'] == 'archivePromotion')){
        $promotion = new PromotionModel($conn->insert_database());
        $response = $promotion->archivePromotion($_POST['promotionId']);
        header('content-type:application/json');
        echo json_encode($response);
    }
}
?>