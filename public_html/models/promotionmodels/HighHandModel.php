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


}