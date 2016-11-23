<?php
    /*
     * Controller for the options modal.
     */
    require "../models/OptionsModel.php";
    require "../models/PermissionModel.php";

    $conn = new DbCon();
    $optionsModal = new OptionsModel($_POST['id']);
    if($_POST['action'] == 'get') {
        $options = $optionsModal->getPromotionSettings();
        $json = json_encode($options);
        echo $json;
    } else if ($_POST['action'] == 'archive'){
        $result = $optionsModal->archivePromotion();
        if(!$result){
            throw new PDOException("Error Updating");
        }
    } else if ($_POST['action'] == 'submit') {

    } else if ($_POST['action'] == 'canDelete') {
         $permission = new PermissionModel($conn->read_database(),$_POST['permission']);
         echo json_encode(array("permission"=>$permission->hasPermissionById('promotion',$_POST['id'],'D')));
    }

?>
