<?php
/**
 * User: Christopher Barbour
 * Date: 10/16/16
 * Time: 8:47 PM
 */
require('../models/loginValidation.php');

//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
?>