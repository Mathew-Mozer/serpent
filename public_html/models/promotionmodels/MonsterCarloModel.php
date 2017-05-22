<?php

/**
 * Class HighHandModel
 * This file contains the SQL statements required to define
 * the high hand data
 */

class MonsterCarloModel{

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

        if($values['monster_carlo_settings_hhid']>0){
            $values['monster_carlo_settings_hhgold']=1;
        }else{
            $values['monster_carlo_settings_hhgold']=0;
        }
        $sql = "INSERT INTO monster_carlo_settings (monster_carlo_settings_promotion_id, monster_carlo_settings_hhid, monster_carlo_settings_hhgold, monster_carlo_settings_payouts)
            VALUES (:promotionId,:hhid,:hhgold,:mcpayouts);";

        $result = $this->conn->prepare($sql);
        $result->bindValue(':promotionId', $values['promotionId'], PDO::PARAM_STR);
        $result->bindValue(':hhid', $values['monster_carlo_settings_hhid'], PDO::PARAM_STR);
        $result->bindValue(':hhgold', $values['monster_carlo_settings_hhgold'], PDO::PARAM_STR);
        $result->bindValue(':mcpayouts', $values['monster_carlo_settings_payouts'], PDO::PARAM_STR);
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
               monster_carlo_settings
             WHERE
               monster_carlo_settings_promotion_id=:id
             ORDER BY
               monster_carlo_settings_id DESC
             LIMIT 1;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();

        $promoResult = $result->fetch(PDO::FETCH_ASSOC);
        return $promoResult;

    }
    public function loadMonsterCarloCards($pSessionID)
    {
        $cardList = array();
        $sql = 'SELECT high_hand_card8 from high_hand_records where  high_hand_session=? and high_hand_record_archive=0 and high_hand_card8!=\'CB\' and high_hand_isWinner >0  order by high_hand_record_id';
        $statement = $this->conn->prepare($sql);
        $statement->execute(array($pSessionID));
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            array_push($cardList,$result['high_hand_card8']);
        }
        return $cardList;
    }
    public function getCurrentHighHands($id){


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
                WHERE high_hand_records.high_hand_session = :id and high_hand_record_archive='0' order by high_hand_record_id DESC ";
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
    public function archiveHands($value){
        $sql = "UPDATE high_hand_records SET high_hand_record_archive='1' WHERE high_hand_session=:promoid";

        $result = $this->conn->prepare($sql);
        $result->bindValue(':promoid', $value['promotionId'], PDO::PARAM_STR);
        $result->execute();
    }
}
