<?php
  // PromotionModal class
  //
  // author: Alex Onorati
  // This class contains all the legal queries on the database casino_serpent.

  class PermissionModal{

    protected $db;
    protected $loginId;

    public function __construct(PDO $db, $loginId){
      $this->db = $db;
      $this->loginId = $loginId;
    }

    public function setLoginId($loginId){
      $this->loginId = $loginId;
    }

    public function canCreateAPromotionInACasino($casinoId){
      $sql = "SELECT
                *
              FROM
                account, account_permissions
              WHERE
                account_permissions.casino_id = :casinoId
                AND account.id = :id
                AND account.id = account_permissions.account_id
                AND account_permissions.tag_id = 1
                AND account_permissions.permissions LIKE ('%C%');
              ";
              
      $result = $this->db->prepare($sql);
      $result->bindValue(':casinoId', $casinoId, PDO::PARAM_STR);
      $result->bindValue(':id', $this->loginId, PDO::PARAM_STR);
      $result->execute();

      $promoResult = $result->rowCount();

      return $promoResult > 0;
    }

    public function canSeeAPromotionsInACasino($casinoId){
      $sql = "SELECT
                *
              FROM
                account, account_permissions
              WHERE
                account_permissions.casino_id = :casinoId
                AND account.id = :id
                AND account.id = account_permissions.account_id
                AND account_permissions.tag_id = 1
                AND account_permissions.permissions LIKE ('%R%');
              ";
      $result = $this->db->prepare($sql);
      $result->bindValue(':casinoId', $casinoId, PDO::PARAM_STR);
      $result->bindValue(':id', $this->loginId, PDO::PARAM_STR);
      $result->execute();

      $promoResult = $result->rowCount();

      return $promoResult > 0;
    }

    public function canSeePromotion($promotionId, $casinoPromotion){

    }
  }
  ?>
