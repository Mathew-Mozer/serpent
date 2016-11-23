<?php
/**
* Model that represents a Points GT promotion.
*/
class PointsGTModel{

   protected $db;

   /**
   * Constructs a new Points GT with a given PDO object.
   */
   public function __construct(PDO $db){
     $this->db= $db;

   }

   /**
   * Inserts a Points GT record into the database.
   * @param values
   */
   public function add($values){
     //Adds Points GT.

    $pointsGTId = $this->addPointsGT($values);

    //Adds instant winners for Points GT.
    $sql = "INSERT INTO points_gt_instant_winner (
        pgt_points,
        pgt_prize_amount,
        pgt_color,
        pgt_id,
        pgt_account_id
      ) VALUES
      (:pgt_points1, :pgt_prize_amount1, :pgt_color1, :pgt_id, :pgt_account_id),
      (:pgt_points2, :pgt_prize_amount2, :pgt_color2, :pgt_id, :pgt_account_id),
      (:pgt_points3, :pgt_prize_amount3, :pgt_color3, :pgt_id, :pgt_account_id);";
    $result = $this->db->prepare($sql);

    $result->bindValue(':pgt_id', $pointsGTId, PDO::PARAM_STR);
    $result->bindValue(':pgt_account_id', $values['accountId'], PDO::PARAM_STR);

    $result->bindValue(':pgt_points1', $values['pgt_points1'], PDO::PARAM_STR);
    $result->bindValue(':pgt_prize_amount1', $values['pgt_prize_amount1'], PDO::PARAM_STR);
    $result->bindValue(':pgt_color1', $values['pgt_color1'], PDO::PARAM_STR);

    $result->bindValue(':pgt_points2', $values['pgt_points2'], PDO::PARAM_STR);
    $result->bindValue(':pgt_prize_amount2', $values['pgt_prize_amount2'], PDO::PARAM_STR);
    $result->bindValue(':pgt_color2', $values['pgt_color2'], PDO::PARAM_STR);

    $result->bindValue(':pgt_points3', $values['pgt_points3'], PDO::PARAM_STR);
    $result->bindValue(':pgt_prize_amount3', $values['pgt_prize_amount3'], PDO::PARAM_STR);
    $result->bindValue(':pgt_color3', $values['pgt_color3'], PDO::PARAM_STR);

    //Adds instant winners for Points GT.
    $sql = "INSERT INTO points_gt_players (
        pgt_player_name,
        pgt_current_points,
        pgt_car_icon,
        pgt_id,
        pgt_account_id
      ) VALUES";
      for($i = 1; $i <= 20; $i++){
        $sql .= "(:pgt_player_name$i, :pgt_current_points$i, :pgt_car_icon$i, :pgt_id, :pgt_account_id)";
        $sql .= $i < 20 ? "," : ";";

      }

        $result = $this->db->prepare($sql);
    for($i = 1; $i <= 20; $i++){
    $result->bindValue(":pgt_player_name$i", $values["pgt_player_name$i"], PDO::PARAM_STR);
    $result->bindValue(":pgt_current_points$i", $values["pgt_current_points$i"], PDO::PARAM_STR);
    $result->bindValue(":pgt_car_icon$i", $values["pgt_car_icon$i"], PDO::PARAM_STR);
  }
      $result->bindValue(':pgt_id', $pointsGTId, PDO::PARAM_STR);
    $result->bindValue(':pgt_account_id', $values['accountId'], PDO::PARAM_STR);


    $result->execute();
   }

   private function addPointsGT($values){
     $sql = "INSERT INTO points_gt (
        pgt_title,
        pgt_subtitle,
        pgt_left_title,
        pgt_left_content,
        pgt_right_title,
        pgt_right_content,
        pgt_payout,
        pgt_race_begin,
        pgt_race_end,
        pgt_account_id,
        pgt_promotion_id
      ) VALUES (
        :add_title,
        :add_subtitle,
        :add_left_title,
        :add_left_content,
        :add_right_title,
        :add_right_content,
        :add_payout,
        :add_race_begin,
        :add_race_end,
        :add_account_id,
        :add_promotion_id
        );";

    $result = $this->db->prepare($sql);
    $result->bindValue(':add_title', $values['pgt_title'], PDO::PARAM_STR);
    $result->bindValue(':add_subtitle', $values['pgt_subtitle'], PDO::PARAM_STR);
    $result->bindValue(':add_left_title', $values['pgt_left_title'], PDO::PARAM_STR);
    $result->bindValue(':add_left_content', $values['pgt_left_content'], PDO::PARAM_STR);
    $result->bindValue(':add_right_title', $values['pgt_right_title'], PDO::PARAM_STR);
    $result->bindValue(':add_right_content', $values['pgt_right_content'], PDO::PARAM_STR);
    $result->bindValue(':add_payout', $values['pgt_payout'], PDO::PARAM_STR);
    $result->bindValue(':add_race_begin', $values['pgt_race_begin'], PDO::PARAM_STR);
    $result->bindValue(':add_race_end', $values['pgt_race_end'], PDO::PARAM_STR);
    $result->bindValue(':add_account_id', $values['accountId'], PDO::PARAM_STR);
    $result->bindValue(':add_promotion_id', $values['promotionId'], PDO::PARAM_STR);

    $result->execute();
    return $this->db->lastInsertId();
   }

   /**
   * Gets the most up-to-date record for the Points GT by promtion id (1 record total).
   */
   public function get($id){
     $sql = "SELECT
               *
             FROM
               points_gt
             WHERE
               pgt_promotion_id=:id
             ORDER BY
               pgt_timestamp DESC
             LIMIT 1;";
     $result = $this->db->prepare($sql);
     $result->bindValue(':id', $id, PDO::PARAM_STR);
     $result->execute();

     $promoResult = $result->fetch(PDO::FETCH_ASSOC);
     $result->closeCursor();
     $instantWinners = $this->getPointsGTInstantWinners($promoResult['pgt_id']);

     $players = $this->getPointsGTPlayers($promoResult['pgt_id']);

     $result = array_merge($promoResult, $instantWinners, $players);
     return $result;
   }

   public function update($values){
     $this->add($values);

   }

   /**
   * Gets the most up-to-date record for the Points GT instant winners by Points GT id (3 records total).
   */
   public function getPointsGTInstantWinners($id){

     $sql = "SELECT
               *
             FROM
               points_gt_instant_winner
             WHERE
               pgt_id=:id;
             ORDER BY
               pgt_timestamp DESC
             LIMIT 3;";
     $result = $this->db->prepare($sql);

      $result->bindValue(':id', $id, PDO::PARAM_STR);
     $result->execute();

     $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
     $result->closeCursor();

     return $this->formatRowWithNumberIndex($promoResult);
   }

   /**
   * Gets the most up-to-date record for the Points GT instant winners by Points GT id (3 records total).
   */
   public function getPointsGTPlayers($id){

     $sql = "SELECT
               *
             FROM
               points_gt_players
             WHERE
               pgt_id=:id;
             ORDER BY
               pgt_current_points DESC
             LIMIT 20;";
     $result = $this->db->prepare($sql);
     $result->bindValue(':id', $id, PDO::PARAM_STR);
     $result->execute();

     $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);

     $result->closeCursor();

     return $this->formatRowWithNumberIndex($promoResult);
   }

   public function formatRowWithNumberIndex($rows){
     $result = array();
     $i = 1;
     foreach($rows as $row){
       foreach($row as $key=>$field){
         $result[$key . $i] = $field;
       }
       $i++;
     }
     return $result;
   }
}
?>
