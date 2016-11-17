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
                                $highHandGold, $hornTimer, $payoutValues, $sessionTimer) {

        $sql = 'INSERT INTO high_hand (promotion_id, title_message, use_joker, high_hand_gold, 
            horn_timer, payout_value, session_timer)
            VALUES ('.$promotionId.','.$titleMessage.','.$useJoker.','.$highHandGold.','.
                        $hornTimer.','.$payoutValues.','.$sessionTimer.')';
        $result = $this->conn->prepare($sql);
        $result->execute();

        $promoResult = $result->fetch(PDO::FETCH_ASSOC);

        return $promoResult;
    }


}