<?php
/**
 * This file controls checking box up/down status
 */

require "../dependencies/php/HelperFunctions.php";
require_once getServerPath()."dbcon.php";
require "../models/BoxCheckModel.php";
$dbcon = NEW DbCon();

$statusCheck = new BoxCheckModel($dbcon->read_database());
switch ($_GET['TypeOfStatus']){
    case "box":
        $result = $statusCheck->checkDownTime();
        echo json_encode($result);
        break;
    case "API":
        $result = $statusCheck->geturi();
        echo json_encode($result);
        break;
}



?>