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
                account_permissions.property_id as propertyId, tag.type as `tag`, account_permissions.permissions as permissions
              FROM
                account, account_permissions, tag
              WHERE
                account.id = :id
                AND account.id = account_permissions.account_id
                AND tag.id = account_permissions.tag_id;";

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
    * Checks to see if the user has permission to create a promtion under a property.
    */
    public function canCreatePropertyPromotion($propertyId){
      return $this->hasPermission('promotion', $propertyId, 'C');
    }

    /**
    * Checks to see if the user has permission to view a promotion under a property.
    */
    public function canViewPropertyPromotions($propertyId){
      return $this->hasPermission('promotion', $propertyId, 'R');
    }

    /**
    * Checks to see if the user has permission to update a promotion under a property.
    */
    public function canUpdatePropertyPromtion($propertyId){
      return $this->hasPermission('promotion', $propertyId, 'U');
    }

    /**
    * Checks to see if the user has permission to delete a promotion under a property.
    */
    public function canDeletePropertyPromotion($propertyId){
      return $this->hasPermission('promotion', $propertyId, 'D');
    }

    /**
    * Checks to see if the user has permission to create a property.
    */
    public function canCreateProperty(){
      return $this->hasPermissionByAccount('property', 'C');
    }

    /**
    * Checks to see if the user has permission to view a property.
    */
    public function canViewProperty($propertyId){
      return $this->hasPermission('property', $propertyId, 'R');
    }

    /**
    * Checks to see if the user has permission to update a property.
    */
    public function canUpdateProperty($propertyId){
      return $this->hasPermission('property', $propertyId, 'U');
    }

    /**
    * Checks to see if the user has permission to delete a property.
    */
    public function canDeleteCProperty(){
      return $this->hasPermission('property', $propertyId, 'D');
    }

    /**
    * Checks to see if the user has permission to create a property.
    */
    public function canCreateAccount(){
      return $this->hasPermissionByAccount('account', 'C');
    }

    /**
    * Checks to see if the user has permission to view a property.
    */
    public function canViewAccount($propertyId){
      return $this->hasPermission('account', $propertyId, 'R');
    }

    /**
    * Checks to see if the user has permission to update a property.
    */
    public function canUpdateAccount($propertyId){
      return $this->hasPermission('account', $propertyId, 'U');
    }

    /**
    * Checks to see if the user has permission to delete a property.
    */
    public function canDeleteAccount($propertyId){
      return $this->hasPermission('account', $propertyId, 'D');
    }


    /**
    * Base permission test for user.
    */
    public function hasPermission($tag, $propertyId, $permission){
      return isset($this->permissions[$tag][$propertyId]) && isset($this->permissions[$tag][$propertyId]['permission'][$permission]);
    }

	/**
	* Account permissions
	*/
    public function hasPermissionByAccount($tag, $permission){
      return isset($this->permissions[$tag]) && isset($this->permissions[$tag]['permission'][$permission]);
    }
  }
  ?>
