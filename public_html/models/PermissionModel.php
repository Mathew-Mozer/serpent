<?php
/**
  * PromotionModal class
  *
  * author: Alex Onorati
  * This class contains all the permissions for a user to acces and alter properties and promotions.
*/
  class PermissionModel{

    protected $db;
    protected $loginId;
    protected $permissions;

	/**
	* Get Constructor
	*/
    public function __construct(PDO $db, $loginId){
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
      foreach( $promoResult as $row){
        foreach(str_split($row['permissions']) as $permissionChar){
          $this->permissions[$row['tag']][$row['propertyId']]['permission'][$permissionChar] = true;
          $this->permissions[$row['tag']]['permission'][$permissionChar] = true;
        }
      }
    }

    /**
    * Base permission test for user.
    */
    public function hasPermissionById($tag, $excessId, $permission){
      return isset($this->permissions[$tag][$excessId]) && isset($this->permissions[$tag][$excessId]['permission'][$permission]);
    }

	/**
	* Account permissions
	*/
    public function hasPermissionByAccount($tag, $permission){
      return isset($this->permissions[$tag]) && isset($this->permissions[$tag]['permission'][$permission]);
    }
  }
  ?>
