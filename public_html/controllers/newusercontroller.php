<?php

/**
 * This adds a new user to the database
 */

require "../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../models/UsersModel.php";
$dbcon = NEW DbCon();

//Add the new promotion to the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new UsersModel($dbcon->insert_database());
    $addResponse = $user->addUser($_POST['userName'], $_POST['userPassword'], $_POST['propertyID']);

    //header('content-type:application/json');
    //echo json_encode($response);
}
?>