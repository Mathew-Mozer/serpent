<?php

/**
 * Class KickForCashModel
 * This file contains the SQL statements required to define
 * the kick for cash data
 */
class TimeTargetModel{

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
     $sql = "INSERT INTO time_target (time_target_promoid, time_target_start,time_target_seed,time_target_add,time_target_increment_min)
                                 VALUES (:promotion_id, :start,:seed,:add,:min);";
        $result = $this->db->prepare($sql);
        $result->bindValue(':promotion_id', $values['promotionId'], PDO::PARAM_STR);
        $result->bindValue(':seed', $values['time_target_seed'], PDO::PARAM_STR);
        $result->bindValue(':start', $values['time_target_start'], PDO::PARAM_STR);
        $result->bindValue(':add', $values['time_target_add'], PDO::PARAM_STR);
        $result->bindValue(':min', $values['time_target_increment_min'], PDO::PARAM_STR);
     $result->execute();


   }

    /**
     * Update kick for cash
     * @param $values
     */
   public function update($values){
       $sql = "INSERT INTO time_target (time_target_promoid, time_target_start,time_target_seed,time_target_add,time_target_increment_min)
                                 VALUES (:promotion_id, :start,:seed,:add,:min);";
       $result = $this->db->prepare($sql);
       $result->bindValue(':promotion_id', $values['promotionId'], PDO::PARAM_STR);
       $result->bindValue(':seed', $values['time_target_seed'], PDO::PARAM_STR);
       $result->bindValue(':start', $values['time_target_start'], PDO::PARAM_STR);
       $result->bindValue(':add', $values['time_target_add'], PDO::PARAM_STR);
       $result->bindValue(':min', $values['time_target_increment_min'], PDO::PARAM_STR);
       $result->execute();
       return $result;
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
               time_target
             WHERE
               time_target_promoid=:id
             ORDER BY
              time_target_id DESC
               LIMIT 1;";
     $result = $this->db->prepare($sql);
      $result->bindValue(':id', $id, PDO::PARAM_STR);
     $result->execute();

     $promoResult = $result->fetch(PDO::FETCH_ASSOC);
     return $promoResult;
   }
    public function getAll($id){
        $sql = "SELECT
               *
             FROM
               time_target
             WHERE time_target_archive='0' and
               time_target_promoid=:id
             ORDER BY
              time_target_id DESC
               ;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }
    public function confirmTimeTarget($values){
        $sql = "Update time_target set time_target_approved='1' where time_target_id=:id";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $values['timeTargetId'], PDO::PARAM_STR);
        $result->execute();
        return $result;
    }
    public function endTimeTarget($values){

        switch ($values['endTime']){
            case 3:
                $endtime=$values['currentTime'];
            echo($endtime);
                break;

            case 1:
                $endtime=date("Y/m/d H:i:s");
                break;
            case 0:
                $endtime="0000/00/00 00:00:00";
                break;
        }
        $sql = "Update time_target set time_target_end=:endtime where time_target_id=:id";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $values['timeTargetId'], PDO::PARAM_STR);
        $result->bindValue(':endtime',$endtime , PDO::PARAM_STR);
        $result->execute();
        return $result;
    }
    public function archiveTimeTarget($values){
        $sql = "Update time_target set time_target_archive='1' where time_target_id=:id";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $values['timeTargetId'], PDO::PARAM_STR);
        $result->execute();
        return $result;
    }
 }
?>