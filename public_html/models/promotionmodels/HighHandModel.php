<?php

/**
 * Class HighHandModel
 * This file contains the SQL statements required to define
 * the high hand data
 */

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

    /**
     * Add high hand
     * @param $values
     */
    public function add($values) {
        $sql = "INSERT INTO high_hand (promotion_id, title_message, use_joker, high_hand_attachmc,
            horn_timer, payout_value, session_timer, multiple_hands, high_hand_custom_payout, high_hand_isodd,high_hand_cardcount)
            VALUES (:promotionId,:title_message,:use_joker,:high_hand_gold,:horn_timer,:payout_value,
                    :session_timer,:multiple_hands, :custom_payout, :is_odd,:cardcount);";

        $result = $this->conn->prepare($sql);
        $result->bindValue(':promotionId', $values['promotionId'], PDO::PARAM_STR);
        $result->bindValue(':title_message', $values['title_message'], PDO::PARAM_STR);
        $result->bindValue(':use_joker', $values['use_joker'], PDO::PARAM_STR);
        $result->bindValue(':high_hand_gold', $values['high_hand_attachmc'], PDO::PARAM_STR);
        $result->bindValue(':horn_timer', $values['horn_timer'], PDO::PARAM_STR);
        $result->bindValue(':payout_value', $values['payout_value'], PDO::PARAM_STR);
        $result->bindValue(':session_timer', $values['session_timer'], PDO::PARAM_STR);
        $result->bindValue(':multiple_hands', $values['multiple_hands'], PDO::PARAM_INT);
        $result->bindValue(':custom_payout', $values['high_hand_custom_payout'], PDO::PARAM_STR);
        $result->bindValue(':is_odd', $values['isodd'], PDO::PARAM_STR);
        $result->bindValue(':cardcount', $values['high_hand_cardcount'], PDO::PARAM_STR);

        $result->execute();
    }

    /**
     * Updates high hand
     * @param $values
     */
    public function update($values){
      $this->add($values);
    }

    /**
     * Gets high hand
     * @param $id
     * @return mixed
     */
    public function get($id){

        $sql = "SELECT
               *
             FROM
               high_hand
             WHERE
               promotion_id=:id;
               ";
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
    public function updateHighHand($promotionID, $playerName, $cards){
        var_dump($cards);

        $sql ='INSERT INTO high_hand_records(
                high_hand_session,
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
        $result->bindValue(':card1', $cards[0], PDO::PARAM_STR);
        $result->bindValue(':card2', $cards[1], PDO::PARAM_STR);
        $result->bindValue(':card3', $cards[2], PDO::PARAM_STR);
        $result->bindValue(':card4', $cards[3], PDO::PARAM_STR);
        $result->bindValue(':card5', $cards[4], PDO::PARAM_STR);
        $result->bindValue(':card6', $cards[5], PDO::PARAM_STR);
        $result->bindValue(':card7', $cards[6], PDO::PARAM_STR);
        $result->bindValue(':card8', $cards[7], PDO::PARAM_STR);

        $result->execute();
}

    /**
     * This will be refactored for all promotions
     * @return mixed
     */
    public function getTemplate(){

        $sql = "SELECT * FROM high_hand WHERE template=1";
        $result = $this->conn->prepare($sql);
        $result->execute();

        $template = $result->fetch(PDO::FETCH_ASSOC);
        return $template;
    }

    /**
     * This retrieves all hands assigned to the promotion ID
     * @param $id
     * @return array
     */
    public function getAllHands($id){
       $sql = "SELECT * FROM high_hand_records
                WHERE high_hand_records.high_hand_session = :id order by high_hand_record_id DESC ";
        $result = $this->conn->prepare($sql);

        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $response = $result->fetchAll(PDO::FETCH_ASSOC);
        return $response;

    }

    public function updateCardSet($value){
        $sql = "UPDATE high_hand_records SET high_hand_isWinner=:isWinner, high_hand_payout=:payout WHERE high_hand_record_id=:handId";

        $result = $this->conn->prepare($sql);

        $result->bindValue(':isWinner', $value['isWinner'], PDO::PARAM_STR);
        $result->bindValue(':payout', $value['payout'], PDO::PARAM_STR);
        $result->bindValue(':handId', $value['handId'], PDO::PARAM_STR);

        $result->execute();
    }
}
