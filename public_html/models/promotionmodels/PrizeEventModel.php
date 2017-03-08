<?php

/**
 * Class KickForCashModel
 * This file contains the SQL statements required to define
 * the kick for cash data
 */
class PrizeEventModel{

   protected $db;

    /**
     * KickForCashModel constructor.
     * @param PDO $db
     */
   public function __construct(PDO $db){
     $this->db= $db;

   }

    /**
     * Add new  data
     * @param $values
     */
    public function add($values){
       $sql = "INSERT INTO prize_event (
                          prize_event_promo_id,
                          prize_event_title,
                          prize_event_odoamount,
                          prize_event_randomprize,
                          prize_event_incrementnumber,
                          prize_event_useprizes,
                          prize_event_timertype,
                          prize_event_clockvisible,
                          prize_event_nexttimevisible,
                          prize_event_isoddhr,
                          prize_event_secondtohorn)
                                 VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k);";
       $result = $this->db->prepare($sql);
       $result->bindValue(':a', $values['promotionId'], PDO::PARAM_STR);
       $result->bindValue(':b', $values['prize_event_title'], PDO::PARAM_STR);
       $result->bindValue(':c', $values['prize_event_odoamount'], PDO::PARAM_STR);
       $result->bindValue(':d', $values['prize_event_randomprize'], PDO::PARAM_STR);
       $result->bindValue(':e', $values['prize_event_incrementnumber'], PDO::PARAM_STR);
       $result->bindValue(':f', $values['prize_event_useprizes'], PDO::PARAM_STR);
       $result->bindValue(':g', $values['prize_event_timertype'], PDO::PARAM_STR);
       $result->bindValue(':h', $values['prize_event_clockvisible'], PDO::PARAM_STR);
       $result->bindValue(':i', $values['prize_event_nexttimevisible'], PDO::PARAM_STR);
       $result->bindValue(':j', $values['prize_event_isoddhr'], PDO::PARAM_STR);
       $result->bindValue(':k', $values['prize_event_secondtohorn'], PDO::PARAM_STR);
       $result->execute();
       return $result;
   }
    public function update($values){
        $this->add($values);
    }
    /**
     * Get kicked for cash
     * @param $id
     * @return mixed
     */
   public function get($id){
     $sql = "SELECT
               *
             FROM
               prize_event
             WHERE
               prize_event_promo_id=:id
             ORDER BY
              prize_event_id DESC
               LIMIT 1;";
     $result = $this->db->prepare($sql);
      $result->bindValue(':id', $id, PDO::PARAM_STR);
     $result->execute();

     $promoResult = $result->fetch(PDO::FETCH_ASSOC);
     return $promoResult;
   }
    public function getAllWinners($id){

        $sql = "SELECT
               *
             FROM
               prize_event_winner
             WHERE
               prize_event_winner_promoid=:id and prize_event_winner_archive=0
             ORDER BY
              prize_event_winner_id DESC;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }
    public function addWinner($values){
        $sql = "Replace INTO prize_event_winner (prize_event_winner_id, prize_event_winner_promoid,prize_event_winner_name,prize_event_winner_prize,prize_event_winner_type,prize_event_winner_right_icon,prize_event_winner_left_icon)
                                 VALUES (:id,:promotion_id,:pname,:prize,:ptype,:righticon,:lefticon);";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $values['prize_event_winner_id'], PDO::PARAM_STR);
        $result->bindValue(':promotion_id', $values['promotionId'], PDO::PARAM_STR);
        $result->bindValue(':pname', $values['prize_event_winner_name'], PDO::PARAM_STR);
        $result->bindValue(':prize', $values['prize_event_winner_prize'], PDO::PARAM_STR);
        $result->bindValue(':ptype', $values['prize_event_winner_type'], PDO::PARAM_STR);
        $result->bindValue(':righticon', $values['prize_event_winner_right'], PDO::PARAM_STR);
        $result->bindValue(':lefticon', $values['prize_event_winner_left'], PDO::PARAM_STR);

        $result->execute();
        return $result;
    }
    public function deleteWinner($values){
        $sql = "update prize_event_winner set prize_event_winner_archive=1 where prize_event_winner_id=:id and prize_event_winner_promoid=:promotion_id;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $values['prize_event_winner_id'], PDO::PARAM_STR);
        $result->bindValue(':promotion_id', $values['promotionId'], PDO::PARAM_STR);
        $result->execute();
        return $result;
    }

 }
?>