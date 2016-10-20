<?php
/**
 * Author: Chris Barbour
 *
 * Driver for loginValidation class
 */
require('../models/loginValidation.php');

//if call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validator = new LoginValidation($_POST['userName'], $_POST['password']);
    $response = $validator->validateLogin();

    //set session variables
    if($response['valid']==='yes'){
        $_SESSION['user'] = $_POST['userName'];
        $_SESSION['loggedIn'] = 'true';
    }
    header('content-type:application/json');
    echo json_encode($response);
}
?>