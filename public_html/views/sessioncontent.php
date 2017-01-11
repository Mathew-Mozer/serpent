<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once "../models/PromotionModel.php";
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
$promotion = new PromotionModel($dbcon->read_database());
$sessions = $promotion->getSessions($_POST);

foreach ($sessions as $session) {
    ?>
    <tr>
        <td><?php echo(toDayOfWeek($session['promotion_sessiontime_startday'])) ?></td>
        <td><?php echo($session['promotion_sessiontime_starttime']) ?></td>
        <td><?php echo(toDayOfWeek($session['promotion_sessiontime_endday'])) ?></td>
        <td><?php echo($session['promotion_sessiontime_endtime']) ?></td>
        <td>
            <button type="button" class="delete-session-btn" data-session-id="<?php echo($session['promotion_sessiontime_id']) ?>">X</button>
        </td>
    </tr>
    <?php


}
function toDayOfWeek($val)
{
    switch ($val) {
        case 1:
            return "Sunday";
            break;
        case 2:
            return "Monday";
            break;
        case 3:
            return "Tuesday";
            break;
        case 4:
            return "Wednesday";
            break;
        case 5:
            return "Thursday";
            break;
        case 6:
            return "Friday";
            break;
        case 7:
            return "Saturday";
            break;
    }
}
?>