<?php
// PromotionModal class
//
// author: Alex Onorati
// This class contains all the legal queries on the database property_serpent.
class PromotionModel {
    protected $db;
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    //This retrives all promotions that are stored.
    public function getAllPromotions() {
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

    /**
     * Get list of properties that logged in user can access
     * @return PDOStatement
     */
    public function getAssignableProperties(){
        $sql = "SELECT property_id,property_name 
                FROM property,account_permissions 
                WHERE account_permissions.excess_id=property_id 
                AND account_permissions.tag_id=1 
                AND account_permissions.permissions 
                LIKE '%R%' 
                AND account_permissions.account_id=" . $_SESSION['userId'] .";";

        $result = $this->db->prepare($sql);
        $result->execute();
        return $result;
    }

    public function getPromotionModelName($promtionTypeId)
    {
        $sql = "SELECT * FROM promotion_type WHERE promotion_type_id = :id";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $promtionTypeId, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetch();
        return $promoResult['promotion_type_class_name'];
    }

    public function getAllPromotionsByProperty($propertyId)
    {
        $sql = "SELECT
                      promotion.promotion_id as promo_id,
                      promotion.artifact as artifact,
                      promotion_type.promotion_type_id as promo_type_id,
                      promotion_type.promotion_type_title as promo_title,
                      promotion_type.promotion_type_image as promo_image,
                      promotion_type.promotion_type_file_name as file_name,
                      promo_property.promo_property_property_id as property_id
                    FROM
                      promotion, promotion_type, promo_property, property
                    WHERE
                      promo_property.promo_property_template = 0
                      AND promotion.promotion_type_id = promotion_type.promotion_type_id
                      AND  promotion.promotion_id = promo_property.promo_property_promo_id
                      AND property.property_id = promo_property.promo_property_property_id
                      AND promotion.promotion_visible = 1 AND property.property_id =  :id;
                    ";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $propertyId, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }

    public function getPromotionTypes($propertyId)
    {
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

    public function addPromotion($promotionTypeId, $propertyId, $sceneId)
    {
        $sql = "INSERT INTO promotion (promotion_type_id, artifact, promotion_sceneid) VALUES (:id, :artifact, :sceneId);";
        $artifact = $this->getRandomFontAwesome();
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $promotionTypeId, PDO::PARAM_STR);
        $result->bindValue(':artifact', $artifact, PDO::PARAM_STR);
        $result->bindValue(':sceneId', $sceneId, PDO::PARAM_STR);
        $result->execute();
        $promotionId = $this->db->lastInsertId();
        $sql = "INSERT INTO promo_property (promo_property_property_id, promo_property_promo_id) VALUES (:propertyId,:promotionId);";
        $result = $this->db->prepare($sql);
        $result->bindValue(':propertyId', $propertyId, PDO::PARAM_STR);
        $result->bindValue(':promotionId', $promotionId, PDO::PARAM_STR);
        $result->execute();

        $sql = "SELECT promotion_type.promotion_type_id as promo_type_id, 
                      promotion_type.promotion_type_title as promo_title, 
                      promotion_type.promotion_type_image as promo_image, 
                      promotion.artifact, promotion_type.promotion_type_file_name as file_name
                FROM promotion, promotion_type 
                WHERE promotion_type.promotion_type_id = promotion.promotion_type_id 
                AND promotion.promotion_id = :id;
                    ";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $promotionId, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetch(PDO::FETCH_ASSOC);
        $promoResult['promo_id'] = $promotionId;
        $promoResult['property_id'] =$propertyId;
        return $promoResult;
    }

    public function getPromotionImageByPromotionType($id)
    {
        $sql = "SELECT promotion_type_image as image FROM promotion_type WHERE promotion_type_id = :id;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetch(PDO::FETCH_ASSOC);
        return $promoResult['image'];
    }

    public function getPromotionById($id)
    {
        $sql = "SELECT promotion_type_id, promotion_visible, settings, artifact, promotion_sceneid, promotion_lastupdated FROM promotion WHERE promotion_id = :id;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetch(PDO::FETCH_ASSOC);
        return $promoResult;
    }

    public function getPromotionImageByPromotionId($id)
    {
        $sql = "SELECT promotion_type_image as image FROM promotion, promotion_type
                WHERE promotion.promotion_id =" . $id . " AND promotion_type.promotion_type_id = promotion.promotion_type_id";
        $result = $this->db->prepare($sql);
        $result->execute();
        $image = $result->fetch(PDO::FETCH_ASSOC);
        return $image;
    }

    public function getPromotionTypeById($id){
        $sql = "SELECT promotion_type.promotion_type_title, promotion.promotion_id
FROM promotion_type
INNER JOIN promotion
ON promotion_type.promotion_type_id = promotion.promotion_type_id
WHERE promotion.promotion_id = :id;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetch(PDO::FETCH_ASSOC);
        return $promoResult;
    }

    function getRandomFontAwesome()
    {
        $artifactList = $this->generateFontAwesomeArray();
        $artifactSelection = rand(0, sizeof($artifactList));
        return $artifactList[$artifactSelection];
    }

    public function getPromotionArtifactById($promotionId){
        $sql = "SELECT artifact FROM promotion WHERE promotion_id = :id;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $promotionId, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetch(PDO::FETCH_ASSOC);
        return $promoResult['artifact'];
    }

    public function generateFontAwesomeArray()
    {
        return $fontawesome = array('fa-ambulance','fa-anchor','fa-android','fa-arrow-down','fa-arrow-left','fa-arrow-right','fa-arrow-up','fa-at','fa-bath','fa-battery','fa-bell','fa-bicycle','fa-birthday-cake','fa-black-tie','fa-bolt','fa-bomb','fa-bug','fa-child','fa-coffee','fa-cut','fa-diamond','fa-dollar','fa-envira','fa-fa','fa-female','','fa-fighter-jet','fa-fort-awesome','fa-frown-o','fa-gift','fa-glass','fa-globe','fa-hand-peace-o','fa-hand-spock-o','fa-hourglass','fa-key','fa-lightbulb-o','fa-linux','fa-lock','fa-motorcycle','fa-mortar-board','fa-paper-plane','fa-rocket','fa-snowflake-o','fa-soccer-ball-o','fa-star','fa-thermometer','fa-thumbs-o-up','fa-tint','fa-tree','fa-umbrella');
    }
    public function getPromotionsByDisplayId($displayId){
        $sql1 = "SELECT
                      promotion.promotion_id as promo_id,
                      promotion_type.promotion_type_image,
                      promotion_type.promotion_type_file_name,
                      promotion_property.property_id,
                      promotion_property.display_id,
                      promotion_property.scene_duration,
                      promotion_property.skin_id,
                      promotion_type.promotion_type_title,
                      promotion_type.promotion_type_scene_verbage
                    FROM
                      promotion, promotion_type, promotion_property, property
                    WHERE
                      promotion.promotion_type_id = promotion_type.promotion_type_id
                      AND  promotion.promotion_id = promotion_property.promotion_id
                      AND property.property_id = promotion_property.property_id
                      AND promotion.promotion_visible = 1
                      AND promotion_property.active = 1
                      AND promotion_property.display_id = :id
                      GROUP BY promotion.promotion_id ORDER BY promotion_property.display_id;
                    ";
        $result = $this->db->prepare($sql1);
        $result->bindValue(':id', $displayId);
        $result->execute();
        $assignedpromotions = $result->fetchAll(PDO::FETCH_ASSOC);
        return $assignedpromotions;
    }

    public function getUnassignedPromotions($displayId, $acctID)
    {
        $sql = "SELECT * FROM account_permissions,promo_property p, promotion_type, promotion 
                WHERE NOT EXISTS ( SELECT null FROM promotion_property d 
                WHERE d.promotion_id = p.promo_property_promo_id 
                AND d.display_id=:display_id ) 
                AND p.promo_property_template = 0 
                AND promotion.promotion_id =p.promo_property_promo_id 
                AND p.promo_property_property_id=account_permissions.excess_id 
                AND promotion.promotion_type_id = promotion_type.promotion_type_id 
                AND account_permissions.tag_id=:acct_id 
                AND account_permissions.excess_id=p.promo_property_property_id 
                AND account_permissions.account_id=:acct_id 
                GROUP BY p.promo_property_promo_id";
        $result = $this->db->prepare($sql);
        $result->bindValue(':display_id', $displayId);
        $result->bindValue(':acct_id', $acctID);
        $result->execute();
        $unassignedPromotions = $result->fetchAll(PDO::FETCH_ASSOC);
        return $unassignedPromotions;
    }

    public function saveTemplate($values){
        $sql = "INSERT INTO promotion (promotion_type_id, promotion_sceneid) VALUES (:id, :sceneId);";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $values['promotionTypeId'], PDO::PARAM_STR);
        $result->bindValue(':sceneId', $values['sceneId'], PDO::PARAM_STR);
        $result->execute();
        $promotionId = $this->db->lastInsertId();

        $sql = "INSERT INTO promo_property (promo_property_property_id, promo_property_promo_id, promo_property_template,
                      promo_property_template_name) VALUES (:propertyId,:promotionId,:isTemplate,:template_name);";
        $result = $this->db->prepare($sql);
        $result->bindValue(':propertyId', $values['propertyId'], PDO::PARAM_STR);
        $result->bindValue(':promotionId', $promotionId, PDO::PARAM_STR);
        $result->bindValue(':isTemplate', 1, PDO::PARAM_STR);
        $result->bindValue(':template_name', $values['templateName'], PDO::PARAM_STR);
        $result->execute();

        return $promotionId;
    }

    public function getTemplates($values) {
        if($values['promotionType'] == 'kickforcash') {
            $sql = 'select promotion.promotion_id,promo_property.promo_property_promo_id,promo_property.promo_property_template_name
            from kick_for_cash,promotion,promo_property
            where promotion.promotion_id=promo_property.promo_property_promo_id 
            and kick_for_cash.kfc_promotion_id=promo_property.promo_property_promo_id 
            and promo_property.promo_property_property_id=:propertyId 
            and promo_property.promo_property_template=1';
        }
        else if($values['promotionType'] == 'pointsgt') {
            $sql = 'select promotion.promotion_id,promo_property.promo_property_promo_id,promo_property.promo_property_template_name
            from points_gt,promotion,promo_property
            where promotion.promotion_id=promo_property.promo_property_promo_id 
            and points_gt.pgt_promotion_id=promo_property.promo_property_promo_id 
            and promo_property.promo_property_property_id=:propertyId 
            and promo_property.promo_property_template=1';
        }
        else if($values['promotionType'] == 'highhand'){
            $sql = 'select promotion.promotion_id,promo_property.promo_property_promo_id,promo_property.promo_property_template_name
            from high_hand,promotion,promo_property
            where promotion.promotion_id=promo_property.promo_property_promo_id 
            and high_hand.promotion_id=promo_property.promo_property_promo_id 
            and promo_property.promo_property_property_id=:propertyId 
            and promo_property.promo_property_template=1';
        }

        $statement = $this->db->prepare($sql);
        $statement->bindValue(':propertyId', $values['propertyId'], PDO::PARAM_STR);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

}
?>