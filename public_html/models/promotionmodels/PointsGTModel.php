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
    public function addPointsGT($values){
        //Adds Points GT.
        $sql = "INSERT INTO points_gt (
        points_gt_title,
        points_gt_subtitle,
        points_gt_left_title,
        points_gt_left_content,
        points_gt_right_title,
        points_gt_right_content,
        points_gt_payout,
        points_gt_race_begin,
        points_gt_race_end,
        points_gt_account_id,
        points_gt_promotion_id
      ) VALUES (
        :title,
        :subtitle,
        :left_title,
        :left_content,
        :right_title,
        :right_content,
        :payout,
        :race_begin,
        :race_end,
        :account_id,
        :promotion_id
        );";
        $result = $this->db->prepare($sql);
        $result->bindValue(':title', $values['title'], PDO::PARAM_STR);
        $result->bindValue(':subtitle', $values['subtitle'], PDO::PARAM_STR);
        $result->bindValue(':left_title', $values['left_title'], PDO::PARAM_STR);
        $result->bindValue(':left_content', $values['left_content'], PDO::PARAM_STR);
        $result->bindValue(':right_title', $values['right_title'], PDO::PARAM_STR);
        $result->bindValue(':right_content', $values['right_content'], PDO::PARAM_STR);
        $result->bindValue(':payout', $values['payout'], PDO::PARAM_STR);
        $result->bindValue(':race_begin', $values['race_begin'], PDO::PARAM_STR);
        $result->bindValue(':race_end', $values['race_end'], PDO::PARAM_STR);
        $result->bindValue(':account_id', $values['account_id'], PDO::PARAM_STR);
        $result->bindValue(':promotion_id', $values['promotion_id'], PDO::PARAM_STR);
        $result->execute();
        $pointsGTId = $this->db->lastInsertId();
        //Adds instant winners for Points GT.
        $sql = "INSERT INTO points_gt_instant_winner (
        pgt_points,
        pgt_winner_amount,
        pgt_color,
        pgt_id,
        pgt_account_id
      ) VALUES
      (:pgt_points1, :pgt_winner_amount1, :pgt_color1, :pgt_id, :pgt_account_id)
      (:pgt_points2, :pgt_winner_amount2, :pgt_color2, :pgt_id, :pgt_account_id)
      (:pgt_points3, :pgt_winner_amount3, :pgt_color3, :pgt_id, :pgt_account_id);";
        $result = $this->db->prepare($sql);
        $result->bindValue(':pgt_id', $pointsGTId, PDO::PARAM_STR);
        $result->bindValue(':pgt_account_id', $values['account_id'], PDO::PARAM_STR);
        $result->bindValue(':pgt_points1', $values['pgt_points1'], PDO::PARAM_STR);
        $result->bindValue(':pgt_winner_amount1', $values['pgt_winner_amount1'], PDO::PARAM_STR);
        $result->bindValue(':pgt_color1', $values['pgt_color1'], PDO::PARAM_STR);
        $result->bindValue(':pgt_points2', $values['pgt_points2'], PDO::PARAM_STR);
        $result->bindValue(':pgt_winner_amount2', $values['pgt_winner_amount2'], PDO::PARAM_STR);
        $result->bindValue(':pgt_color2', $values['pgt_color2'], PDO::PARAM_STR);
        $result->bindValue(':pgt_points3', $values['pgt_points3'], PDO::PARAM_STR);
        $result->bindValue(':pgt_winner_amount3', $values['pgt_winner_amount3'], PDO::PARAM_STR);
        $result->bindValue(':pgt_color3', $values['pgt_color3'], PDO::PARAM_STR);
        $result->execute();
    }
    /**
     * Gets the most up-to-date record for the Points GT by promtion id (1 record total).
     */
    public function getPointsGT($id){
        $sql = "SELECT
               *
             FROM
               points_gt
             WHERE
               points_gt_promotion_id=:id;
             ORDER BY
               points_gt_timestamp
             LIMIT 1;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetch(PDO::FETCH_ASSOC);
        return $promoResult;
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
               points_gt_id=:id;
             ORDER BY
               pgt_timestamp
             LIMIT 3;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }
    /*public function updatePointsGT($values){
      $sql=
      "UPDATE
           points_gt
       SET
       points_gt_title=:title,
       points_gt_subtitle=:subtitle,
       points_gt_left_title=:left_title,
       points_gt_left_content=:left_content,
       points_gt_right_title=:right_title,
       points_gt_right_content=:right_content,
       points_gt_payout=:payout,
       points_gt_race_begin=:race_begin,
       points_gt_race_end=:race_end,
       points_gt_account_id=:account_id
      WHERE
           points_gt_promotion_id=:promotion_id;";
           $result = $this->db->prepare($sql);
           $result->bindValue(':title', $values['title'], PDO::PARAM_STR);
           $result->bindValue(':subtitle', $values['subtitle'], PDO::PARAM_STR);
           $result->bindValue(':left_title', $values['left_title'], PDO::PARAM_STR);
           $result->bindValue(':left_content', $values['left_content'], PDO::PARAM_STR);
           $result->bindValue(':right_title', $values['right_title'], PDO::PARAM_STR);
           $result->bindValue(':right_content', $values['right_content'], PDO::PARAM_STR);
           $result->bindValue(':payout', $values['payout'], PDO::PARAM_STR);
           $result->bindValue(':race_begin', $values['race_begin'], PDO::PARAM_STR);
           $result->bindValue(':race_end', $values['race_end'], PDO::PARAM_STR);
           $result->bindValue(':account_id', $values['account_id'], PDO::PARAM_STR);
           $result->bindValue(':promotion_id', $values['promotion_id'], PDO::PARAM_STR);
           $result->execute();
        return array(""=>"");
    }*/
}
?>