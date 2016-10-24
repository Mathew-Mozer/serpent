<?php
/**
 * User: Christopher Barbour
 * Date: 10/16/16
 * Time: 8:47 PM
*/
require "../modals/OptionsModal.php";

$_POST['id'] = 1;
$_POST['method'] = 'get';
if ($_SERVER['REQUEST_METHOD'] == 'POST'|| 0 == 0) {
    $optionsModal = new OptionsModal($_POST['id']);
    if($_POST['method'] == 'get') {
        $options = $optionsModal->getPromotionSettings();
        var_dump($options);
        echo json_encode($options);

    } else if($_POST['method'] == 'update') {
        $options = $optionsModal->updatePromotionSettings($_POST['settings']);
    }
}
?>