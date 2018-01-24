<?php
if (!isset($_SESSION)) {
    session_start();
}
// PromotionModal class
//
// author: Alex Onorati
// This class contains all the legal queries on the database property_serpent.
class PromotionModel
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    //This retrives all promotions that are stored.
    public function getAllPromotions()
    {
        $sql = "SELECT
                promotion.promotion_id as promo_id,
                promotion_type.promotion_type_title as promo_title,
                promotion_type.promotion_type_image as promo_image
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

    public function getPromotionProperties()
    {
        $sql = "SELECT * FROM property where property_active=1;";
        $result = $this->db->prepare($sql);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }

    public function getPropertyInformation($promotionID)
    {
        $sql = "SELECT * FROM property where property_id = (select promo_property_property_id from promo_property where promo_property_promo_id=?);";
        $result = $this->db->prepare($sql);
        $result->execute(array($promotionID));
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }
    /**
     * Get list of properties that logged in user can access
     * @return PDOStatement
     */
    public function getAssignableProperties()
    {


        if ($_SESSION['isGod']) {
            $sql = "SELECT property_id,property_name 
                FROM property";
        } else {
            $sql = "SELECT property_id,property_name 
                FROM property,account_permissions 
                WHERE account_permissions.excess_id=property_id 
                AND account_permissions.tag_id=1 
                AND account_permissions.permissions 
                LIKE '%R%' 
                AND account_permissions.account_id=" . $_SESSION['userId'] . ";";
        }
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

    public function getAllPromotionsByProperty($propertyId,$type=0)
    {
            $tmp="";
        if($type!=0){
            $tmp = " AND promotion.promotion_type_id=".$type;
        }
        $sql = "SELECT *,
                      promotion.promotion_status as promo_status,
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
                      promo_property.promo_property_template = 0".
                    $tmp." AND promotion.promotion_type_id = promotion_type.promotion_type_id
                      AND promotion.promotion_parent=0 
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
    public function getPromotionDetails($promoid){
        $sql = "SELECT *,
                      promotion.promotion_status as promo_status,
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
                      AND promotion.promotion_visible = 1 AND promotion.promotion_id = :id;
                    ";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $promoid, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetch(PDO::FETCH_ASSOC);
        return $promoResult;
    }
    public function getPromotionTypes($propertyId)
    {
        if ($_SESSION['isGod']) {
            $sql = "SELECT
               promotion_type.promotion_type_id as promo_id,
               promotion_type.promotion_type_title as promo_title,
               promotion_type.promotion_type_image as promo_image,
               promotion_type.promotion_type_file_name as file_name
             FROM
               promotion_type
            WHERE promotion_type.promotion_type_file_name!=''
            order by promotion_type_id asc
               ;";
            $result = $this->db->prepare($sql);

        } else {
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
             order by promotion_type.promotion_type_id asc
               ;";
            $result = $this->db->prepare($sql);
            $result->bindValue(':propertyId', $propertyId);
        }

        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }

    public function updatePromotionStatus($promotionId, $newstatus)
    {
        $sql = "update promotion set promotion_status=:newstatus where promotion_id=:promotionId;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':newstatus', $newstatus, PDO::PARAM_STR);
        $result->bindValue(':promotionId', $promotionId, PDO::PARAM_STR);
        $result->execute();

        $sql = "SELECT promotion_status as promo_status
                FROM promotion
                where promotion.promotion_id = :id;
                    ";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $promotionId, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetch(PDO::FETCH_ASSOC);
        $this->setUpdatedTimestamp($promotionId);
        return $promoResult;
    }
    public function linkChildToParent($post){
        $parentId=$post["parentId"];
        $childId=$post["childId"];
        $sql = "update promotion set promotion_parent=:newparentid where promotion_id=:promotionId;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':newparentid', $parentId, PDO::PARAM_STR);
        $result->bindValue(':promotionId', $childId, PDO::PARAM_STR);
        $result->execute();
    }
    public function archivePromotion($promotionId)
    {
        $sql = "update promotion set promotion_visible=0 where promotion_id=:promotionId limit 1";
        $result = $this->db->prepare($sql);
        $result->bindValue(':promotionId', $promotionId, PDO::PARAM_STR);
        $result->execute();
        $rowcount = $result->rowCount();
        $sql = "delete from promotion_property where promotion_property.promotion_id=:promotionId";
        $result = $this->db->prepare($sql);
        $result->bindValue(':promotionId', $promotionId, PDO::PARAM_STR);
        $result->execute();
        $this->setUpdatedTimestamp($promotionId);
        return $rowcount;

    }

    public function addPromotion($post)
    {
        $promotionTypeId=$post['promotionTypeId'];
        $propertyId=$post['propertyId'];
        $sceneId=$post['scene_id'];
        $chosenSkin=$post['chosenSkin'];
        $promolabel = $post['Promotion-Label'];
        $animation =$post['Promotion-Animation'];
        $sql = "INSERT INTO promotion (promotion_type_id, artifact, promotion_sceneid,promotion_skin,promotion_label,promotion_animation) VALUES (:id, :artifact, :sceneId,:skinId, :promolabel,:animation);";
        $artifact = $this->getRandomFontAwesome();
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $promotionTypeId, PDO::PARAM_STR);
        $result->bindValue(':artifact', $artifact, PDO::PARAM_STR);
        $result->bindValue(':sceneId', $sceneId, PDO::PARAM_STR);
        $result->bindValue(':skinId', $chosenSkin, PDO::PARAM_STR);
        $result->bindValue(':promolabel', $promolabel, PDO::PARAM_STR);
        $result->bindValue(':animation', $animation, PDO::PARAM_STR);

        $result->execute();

        $promotionId = $this->db->lastInsertId();
        $sql = "INSERT INTO promo_property (promo_property_property_id, promo_property_promo_id) VALUES (:propertyId,:promotionId);";
        $result = $this->db->prepare($sql);
        $result->bindValue(':propertyId', $propertyId, PDO::PARAM_STR);
        $result->bindValue(':promotionId', $promotionId, PDO::PARAM_STR);
        $result->execute();
        $sql = "SELECT *,promotion_type.promotion_type_id as promo_type_id, 
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
        $promoResult['property_id'] = $propertyId;

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
        $sql = "SELECT *, promotion_type_id, promotion_visible, settings, artifact, promotion_sceneid, promotion_lastupdated FROM promotion WHERE promotion_id = :id;";
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
    public function getPromotionChildren($id){
        $sql = "SELECT *,
                      promotion.promotion_status as promo_status,
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
                      AND promotion.promotion_visible = 1 AND promotion.promotion_parent =  :id;
                    ";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }
    public function getPromotionTypeById($id)
    {
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
    public function getAllPromotionTypes()
    {
        $sql = "SELECT * FROM promotion_type";
        $result = $this->db->prepare($sql);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }

    public function setUpdatedTimestamp($promotionId)
    {

        $sql = "update promotion set promotion_lastupdated=now() where promotion_id=:promotionId;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':promotionId', $promotionId, PDO::PARAM_STR);
        $result->execute();
        //echo($result->rowCount());
    }

    function getRandomFontAwesome()
    {
        $artifactList = $this->generateFontAwesomeArray();
        $artifactSelection = rand(0, sizeof($artifactList));
        return $artifactList[$artifactSelection];
    }

    public function getPromotionArtifactById($promotionId)
    {
        $sql = "SELECT artifact FROM promotion WHERE promotion_id = :id;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $promotionId, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetch(PDO::FETCH_ASSOC);
        return $promoResult['artifact'];
    }

    public function generateFontAwesomeArray()
    {
        return $fontawesome = array('fa-ambulance', 'fa-anchor', 'fa-android', 'fa-arrow-down', 'fa-arrow-left', 'fa-arrow-right', 'fa-arrow-up', 'fa-at', 'fa-bath', 'fa-battery', 'fa-bell', 'fa-bicycle', 'fa-birthday-cake', 'fa-black-tie', 'fa-bolt', 'fa-bomb', 'fa-bug', 'fa-child', 'fa-coffee', 'fa-cut', 'fa-diamond', 'fa-dollar', 'fa-envira', 'fa-fa', 'fa-female', '', 'fa-fighter-jet', 'fa-fort-awesome', 'fa-frown-o', 'fa-gift', 'fa-glass', 'fa-globe', 'fa-hand-peace-o', 'fa-hand-spock-o', 'fa-hourglass', 'fa-key', 'fa-lightbulb-o', 'fa-linux', 'fa-lock', 'fa-motorcycle', 'fa-mortar-board', 'fa-paper-plane', 'fa-rocket', 'fa-snowflake-o', 'fa-soccer-ball-o', 'fa-star', 'fa-thermometer', 'fa-thumbs-o-up', 'fa-tint', 'fa-tree', 'fa-umbrella');
    }

    public function getPromotionsByDisplayId($displayId)
    {
        $sql1 = "SELECT *,
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

        if ($_SESSION['isGod']) {
            $sql = "SELECT * FROM account_permissions,promo_property p, promotion_type, promotion, property 
                WHERE NOT EXISTS ( SELECT null FROM promotion_property d 
                WHERE d.promotion_id = p.promo_property_promo_id 
                AND d.display_id=:display_id) 
                AND p.promo_property_template = 0 
                AND promotion.promotion_visible=1
                AND promotion.promotion_id =p.promo_property_promo_id 
                AND p.promo_property_property_id=account_permissions.excess_id 
                AND promotion.promotion_type_id = promotion_type.promotion_type_id 
                AND property.property_id = promo_property_property_id
                AND promotion.promotion_parent=0
                GROUP BY p.promo_property_promo_id";
        } else {
            $sql = "SELECT * FROM account_permissions,promo_property p, promotion_type, promotion,property 
                WHERE NOT EXISTS ( SELECT null FROM promotion_property d 
                WHERE d.promotion_id = p.promo_property_promo_id 
                AND d.display_id=:display_id ) 
                AND p.promo_property_template = 0 
                AND promotion.promotion_visible=1
                AND promotion.promotion_id =p.promo_property_promo_id 
                AND p.promo_property_property_id=account_permissions.excess_id 
                AND promotion.promotion_type_id = promotion_type.promotion_type_id 
                AND account_permissions.tag_id='2' 
                AND account_permissions.excess_id=p.promo_property_property_id
                AND account_permissions.account_id=:acct_id
                AND property.property_id = promo_property_property_id
                AND promotion.promotion_parent=0
                GROUP BY p.promo_property_promo_id";
        }


        $result = $this->db->prepare($sql);
        $result->bindValue(':display_id', $displayId);
        if (!$_SESSION['isGod']) {
            $result->bindValue(':acct_id', $acctID);
        }
        $result->execute();
        $unassignedPromotions = $result->fetchAll(PDO::FETCH_ASSOC);
        //print_r($unassignedPromotions);
        return $unassignedPromotions;
    }

    public function saveTemplate($values)
    {
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

    public function addSession($values)
    {
        $sql = "INSERT INTO promotion_session_time (promotion_sessiontime_startday, promotion_sessiontime_starttime,promotion_sessiontime_endday,promotion_sessiontime_endtime,promotion_sessiontime_promoid) VALUES (:sDay, :sTime,:eDay,:eTime,:promoId);";
        $result = $this->db->prepare($sql);
        $result->bindValue(':sDay', $values['sDay'], PDO::PARAM_STR);
        $result->bindValue(':sTime', $values['sTime'], PDO::PARAM_STR);
        $result->bindValue(':eDay', $values['eDay'], PDO::PARAM_STR);
        $result->bindValue(':eTime', $values['eTime'], PDO::PARAM_STR);
        $result->bindValue(':promoId', $values['promoId'], PDO::PARAM_STR);
        $result->execute();
        return $result;
    }
    public function removeSession($values)
    {
        $sql = "Delete from promotion_session_time where promotion_sessiontime_id=:sessionId;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':sessionId', $values['sessionId'], PDO::PARAM_STR);
            $result->execute();
        return $result;
    }

    public function getSessions($values){
        $sql = "select *,DAYOFWEEK('".date('Y/m/d')."') as curdayow from promotion_session_time where promotion_sessiontime_promoid=:promoid";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':promoid', $values['promoId'], PDO::PARAM_STR);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
//var_dump($results);
        return $results;
}
    public function getTemplates($values)
    {
        if ($values['promotionType'] == 'kickforcash') {
            $sql = 'select promotion.promotion_id,promo_property.promo_property_promo_id,promo_property.promo_property_template_name
            from kick_for_cash,promotion,promo_property
            where promotion.promotion_id=promo_property.promo_property_promo_id 
            and kick_for_cash.kfc_promotion_id=promo_property.promo_property_promo_id 
            and promo_property.promo_property_property_id=:propertyId 
            and promo_property.promo_property_template=1';
        } else if ($values['promotionType'] == 'pointsgt') {
            $sql = 'select promotion.promotion_id,promo_property.promo_property_promo_id,promo_property.promo_property_template_name
            from points_gt,promotion,promo_property
            where promotion.promotion_id=promo_property.promo_property_promo_id 
            and points_gt.pgt_promotion_id=promo_property.promo_property_promo_id 
            and promo_property.promo_property_property_id=:propertyId 
            and promo_property.promo_property_template=1';
        } else if ($values['promotionType'] == 'highhand') {
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