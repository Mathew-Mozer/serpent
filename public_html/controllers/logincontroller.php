<?php
/**
 * This validates user login credentials
 */

require('../models/LoginValidationModel.php');

//If call is sent by post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    //If user is logging out destroy session
    if ($_POST['action'] == 'logout') {
        var_dump($_SESSION);
        session_destroy();

    //If user is logging in, set session variable
    } else {

        $validator = new LoginValidation($_POST['userName'], $_POST['password']);
        $response = $validator->validateLogin();

        if ($response['valid'] === 'yes') {
            $_SESSION['user'] = $_POST['userName'];
            $_SESSION['loggedIn'] = 'true';
            $_SESSION['userId'] = $response['userId'];
            $_SESSION['isGod'] = $response['godMode'];
        }

        header('content-type:application/json');
        echo json_encode($response);
    }
}else{

if ($_GET['action'] == 'toggleDebug') {
    if (isset($_SESSION['debug'])) {
        $_SESSION['debug'] = !$_SESSION['debug'];

        echo $_SESSION['debug'];
    }else{
        $_SESSION['debug']=true;
        echo $_SESSION['debug'];
    }
}
}
?>
