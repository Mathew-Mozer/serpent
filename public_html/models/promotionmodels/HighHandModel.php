<?php


class HighHandModel{

    private $conn;

    /**
     * HighHandModel constructor.
     * @param $conn
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function addHighHand($promotionId, $titleMessage, $useJoker,
                                $highHandGold, $hornTimer, $payoutValues, $sessionTimer, $multipleHands) {

        $sql = 'INSERT INTO high_hand (promotion_id, title_message, use_joker, high_hand_gold, 
            horn_timer, payout_value, session_timer, multiple_hands)
            VALUES ('.$promotionId.",'".$titleMessage."',".$useJoker.','.$highHandGold.','.
                        $hornTimer.','.$payoutValues.','.$sessionTimer.','.$multipleHands.')';
        $result = $this->conn->prepare($sql);
        $result->execute();
    }


}