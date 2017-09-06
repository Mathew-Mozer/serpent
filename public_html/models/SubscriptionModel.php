<?php

/**
 * PromotionModal class
 * This class contains all the permissions for a user to acces and alter properties and promotions.
 */
class SubscriptionModel
{

    protected $db;
    protected $propertyId;
    protected $permissions;

    /**
     * PermissionModel constructor.
     * @param PDO $db
     * @param $loginId
     */
    public function __construct(PDO $db)
{
    $this->db = $db;
}
public function updateSubscription($vars){
    if($vars['permValue']==1){
        $sql = "insert into subscription (promotion_type_id,property_id) value(:promotionId,:propertyid);";
        $result = $this->db->prepare($sql);
        $result->bindValue(':propertyid', $vars['propertyId'], PDO::PARAM_STR);
        $result->bindValue(':promotionId', $vars['promoId'], PDO::PARAM_STR);
        $result->execute();
        return $result;
    }else{
        $sql = "delete from subscription where promotion_type_id=:promotionId and property_id=:propertyid;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':propertyid', $vars['propertyId'], PDO::PARAM_STR);
        $result->bindValue(':promotionId', $vars['promoId'], PDO::PARAM_STR);
        $result->execute();
    }
    /*
    $sql = "update promotion set promotion_status=:newstatus where promotion_id=:promotionId;";
    $result = $this->db->prepare($sql);
    $result->bindValue(':newstatus', $newstatus, PDO::PARAM_STR);
    $result->bindValue(':promotionId', $promotionId, PDO::PARAM_STR);
    $result->execute();
    */
}
    public function getSubscribedPromotions($propertyId)
    {
        $sql = "SELECT * FROM subscription WHERE property_id = :id;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $propertyId, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }

}

?>
