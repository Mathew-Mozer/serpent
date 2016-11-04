<?php
/**
 * User: Christopher Barbour
 * Date: 10/16/16
 * Time: 8:47 PM
 */
session_start();
require('../models/LoginValidationModel.php');
//if call is sent by post
echo "here";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //if user is logging out

    if ($_POST['action'] == 'logout') {
        var_dump($_SESSION);
        session_destroy();
    } else {
        $validator = new LoginValidation($_POST['userName'], $_POST['password']);
        $response = $validator->validateLogin();
        //set session variables
        if ($response['valid'] === 'yes') {
            $_SESSION['user'] = $_POST['userName'];
            $_SESSION['loggedIn'] = 'true';
            $_SESSION['userId'] = $response['userId'];
        }
        header('content-type:application/json');
        echo json_encode($response);
    }
}
?>
