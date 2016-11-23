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

    public function getHighHand($id){

        $sql = "SELECT
               *
             FROM
               high_hand
             WHERE
               promotion_id=:id;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();

        $promoResult = $result->fetch(PDO::FETCH_ASSOC);

        return $promoResult;
    }

    /**
     * Insert a new high hand into the database
     * @param $promotionID
     * @param $playerName
     * @param $card1
     * @param $card2
     * @param $card3
     * @param $card4
     * @param $card5
     * @param $card6
     * @param $card7
     * @param $card8
     */
    public function updateHighHand($promotionID, $playerName, $card1, $card2, $card3, $card4, $card5, $card6, $card7, $card8){

        $sql ='INSERT INTO high_hand_records(
                hand_promotionID,
                high_hand_name,    
                high_hand_card1,
                high_hand_card2,
                high_hand_card3,
                high_hand_card4,
                high_hand_card5,
                high_hand_card6,
                high_hand_card7,
                high_hand_card8   
              )

              VALUES(:promotionID, :playerName, :card1, :card2, :card3, :card4, :card5, :card6, :card7, :card8);
        ';

        $result = $this->conn->prepare($sql);
        $result->bindValue(':promotionID', $promotionID, PDO::PARAM_INT);
        $result->bindValue(':playerName', $playerName, PDO::PARAM_STR);
        $result->bindValue(':card1', $card1, PDO::PARAM_STR);
        $result->bindValue(':card2', $card2, PDO::PARAM_STR);
        $result->bindValue(':card3', $card3, PDO::PARAM_STR);
        $result->bindValue(':card4', $card4, PDO::PARAM_STR);
        $result->bindValue(':card5', $card5, PDO::PARAM_STR);
        $result->bindValue(':card6', $card6, PDO::PARAM_STR);
        $result->bindValue(':card7', $card7, PDO::PARAM_STR);
        $result->bindValue(':card8', $card8, PDO::PARAM_STR);

        $result->execute();
}

}