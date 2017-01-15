<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 11/2/2016
 * Time: 11:58 PM
 */
class HighHand
{
    public $id;
    public $active="";
    public $session;
    public $HHtype;
    public $paytype;
    public $payouts;
    public $TitleMsg;
    public $sessionTimer;
    public $isOdd;//Is clock on odd or even hour
    public $preface; //0=no,1 = Minute only,2=hour only,3=Hour and Minute,4=table number,5=Payout Amount
    public $attachMC; // Attach Monster Carlo Board
    public $secondstohorn; //How many seconds left before horn plays
    public $showCount;
    public $HandListType;
    public $timestamp;
    public $HandList= array();

    public function loadHighHands($pSessionID)
    {

        global $conn;
        $dbcon = new DbCon();
        $conn = $dbcon->read_database();
        $sql = 'SELECT * from high_hand_records where  high_hand_session=? and high_hand_record_archive=0 order by high_hand_record_id DESC limit 25';
        $statement = $conn->prepare($sql);
        $statement->execute(array($pSessionID));
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            if($result['high_hand_isWinner']==0){
                array_push($this->HandList,new PokerHand($result['high_hand_record_id'],$result['high_hand_name'],$result['high_hand_card1'],$result['high_hand_card2'],$result['high_hand_card3'],$result['high_hand_card4'],$result['high_hand_card5'],$result['high_hand_card6'],$result['high_hand_card7'],$result['high_hand_isWinner'],$result['high_hand_timestamp']));
            }else{
                break;
            }
        }
        if(!empty($this->HandList)) {
            $hh = $this->HandList[0];
            $this->timestamp = $hh->timestamp;
        }else{
            $this->timestamp="empty";
        }
    }
}
