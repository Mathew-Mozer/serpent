<?php

/**
 * Class KickForCashModel
 * This file contains the SQL statements required to define
 * the kick for cash data
 */
class TimeTargetXModel{

   protected $db;

    /**
     * KickForCashModel constructor.
     * @param PDO $db
     */
   public function __construct(PDO $db){
     $this->db= $db;

   }


    /**
     * Update kick for cash
     * @param $values
     */
   public function add($values){
       $sql = "INSERT INTO time_targetx (time_targetx_promoid)
                                 VALUES (:promotion_id);";
       $result = $this->db->prepare($sql);
       $result->bindValue(':promotion_id', $values['promotionId'], PDO::PARAM_STR);
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
               time_targetx
             WHERE
               time_targetx_promoid=:id
             ORDER BY
              time_targetx_id DESC
               LIMIT 1;";
     $result = $this->db->prepare($sql);
      $result->bindValue(':id', $id, PDO::PARAM_STR);
     $result->execute();

     $promoResult = $result->fetch(PDO::FETCH_ASSOC);
     return $promoResult;
   }
 }
?>