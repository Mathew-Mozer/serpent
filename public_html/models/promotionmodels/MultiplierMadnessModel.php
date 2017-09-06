<?php

/**
 * Class KickForCashModel
 * This file contains the SQL statements required to define
 * the kick for cash data
 */
class MultiplierMadnessModel{

   protected $db;

    /**
     * KickForCashModel constructor.
     * @param PDO $db
     */
   public function __construct(PDO $db){
     $this->db= $db;

   }

    /**
     * Add new kick for cash data
     * @param $values
     */
   public function add($values){
       //var_dump($values);
     $sql = "INSERT INTO multi_madness (multi_madness_promoid, multi_madness_values)
                                 VALUES (:promotion_id, :prizes);";
     $result = $this->db->prepare($sql);
     $result->bindValue(':promotion_id', $values['promotionId'], PDO::PARAM_STR);
     $result->bindValue(':prizes', $values['multi_madness_values'], PDO::PARAM_STR);
     $result->execute();
   }

    /**
     * Update kick for cash
     * @param $values
     */
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
               multi_madness
             WHERE
               multi_madness_promoid=:id
             ORDER BY
              multi_madness_id DESC
               LIMIT 1;";
     $result = $this->db->prepare($sql);
      $result->bindValue(':id', $id, PDO::PARAM_STR);
     $result->execute();

     $promoResult = $result->fetch(PDO::FETCH_ASSOC);
     return $promoResult;
   }
    public function startMM($post){
    $cardlist = ["AH","AC", "AD", "AS", "2H", "2C", "2D", "2S", "3H", "3C", "3D", "3S", "4H", "4C", "4D", "4S", "5H", "5C", "5D", "5S", "6H", "6C", "6D", "6S", "7H", "7C", "7D", "7S", "8H", "8C", "8D", "8S", "9H", "9C", "9D", "9S", "JH", "JC", "JD", "JS", "QH", "QC", "QD", "QS", "KH", "KC", "KD", "KS"];
    $myArray = explode(',', $post['mmvals']);
        shuffle($cardlist);
        shuffle($myArray);
//update start Timestamp
        $sql = "update multi_madness set multi_madness_started=now()
             WHERE
               multi_madness_promoid=:id
             LIMIT 1;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $post['promotionId'], PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->execute();
        $cnt = 0;
        foreach ($cardlist as $card) {
            if($cnt<sizeof($myArray)-1) {
                $sql = "INSERT INTO multi_madness_cards (multi_madness_cards_card, multi_madness_cards_value,multi_madness_cards_promoid)
                                 VALUES (:card,:val,:promotion_id);";
                $result = $this->db->prepare($sql);
                $result->bindValue(':promotion_id', $post['promotionId'], PDO::PARAM_STR);
                $result->bindValue(':card', $card, PDO::PARAM_STR);
                $result->bindValue(':val', $myArray[$cnt], PDO::PARAM_STR);
                $result->execute();
                $cnt++;
            }
        }



    }
}
?>