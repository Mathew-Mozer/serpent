<?php
// PromotionModal class
//
// author: Alex Onorati
// This class contains all the legal queries on the database casino_serpent.

class DisplayModel{

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

    public function getPromotionCasinos(){
        $sql = "SELECT
                *
              FROM
                 casino;
              ";

        $result = $this->db->prepare($sql);
        $result->execute();

        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);

        return $promoResult;
    }

    public function getAllPromotionsByCasino($casinoId){

        $sql = "SELECT
                      promotion.id as promo_id,
                      promotion_type.title as promo_title,
                      promotion_type.image as promo_image,
                      promotion_casino.box_id as display_id
                    FROM
                      promotion, promotion_type, promotion_casino, casino
                    WHERE
                      promotion.promotion_type_id = promotion_type.id
                      AND  promotion.id = promotion_casino.promotion_id
                      AND casino.id = promotion_casino.casino_id
                      AND promotion.visible = 'T' AND casino.id = :id;
                    ";

        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $casinoId, PDO::PARAM_STR);
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

    public function addPromotion($promotionTypeId, $casinoId){
        $sql = "INSERT INTO promotion (promotion_type_id) VALUES (:id);";

        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $promotionTypeId, PDO::PARAM_STR);
        $result->execute();

        $promotionId = $this->db->lastInsertId();


        $sql = "INSERT INTO promotion_casino (promotion_id, casino_id) VALUES (:promotionId, :casinoId);";

        $result = $this->db->prepare($sql);
        $result->bindValue(':casinoId', $casinoId, PDO::PARAM_STR);
        $result->bindValue(':promotionId', $promotionId, PDO::PARAM_STR);
        $result->execute();





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
