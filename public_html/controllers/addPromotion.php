<?php
require "../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../modals/PromotionModal.php";
$dbcon = NEW DbCon();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $promotion = new PromotionModal($dbcon->insert_database());
    $addResponse = $promotion->addPromotion($_POST['promotionId'], $_POST['casinoId']);
    $response = $promotion->getPromotionImage($_POST['promotionId']);

    header('content-type:application/json');
    echo json_encode($response);
}


?>