<?php
session_start();
/**
 * User: Christopher Barbour
 * Date: 10/5/16
 * Time: 9:19 AM
 *
 * Driver for loginValidation class
 */
require ('loginValidation.php');
$_SESSION['loggedIn'] = 'false';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validator = new LoginValidation($_POST['userName'], $_POST['password']);
    $response = $validator->validateLogin();

    if($response['valid']==='yes'){
        $_SESSION['user'] = $_POST['userName'];
        $_SESSION['loggedIn'] = 'true';
    }
    header('content-type:application/json');
    echo json_encode($response);
}
?>