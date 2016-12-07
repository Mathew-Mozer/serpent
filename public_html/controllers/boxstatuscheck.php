<?php
/**
 * This file controls checking box up/down status
 */

require "../dependencies/php/HelperFunctions.php";
require_once getServerPath()."dbcon.php";
require "../models/BoxCheckModel.php";
$dbcon = NEW DbCon();

$statusCheck = new BoxCheckModel($dbcon->read_database());


$result = $statusCheck->checkDownTime();

echo json_encode($result);

?>