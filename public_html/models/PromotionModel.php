<?php
  // PromotionModal class
  //
  // author: Alex Onorati
  // This class contains all the legal queries on the database property_serpent.

  class PromotionModel{

    protected $db;

    public function __construct(PDO $db){
      $this->db= $db;

    }



    //This retrives all promotions that are stored.
    public function getAllPromotions(){
      $sql = "SELECT
                promotion.promotion_id as promo_id,
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

    public function getPromotionProperties(){
      $sql = "SELECT * FROM property;";

      $result = $this->db->prepare($sql);
      $result->execute();

      $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);

      return $promoResult;
    }

    public function getPromtionModelName($promtionTypeId){
      $sql = "SELECT * FROM promotion_type WHERE promotion_type_id = :id";
      $result = $this->db->prepare($sql);
      $result->bindValue(':id', $promtionTypeId, PDO::PARAM_STR);
      $result->execute();
      $promoResult = $result->fetch();
      return $promoResult['promotion_type_class_name'];
    }

    public function getAllPromotionsByProperty($propertyId){

            $sql = "SELECT
                      promotion.promotion_id as promo_id,
                      promotion_type.promotion_type_id as promo_type_id,
                      promotion_type.promotion_type_title as promo_title,
                      promotion_type.promotion_type_image as promo_image,
                      promotion_property.display_id as display_id,
                      promotion_type.promotion_type_file_name as file_name
                    FROM
                      promotion, promotion_type, promotion_property, property
                    WHERE
                      promotion.promotion_type_id = promotion_type.promotion_type_id
                      AND  promotion.promotion_id = promotion_property.promotion_id
                      AND property.property_id = promotion_property.property_id
                      AND promotion.promotion_visible = 1 AND property.property_id = :id;
                    ";

            $result = $this->db->prepare($sql);
            $result->bindValue(':id', $propertyId, PDO::PARAM_STR);
            $result->execute();

            $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);

            return $promoResult;
    }



    public function getPromotionTypes($propertyId){
      $sql = "SELECT
               promotion_type.promotion_type_id as promo_id,
               promotion_type.promotion_type_title as promo_title,
               promotion_type.promotion_type_image as promo_image,
               promotion_type.promotion_type_file_name as file_name
             FROM
               promotion_type, subscription
             WHERE
               promotion_type.promotion_type_id = subscription.promotion_type_id AND
               subscription.property_id = :propertyId
               ;";
      $result = $this->db->prepare($sql);
      $result->bindValue(':propertyId', $propertyId);
      $result->execute();

      $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);

      return $promoResult;
    }

    public function addPromotion($promotionTypeId, $propertyId){
      $sql = "INSERT INTO promotion (promotion_type_id) VALUES (:id);";

      $result = $this->db->prepare($sql);
      $result->bindValue(':id', $promotionTypeId, PDO::PARAM_STR);
      $result->execute();

      $promotionId = $this->db->lastInsertId();


      $sql = "INSERT INTO promotion_property (promotion_id, property_id) VALUES (:promotionId, :propertyId);";

      $result = $this->db->prepare($sql);
      $result->bindValue(':propertyId', $propertyId, PDO::PARAM_STR);
      $result->bindValue(':promotionId', $promotionId, PDO::PARAM_STR);
      $result->execute();

      return $promotionId;
    }

    public function getPromotionImageByPromotionType($id){
      $sql = "SELECT promotion_type_image as image FROM promotion_type WHERE promotion_type_id = :id;";

      $result = $this->db->prepare($sql);
      $result->bindValue(':id', $id, PDO::PARAM_STR);
      $result->execute();

      $promoResult = $result->fetch(PDO::FETCH_ASSOC);

      return $promoResult['image'];
    }

    public function getPromotionImageByPromotionId($id){
      $sql = "SELECT promotion_type_image as image FROM promotion, promotion_type
                WHERE promotion.promotion_id =" .$id. " AND promotion_type.promotion_type_id = promotion.promotion_type_id";
      $result = $this->db->prepare($sql);
      $result->execute();
      $image = $result->fetch(PDO::FETCH_ASSOC);
      return $image;
    }
  }
?>
