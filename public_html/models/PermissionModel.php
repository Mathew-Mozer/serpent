<?php

/**
 * PromotionModal class
 * This class contains all the permissions for a user to acces and alter properties and promotions.
 */
class PermissionModel
{

    protected $db;
    protected $loginId;
    protected $permissions;

    /**
     * PermissionModel constructor.
     * @param PDO $db
     * @param $loginId
     */
    public function __construct(PDO $db, $loginId)
    {
        $this->db = $db;
        $this->loginId = $loginId;

        $sql = "SELECT
                account_permissions.excess_id as propertyId, tag.tag_type as `tag`, account_permissions.permissions as permissions
              FROM
                account, account_permissions, tag
              WHERE
                account.account_id = :id
                AND account.account_id = account_permissions.account_id
                AND tag.tag_id = account_permissions.tag_id;";

        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $this->loginId, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);

        // Format permssions into an array.
        $this->permissions = array();
        foreach ($promoResult as $row) {
            foreach (str_split($row['permissions']) as $permissionChar) {
                $this->permissions[$row['tag']][$row['propertyId']]['permission'][$permissionChar] = true;
                $this->permissions[$row['tag']]['permission'][$permissionChar] = true;
            }
        }
    }

    /**
     * Base permission test for user.
     */
    public function hasPermissionById($tag, $excessId, $permission)
    {
        return isset($this->permissions[$tag][$excessId]) && isset($this->permissions[$tag][$excessId]['permission'][$permission]);
    }

    /**
     * Account permissions
     */
    public function hasPermissionByAccount($tag, $permission)
    {
        return isset($this->permissions[$tag]) && isset($this->permissions[$tag]['permission'][$permission]);
    }

    public function updateUserPermission($userId, $propertyId, $modType, $permValue,$tagId)
    {
        switch ($modType) {
            case 0:
                $sql = "update 
                            account_permissions 
                        set 
                          account_permissions.permissions=REPLACE(account_permissions.permissions,:permvalue,'')
                        where 
                          account_permissions.tag_id=:tagid
                        and 
                          account_permissions.account_id=:uid
                        and
                          excess_id=:propId LIMIT 1";
                break;
            case 1:
                //check for record first

                if($this->getPermissionRecordCount($userId,$tagId,$propertyId)==0){
                    $sql="INSERT INTO `account_permissions` (`account_id`, `tag_id`, `permissions`, `excess_id`) VALUES (:uid,:tagid,:permvalue ,:propId);";
                }else{
                    $sql="Update `account_permissions`  set permissions=concat(permissions, :permvalue) where `account_id`=:uid and `tag_id`=:tagid and `excess_id`=:propId;";
                }
                break;
        }

        $result = $this->db->prepare($sql);
        $result->bindValue(':uid', $userId, PDO::PARAM_STR);
        $result->bindValue(':permvalue', $permValue, PDO::PARAM_STR);
        $result->bindValue(':tagid', $tagId, PDO::PARAM_STR);
        $result->bindValue(':propId', $propertyId, PDO::PARAM_STR);
        $result->execute();
        return $result;
    }
public function getPermissionRecordCount($userId,$tagId,$propertyId){
    $sql = "select COUNT(*) 
                        from 
                          account_permissions
                        where
                          account_permissions.account_id=:uid 
                        and 
                          account_permissions.tag_id=:tagid 
                        and 
                          account_permissions.excess_id=:propId";
    $result = $this->db->prepare($sql);
    $result->bindValue(':uid', $userId, PDO::PARAM_STR);
    $result->bindValue(':tagid', $tagId, PDO::PARAM_STR);
    $result->bindValue(':propId', $propertyId, PDO::PARAM_STR);
    $result->execute();
    $results = $result->fetchColumn();
    return($results);
}
    public function getPermissionTagTriggers($propertyId)
    {
        $sql = "SELECT * FROM 
                    tag,tag_toggle tt 
                    INNER JOIN 
                    account_permissions 
                    ON 
                    account_permissions.permissions 
                    LIKE 
                      CONCAT('%', '', '%') 
                    left join tag_toggle_cat tc on 
                    	tc.tag_toggle_cat_id=tt.tag_toggle_catid
                    where 
                      account_permissions.tag_id=tt.tag_toggle_tag_id and
                      tag.tag_id=account_permissions.tag_id and
                      account_permissions.account_id=:uid 
                    and account_permissions.excess_id=:id;
                    ";
        $result = $this->db->prepare($sql);
        $result->bindValue(':uid', $this->loginId, PDO::PARAM_STR);
        $result->bindValue(':id', $propertyId, PDO::PARAM_STR);
        $result->execute();
        $results = $result->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}

?>
