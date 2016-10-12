<?php
  // PromotionModal class
  //
  // author: Alex Onorati
  // This class contains all the legal queries on the database casino_serpent.

  class PromotionModal{

    protected $db;

    public function __construct(PDO $db){
      $this->db= $db;

    }



    //This retrives all promotions that are stored.
    public function getAllPromotions(){
    

      $sql = "SELECT
                promotion.id as promo_id,
                promotion_type.title as promo_title,
                promotion_type.image as promo_image
              FROM
                promotion, promotion_type
              WHERE
                promotion.promotion_type_id = promotion_type.id
              ";
      $result = $this->db->prepare($sql);
      $result->execute();

      $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);

      return $promoResult;
    }
  }
?>
