<?php
/**
  * PromotionModal class
  *
  * author: Alex Onorati
  * This class contains all the permissions for a user to acces and alter casinos and promotions.
*/
  class PermissionModal{

    protected $db;
    protected $loginId;
    protected $permissions;

    public function __construct(PDO $db, $loginId){
      $this->db = $db;
      $this->loginId = $loginId;

      $sql = "SELECT
                account_permissions.casino_id as casinoId, tag.type as `tag`, account_permissions.permissions as permissions
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
          $this->permissions[$row['tag']][$row['casinoId']]['permission'][$permissionChar] = true;
          $this->permissions[$row['tag']]['permission'][$permissionChar] = true;
        }
      }
    }

    /**
    * Checks to see if the user has permission to create a promtion under a casino.
    */
    public function canCreateCasinoPromotion($casinoId){
      return $this->hasPermission('promotion', $casinoId, 'C');
    }

    /**
    * Checks to see if the user has permission to view a promotion under a casino.
    */
    public function canViewCasinoPromotions($casinoId){
      return $this->hasPermission('promotion', $casinoId, 'R');
    }

    /**
    * Checks to see if the user has permission to update a promotion under a casino.
    */
    public function canUpdateCasinoPromtion($casinoId){
      return $this->hasPermission('promotion', $casinoId, 'U');
    }

    /**
    * Checks to see if the user has permission to delete a promotion under a casino.
    */
    public function canDeleteCasinoPromotion($casinoId){
      return $this->hasPermission('promotion', $casinoId, 'D');
    }

    /**
    * Checks to see if the user has permission to create a casino.
    */
    public function canCreateCasino(){
      return $this->hasPermissionByAccount('casino', 'C');
    }

    /**
    * Checks to see if the user has permission to view a casino.
    */
    public function canViewCasino($casinoId){
      return $this->hasPermission('casino', $casinoId, 'R');
    }

    /**
    * Checks to see if the user has permission to update a casino.
    */
    public function canUpdateCasino($casinoId){
      return $this->hasPermission('casino', $casinoId, 'U');
    }

    /**
    * Checks to see if the user has permission to delete a casino.
    */
    public function canDeleteCasino(){
      return $this->hasPermission('casino', $casinoId, 'D');
    }

    /**
    * Checks to see if the user has permission to create a casino.
    */
    public function canCreateAccount(){
      return $this->hasPermissionByAccount('account', 'C');
    }

    /**
    * Checks to see if the user has permission to view a casino.
    */
    public function canViewAccount($casinoId){
      return $this->hasPermission('account', $casinoId, 'R');
    }

    /**
    * Checks to see if the user has permission to update a casino.
    */
    public function canUpdateAccount($casinoId){
      return $this->hasPermission('account', $casinoId, 'U');
    }

    /**
    * Checks to see if the user has permission to delete a casino.
    */
    public function canDeleteAccount($casinoId){
      return $this->hasPermission('account', $casinoId, 'D');
    }


    /**
    * Base permission test for user.
    */
    private function hasPermission($tag, $casinoId, $permission){
      return isset($this->permissions[$tag][$casinoId]) && isset($this->permissions[$tag][$casinoId]['permission'][$permission]);
    }

    private function hasPermissionByAccount($tag, $permission){
      return isset($this->permissions[$tag]) && isset($this->permissions[$tag]['permission'][$permission]);
    }
  }
  ?>
