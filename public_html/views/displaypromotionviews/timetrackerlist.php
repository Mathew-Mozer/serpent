<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 1/16/2017
 * Time: 2:56 AM
 */
require_once("../../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
require "../../models/promotionmodels/TimeTargetModel.php";
$TimeTargetModel = new TimeTargetModel($dbcon->read_Database());
$TimeTargets = $TimeTargetModel->getAllSessions($_POST['promoid']);

if (count($TimeTargets) > 0) {
    foreach ($TimeTargets as $timeTarget) {
        ?>

        <tr>
            <td><?php echo($timeTarget['time_target_session_id']) ?></td>
            <td><?php echo($timeTarget['time_target_seed']) ?></td>
            <td><?php echo($timeTarget['time_target_start']) ?></td>
            <td><?php
        if (strpos($timeTarget['time_target_end'], '000') !== false) {
            echo("Current Time");
        }else{
            echo($timeTarget['time_target_end']);
        }
                ?></td>
            <td><?php echo($timeTarget['time_target_increment_min']) ?></td>
            <td><?php echo($timeTarget['time_target_add']) ?></td>
            <td><?php echo(payTimeTarget($timeTarget)) ?></td>
            <td><?php
                $canDelete = 1;
                if ($timeTarget['time_target_end'] == "0000-00-00 00:00:00") {
                ?>
                <span name="test-<?php echo($timeTarget['time_target_session_id']) ?>"
                      data-target-id="<?php echo($timeTarget['time_target_session_id']) ?>"
                      class="glyphicon glyphicon-usd time-table-button time-table-end">
            <?php
            } else {
                if (!$timeTarget['time_target_approved']) { ?>
                    <span data-target-id="<?php echo($timeTarget['time_target_session_id']) ?>"
                          class="glyphicon glyphicon-ok-sign time-table-button time-table-confirm"></span>
                    <span data-target-id="<?php echo($timeTarget['time_target_session_id']) ?>"
                          class="glyphicon glyphicon-remove-sign time-table-button time-table-button-red time-table-unconfirm"></span>

                    <?php
                    $canDelete = 0;
                } else {
                    $canDelete = 0;
                }
            }
            ?>

                </span>

                    <span data-target-id="<?php echo($timeTarget['time_target_session_id']) ?>"
                          class="glyphicon glyphicon-trash time-table-button time-table-button-black time-table-archive"></span>
            </td>
        </tr>
        <?php
    }
}

function payTimeTarget($timeTarget)
{
    $PerSecondIncrease = $timeTarget['time_target_add'] / ($timeTarget['time_target_increment_min'] * 60);
    $sd = $timeTarget['time_target_seed'];
    $incAmt = $sd + round((SecondCount($timeTarget['time_target_start'], $timeTarget['time_target_end']) * $PerSecondIncrease), 2);
    if($incAmt<0){
        $incAmt=0;
    }
    return "$".$incAmt;
}

function SecondCount($start, $end)
{

    if (strpos($end, '000') !== false) {
        $endTime = strtotime(date("Y/m/d H:i:s"));
    } else {
        $endTime = strtotime($end);
    }
    $seconds = strtotime($start) - $endTime;
    return -$seconds;

}

?>