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
require "../../models/PromotionModel.php";
$TimeTargetModel = new TimeTargetModel($dbcon->read_Database());
$TimeTargets = $TimeTargetModel->getAllSessions($_POST['promoid']);
$TimeTarget = $TimeTargetModel->get($_POST['promoid']);
var_dump($TimeTarget);
$ttmult = 1;
if($TimeTarget["time_target_usemult"]){
    $baseTT =$TimeTarget;
    $ttmult = $TimeTarget["time_target_multiplier"];
    $TimeTargets = $TimeTargetModel->getAllSessions($TimeTarget["time_target_multpromoid"]);
    $TimeTarget["time_target_maxpayout"]=$baseTT["time_target_maxpayout"];
}
$promotion = new PromotionModel($dbcon->read_database());
if (count($TimeTargets) > 0) {
    foreach ($TimeTargets as $timeTarget) {
        ?>
        <tr>
            <td><?php echo($timeTarget['time_target_session_id']) ?></td>
            <td><?php
                $properties = $promotion->getPropertyByID($timeTarget['time_target_paidby']);

                echo $properties['property_abbr'];
            ?>
            </td>
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
            <td><?php echo($timeTarget['time_target_paidamt'])  ?></td>
            <td><?php
                $canDelete = 1;
                if ($timeTarget['time_target_end'] == "0000-00-00 00:00:00") {
                ?>
                <span name="test-<?php echo($timeTarget['time_target_session_id']) ?>"
                      data-target-paidby="<?php echo($_POST["propertyid"])?>" data-target-paidamt="<?php echo(payTimeTarget($timeTarget,0)) ?>"
                      data-target-id="<?php echo($timeTarget['time_target_session_id']) ?>"
                      class="glyphicon glyphicon-usd time-table-button time-table-end">
            <?php
            } else {
                if (!$timeTarget['time_target_approved']) { ?>
                    <span data-target-paidby="<?php echo($_POST["propertyid"])?>" data-target-paidamt="<?php echo(payTimeTarget($timeTarget,0)) ?>" data-target-id="<?php echo($timeTarget['time_target_session_id']) ?>"
                          class="glyphicon glyphicon-ok-sign time-table-button time-table-confirm"></span>
                    <span data-target-id="<?php echo($timeTarget['time_target_session_id']) ?>"
                          data-target-paidby="<?php echo($_POST["propertyid"])?>" data-target-paidamt="<?php echo(payTimeTarget($timeTarget,0)) ?>"
                          class="glyphicon glyphicon-remove-sign time-table-button time-table-button-red time-table-unconfirm"></span>
                    <?php
                    $canDelete = 0;
                } else {
                    $canDelete = 0;
                }
            }
            ?>

                </span>
                <?php if($canDelete){ ?>
                    <span data-target-id="<?php echo($timeTarget['time_target_session_id']) ?>"
                          data-target-paidby="<?php echo($_POST["propertyid"])?>" data-target-paidamt="<?php echo(payTimeTarget($timeTarget,0)) ?>"
                          class="glyphicon glyphicon-trash time-table-button time-table-button-black time-table-archive"></span>
                <?php }?>
            </td>

        </tr>
        <?php
    }
}

function payTimeTarget($timeTarget,$withDollarSign=1)
{
    global $TimeTarget,$ttmult;
    $sd = $timeTarget['time_target_seed']*$ttmult;
    if($timeTarget['time_target_increment_min']==0||$timeTarget['time_target_add']==0) {
        $incAmt = $sd;
    }else{
        if($TimeTarget['time_target_progressive']==1){
        $min=$timeTarget['time_target_increment_min'];
        $add = $timeTarget['time_target_add']*$ttmult;
        $PerSecondIncrease = $add / ($min * 60);
        $incAmt = $sd + round((SecondCount($timeTarget['time_target_start'], $timeTarget['time_target_end']) * $PerSecondIncrease), 2);
        }else{

            $tmp = round((SecondCount($timeTarget['time_target_start'], $timeTarget['time_target_end'])),2)/60;

            $tmp =floor($tmp/$timeTarget['time_target_increment_min']);
            $incAmt =$sd + ($tmp*$timeTarget['time_target_add']);
        }
    }
    if($incAmt<0){
        $incAmt=0;
    }

    if($TimeTarget['time_target_maxpayout']<$incAmt){
        $incAmt=$TimeTarget['time_target_maxpayout'];
    }
    if($withDollarSign){
        return "$".$incAmt;
    }
    return $incAmt;
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
function dateDifference($date_1, $date_2, $differenceFormat = '%d')
{
    $interval = date_diff($date_1, $date_2);

    return $interval->format($differenceFormat);

}

?>