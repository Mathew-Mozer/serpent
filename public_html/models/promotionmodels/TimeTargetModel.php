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
   public function addSession($values){
     $sql = "INSERT INTO time_target_sessions (time_target_session_promoid, time_target_start,time_target_seed,time_target_add,time_target_increment_min)
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
   public function add($values){
       $sql = "INSERT INTO time_target (time_target_promoid,
                time_target_title,
                time_target_contenttitle,
                time_target_content,
                time_target_cards,
                time_target_default_seed,
                time_target_default_Increment,
                time_target_default_add_amt,
                time_target_progressive,
                time_target_lock_defaults,
                time_target_maxpayout,
                time_target_def_hour,
                time_target_def_minute,
                time_target_randomcard,
                time_target_lastcardchange,
                time_target_valoption,
                time_target_nostartnew,
                time_target_multpromoid,
                time_target_usemult,
                time_target_multiplier)
         VALUES (:promotion_id,
                 :title,
                 :contenttitle,
                 :content,
                 :cards,
                 :defseed,
                 :defincr,
                 :defadd,
                 :isprog,
                 :deflock,
                 :maxpayout,
                 :defhour,
                 :defminute,
                 :randocard,
                 :lastcardchange,
                 :valoption,
                 :nostartnew,
                 :multpromoid,
                 :usemult,
                 :multiplier);";
       $result = $this->db->prepare($sql);
       $result->bindValue(':promotion_id', $values['promotionId'], PDO::PARAM_STR);
       $result->bindValue(':contenttitle', $values['time_target_contenttitle'], PDO::PARAM_STR);
       $result->bindValue(':content', $values['time_target_content'], PDO::PARAM_STR);
       $result->bindValue(':title', $values['time_target_title'], PDO::PARAM_STR);
       $result->bindValue(':cards', $values['time_target_cards'], PDO::PARAM_STR);
       $result->bindValue(':defseed', $values['time_target_default_seed'], PDO::PARAM_STR);
       $result->bindValue(':defincr', $values['time_target_default_Increment'], PDO::PARAM_STR);
       $result->bindValue(':defadd', $values['time_target_default_add_amt'], PDO::PARAM_STR);
       $result->bindValue(':isprog', $values['time_target_progressive'], PDO::PARAM_STR);
       $result->bindValue(':deflock', $values['time_target_lock_defaults'], PDO::PARAM_STR);
       $result->bindValue(':maxpayout', $values['time_target_maxpayout'], PDO::PARAM_STR);
       $result->bindValue(':defhour', $values['time_target_def_hour'], PDO::PARAM_STR);
       $result->bindValue(':defminute', $values['time_target_def_minute'], PDO::PARAM_STR);
       $result->bindValue(':randocard', $values['time_target_randomcard'], PDO::PARAM_STR);
       $result->bindValue(':lastcardchange', $values['time_target_lastcardchange'], PDO::PARAM_STR);
       $result->bindValue(':valoption', $values['time_target_valoption'], PDO::PARAM_STR);
       $result->bindValue(':nostartnew', $values['time_target_nostartnew'], PDO::PARAM_STR);
       $result->bindValue(':multpromoid', $values['time_target_multpromoid'], PDO::PARAM_STR);
       $result->bindValue(':usemult', $values['time_target_usemult'], PDO::PARAM_STR);
       $result->bindValue(':multiplier', $values['time_target_multiplier'], PDO::PARAM_STR);
       var_dump($values);
       echo("it tried: ". $values['promotionId']);
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
    public function getAllSessions($id){
        $sql = "SELECT
               *
             FROM
               time_target_sessions
             WHERE time_target_archive='0' and
               time_target_session_promoid=:id
                
             ORDER BY
              time_target_session_id DESC
               ;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }
    public function confirmTimeTarget($values){
       //var_dump($values);
        $sql = "Update time_target_sessions set time_target_approved='1',time_target_paidamt=:paidamt,time_target_paidby=:paidby where time_target_session_id=:id";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $values['timeTargetId'], PDO::PARAM_STR);
        $result->bindValue(':paidamt', $values['timetargetpaidamt'], PDO::PARAM_STR);
        $result->bindValue(':paidby', $values['timetargetpaidby'], PDO::PARAM_STR);
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
        $sql = "Update time_target_sessions set time_target_end=:endtime where time_target_session_id=:id";
        $result = $this->db->prepare($sql);

        $result->bindValue(':id', $values['timeTargetId'], PDO::PARAM_STR);
        $result->bindValue(':endtime',$endtime , PDO::PARAM_STR);
        $result->execute();
        return $result;
    }
    public function archiveTimeTarget($values){

        $sql = "Update time_target_sessions set time_target_archive='1' where time_target_session_id=:id";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $values['timeTargetId'], PDO::PARAM_STR);
        $result->execute();
        return $result;
    }
    public function getAllTimeTargetChildren($promoID){
        $sql = "select * from promotion p where p.promotion_parent =:id";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $promoID, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }
 }
?>