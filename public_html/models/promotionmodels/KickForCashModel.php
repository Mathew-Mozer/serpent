<?php
class KickForCashModel{

   protected $db;

   public function __construct(PDO $db){
     $this->db= $db;

   }

   public function addKickForCash($promotionId, $cashPrize, $targetNumber){
     $sql = "INSERT INTO kick_for_cash (promotion_id, cash_prize, target_number)
                                 VALUES (:promo_id, :cash, :target_num);";


     $result = $this->db->prepare($sql);
     $result->bindValue(':promo_id', $promotionId, PDO::PARAM_STR);
     $result->bindValue(':cash', $cashPrize, PDO::PARAM_STR);
     $result->bindValue(':target_num', $targetNumber, PDO::PARAM_STR);

     $result->execute();


   }

   public function getKickForCash($id){

     $sql = "SELECT
               *
             FROM
               kick_for_cash
             WHERE
               promotion_id=:id;";
     $result = $this->db->prepare($sql);
      $result->bindValue(':id', $id, PDO::PARAM_STR);
     $result->execute();

     $promoResult = $result->fetch(PDO::FETCH_ASSOC);

     return $promoResult;
   }

   public function UpdateKickForCash($promotionId, $name ,$targetNumber, $gameLabel, $team1, $team2, $vs){

     $sql=
     "UPDATE
          kick_for_cash
      SET
          name=:current_name,
          chosen_number=:chosen_number,
          kfc_failedattempts=kfc_failedattempts+1,
          kfc_gamelabel=:kfc_gamelabel,
          kfc_team1=:kfc_team1,
          kfc_team2=:kfc_team2,
          kfc_vs=:kfc_vs
     WHERE
          promotion_id=:promotion_id;";

       $result = $this->db->prepare($sql);
       $result->bindValue(':current_name', $name, PDO::PARAM_STR);
       $result->bindValue(':chosen_number', $targetNumber, PDO::PARAM_STR);
       $result->bindValue(':kfc_gamelabel', $gameLabel, PDO::PARAM_STR);
       $result->bindValue(':kfc_team1', $team1, PDO::PARAM_STR);
       $result->bindValue(':kfc_team2', $team2, PDO::PARAM_STR);
       $result->bindValue(':kfc_vs', $vs, PDO::PARAM_STR);
       $result->bindValue(':promotion_id', $promotionId, PDO::PARAM_STR);
       $result->execute();
       return array("id"=>$promotionId,"name"=>$name,"target_number"=>$targetNumber,"game_label"=>$gameLabel);
   }
 }
?>
