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
                promotion.promotion_type_id = promotion_type.id;
              ";
      $result = $this->db->prepare($sql);
      $result->execute();

      $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);

      return $promoResult;
    }

    public function getPromotionTypes(){
      $sql = "SELECT
                promotion_type.id as promo_id,
                promotion_type.title as promo_title,
                promotion_type.image as promo_image
              FROM
                promotion_type;";
      $result = $this->db->prepare($sql);
      $result->execute();

      $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);

      return $promoResult;
    }

    public function addPromotion($id){
      $sql = "INSERT INTO promotion (promotion_type_id) VALUES (:id);";

      $result = $this->db->prepare($sql);
      $result->bindValue(':id', $id, PDO::PARAM_STR);
      $result->execute();

      return $promoResult;

    }

    public function getPromotionImage($id){
      $sql = "SELECT image FROM promotion_type WHERE id = :id;";

      $result = $this->db->prepare($sql);
      $result->bindValue(':id', $id, PDO::PARAM_STR);
      $result->execute();

      $promoResult = $result->fetch(PDO::FETCH_ASSOC);

      return $promoResult;
    }
  }
?>
