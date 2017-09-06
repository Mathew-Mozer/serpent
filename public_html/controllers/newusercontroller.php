<?php

/**
 * This adds a new user to the database
 */

require "../dependencies/php/HelperFunctions.php";
require getServerPath() . "dbcon.php";
require "../models/UsersModel.php";
require "../models/PermissionModel.php";
$dbcon = NEW DbCon();

//Add the new promotion to the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'newuser') {
        $user = new UsersModel($dbcon->insert_database());
        $addResponse = $user->addUser($_POST['userName'], $_POST['userPassword'], $_POST['propertyID']);
        header('content-type:application/json');
        echo json_encode($addResponse);
    }else if($_POST['action'] == 'updateUserPermission'){
        $permissions = new PermissionModel($dbcon->update_database(), $_POST['userId']);
        $response=$permissions->updateUserPermission($_POST['userId'],$_POST['propertyId'],$_POST['modType'],$_POST['permValue'],$_POST['tagId']);
        header('content-type:application/json');
        echo json_encode($response);
    }else if($_POST['action'] == 'updateUserPassword') {
        $user = new UsersModel($dbcon->update_database());
        $addResponse = $user->updateUserPassword($_POST['userId'], $_POST['userPassword']);
        header('content-type:application/json');
        echo json_encode($addResponse);
    }
}
?>
