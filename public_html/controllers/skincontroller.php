<?php
require "../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../models/SkinModel.php";
date_default_timezone_set('America/Los_Angeles');
$conn = new DbCon();
//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'saveskin') {
        $skinModel = new SkinModel($conn->insert_database());
        $response = $skinModel->add($_POST);
        header('content-type:application/json');
        echo json_encode($response);
    }
}
?>