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
require "../../models/promotionmodels/PrizeEventModel.php";
$PrizeEventModel = new PrizeEventModel($dbcon->read_Database());
$PrizeWinners = $PrizeEventModel->getAllWinners($_POST['promoid']);
if (count($PrizeWinners) > 0) {
    foreach ($PrizeWinners as $PrizeWinner) {
        ?>

        <tr>
            <td><?php echo($PrizeWinner['prize_event_winner_id']) ?></td>
            <td><?php echo($PrizeWinner['prize_event_winner_name']) ?></td>
            <td><?php echo($PrizeWinner['prize_event_winner_prize']) ?></td>
            <td><?php echo($PrizeWinner['prize_event_winner_type']);         ?></td>
            <td><?php echo($PrizeWinner['prize_event_winner_left_icon']) ?></td>
            <td><?php echo($PrizeWinner['prize_event_winner_right_icon']) ?></td>
            <td><?php echo($PrizeWinner['prize_event_winner_timestamp']) ?></td>
            <td><button class="edit-new-prize-event" type="button" data-id="<?php echo($PrizeWinner['prize_event_winner_id']) ?>" data-name="<?php echo($PrizeWinner['prize_event_winner_name']) ?>" data-prize="<?php echo($PrizeWinner['prize_event_winner_prize']) ?>" data-ptype="<?php echo($PrizeWinner['prize_event_winner_type']);         ?>" data-left-icon="<?php echo($PrizeWinner['prize_event_winner_left_icon']) ?>" data-right-icon="<?php echo($PrizeWinner['prize_event_winner_right_icon']) ?>">Edit</button><button class="delete-prize-event" type="button" data-id="<?php echo($PrizeWinner['prize_event_winner_id']) ?>">Delete</button></td>

        </tr>
        <?php
    }
}else{
    echo('There are currently no winners. Please add a winner above');
}

?>