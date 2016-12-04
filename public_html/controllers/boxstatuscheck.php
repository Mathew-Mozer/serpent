<?php
/**
 * Created by PhpStorm.
 * User: sking
 * Date: 12/3/2016
 * Time: 12:49 PM
 */

require "../dependencies/php/HelperFunctions.php";
require getServerPath()."dbcon.php";
require "../models/BoxCheckModel.php";
$dbcon = NEW DbCon();

$promotion = new PromotionModel($dbcon->read_database());

?>