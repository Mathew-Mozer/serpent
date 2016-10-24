<?php
    /*
     * Controller for the options modal.
     */
    require "../models/optionsmodel.php";
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

    }
?>