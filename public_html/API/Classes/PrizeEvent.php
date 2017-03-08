<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 1/20/2017
 * Time: 8:27 AM
 */
class PrizeEvent
{

public $ID;
Public $JackPotAmount;
public $Title;
public $RandomPrize;
public $IncrementNumber;
public $TimerType;
public $clockRemainingVisible;
public $NextTimeVisible;
public $isOddHr;
public $secondsToHorn;
public $winnerlist= array();

    function __construct()
    {

    }
    public function loadPrizeWinners($pSessionID)
    {

        global $conn;
        $dbcon = new DbCon();
        $conn = $dbcon->read_database();
        $sql = 'SELECT * from prize_event_winner where prize_event_winner_promoid=? and prize_event_winner_archive=0 order by prize_event_winner_id DESC ';
        $statement = $conn->prepare($sql);
        $statement->execute(array($pSessionID));
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $pew = new PrizeEventWinner();
            $pew->id = $result['prize_event_winner_id'];
            $pew->name = $result['prize_event_winner_name'];
            $pew->prize = $result['prize_event_winner_prize'];
            $pew->ptype = $result['prize_event_winner_type'];
            $pew->righticon = $result['prize_event_winner_right_icon'];
            $pew->lefticon = $result['prize_event_winner_left_icon'];
            $pew->timestamp = $result['prize_event_winner_timestamp'];
                array_push($this->winnerlist,$pew);
        }
    }
}

