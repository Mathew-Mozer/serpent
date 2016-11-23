<?php
class KickForCashModel{

   protected $db;

   public function __construct(PDO $db){
     $this->db= $db;

   }

   public function add($values){
     $sql = "INSERT INTO kick_for_cash (kfc_promotion_id, kfc_cash_prize, kfc_target_number)
                                 VALUES (:promotion_id, :cash, :target_number);";


     $result = $this->db->prepare($sql);
     $result->bindValue(':promotion_id', $values['promotionId'], PDO::PARAM_STR);
     $result->bindValue(':cash', $values['kfc_cash_prize'], PDO::PARAM_STR);
     $result->bindValue(':target_number', $values['kfc_target_number'], PDO::PARAM_STR);

     $result->execute();


   }

   public function update($values){
     $sql = "INSERT INTO kick_for_cash (kfc_promotion_id, kfc_cash_prize, kfc_target_number, kfc_name, kfc_chosen_number, kfc_failedattempts, kfc_gamelabel, kfc_team1,kfc_team2,kfc_vs)
            VALUES (:promotion_id, :cash, :target_number,:current_name,:failedattempts, :chosen_number, :gamelabel, :team1, :team2, :vs);";


     $result = $this->db->prepare($sql);
     $result->bindValue(':promotion_id', $values['promotionId'], PDO::PARAM_STR);
     $result->bindValue(':cash', $values['kfc_cash_prize'], PDO::PARAM_STR);
     $result->bindValue(':target_number', $values['kfc_target_number'], PDO::PARAM_STR);
     $result->bindValue(':current_name', $values['kfc_name'], PDO::PARAM_STR);
     $result->bindValue(':failedattempts', $values['kfc_failedattempts'], PDO::PARAM_STR);
     $result->bindValue(':chosen_number', $values['kfc_chosen_number'], PDO::PARAM_STR);
     $result->bindValue(':gamelabel', $values['kfc_gamelabel'], PDO::PARAM_STR);
     $result->bindValue(':team1', $values['kfc_team1'], PDO::PARAM_STR);
     $result->bindValue(':team2', $values['kfc_team2'], PDO::PARAM_STR);
     $result->bindValue(':vs', $values['kfc_vs'], PDO::PARAM_STR);
     $result->execute();
   }

   public function get($id){

     $sql = "SELECT
               *
             FROM
               kick_for_cash
             WHERE
               kfc_promotion_id=:id
             ORDER BY
              kfc_timestamp DESC
               LIMIT 1;";
     $result = $this->db->prepare($sql);
      $result->bindValue(':id', $id, PDO::PARAM_STR);
     $result->execute();

     $promoResult = $result->fetch(PDO::FETCH_ASSOC);

     return $promoResult;
   }

   public function updateExcess($values){

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
       $result->bindValue(':current_name', $values['name'], PDO::PARAM_STR);
       $result->bindValue(':chosen_number', $values['chosen_number'], PDO::PARAM_STR);
       $result->bindValue(':kfc_gamelabel', $values['kfc_gamelabel'], PDO::PARAM_STR);
       $result->bindValue(':kfc_team1', $values['kfc_team1'], PDO::PARAM_STR);
       $result->bindValue(':kfc_team2', $values['kfc_team2'], PDO::PARAM_STR);
       $result->bindValue(':kfc_vs', $values['kfc_vs'], PDO::PARAM_STR);
       $result->bindValue(':promotion_id', $values['promotion_id'], PDO::PARAM_STR);
       $result->execute();
       return array("id"=>$promotionId,"name"=>$name,"target_number"=>$targetNumber,"game_label"=>$gameLabel);
   }
 }
?>
