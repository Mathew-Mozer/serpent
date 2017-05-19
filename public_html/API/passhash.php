<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 4/25/2017
 * Time: 12:27 PM
 */
$options = ['cost' => 11];
$hashed_password = password_hash($_GET["pw"], PASSWORD_BCRYPT, $options);
echo ($hashed_password);
?>