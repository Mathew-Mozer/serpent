<?php
    /*
     * Controller for the options modal.
     */
    require "../models/OptionsModel.php";
    require "../models/PermissionModel.php";

    $conn = new DbCon();
    $optionsModal = new OptionsModel($_POST['id']);
    if($_POST['action'] == 'get') {
        $options = $optionsModal->getPromotionSettings($_POST['typeId']);
        $json = json_encode($options);
        echo $json;
    } else if ($_POST['action'] == 'archive'){
        $result = $optionsModal->archivePromotion();
        if(!$result){
            throw new PDOException("Error Updating");
        }
    } else if ($_POST['action'] == 'update') {
        $updated = $optionsModal->updatePromotionSettings($_POST['typeId'],$_POST['cashPrize'],$_POST['targetNumber']);
        return $updated;

    } else if ($_POST['action'] == 'canDelete') {
         $permission = new PermissionModel($conn->read_database(),$_POST['permission']);
         echo json_encode(array("permission"=>$permission->canDeleteCasinoPromotion($_POST['id'])));
    }

?>