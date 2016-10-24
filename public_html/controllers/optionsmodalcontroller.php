<?php
    /*
     * Controller for the options modal.
     */
    require "../models/optionsmodel.php";
    require "../modals/permissionModal.php";

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
        echo "Here";
    } else if ($_POST['action'] == 'canDelete') {
         $permission = new PermissionModal($conn->read_database(),$_POST['permission']);
         echo json_encode(array("permission"=>$permission->canDeleteCasinoPromotion($_POST['id'])));
    }

?>