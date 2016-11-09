<?php

require 'BoxModel.php';

class CasinoBoxes
{
    private $conn;
    private $boxes = [];

    /**
     * CasinoBoxes constructor.
     * @param int $casinoId
     */
    public function __construct($conn,$casinoId)
    {
        $this->conn = $conn;
        $this->boxes = $this->getAllBoxesWithCasinoId($casinoId);
    }


    private function getAllBoxesWithCasinoId($casinoId)
    {
        $getBoxes = "SELECT * FROM box WHERE box.casino_id="
            . $casinoId . " ORDER BY box.id;";
        $boxStatement = $this->conn->prepare($getBoxes);
        $boxStatement->execute();
        $result = $boxStatement->fetchAll(PDO::FETCH_ASSOC);
        $boxes = array();
        $count = 0;
        $box = null;
        foreach ($result as $array) {
            $box = new BoxModel($array);
            if ($box->getName() != $array['name']) {
                if ($count != 0) {
                    $box->setPromotions($this->getBoxPromotions($box->getId()));
                    array_push($boxes, $box);
                }
                $count = 1;
            }
            if ($box->getName() != null) {
                $box->setPromotions($this->getBoxPromotions($box->getId()));
                array_push($boxes, $box);
            }
        }
        return $boxes;
    }

    public function getBoxWithId($id) {
        $sql = "SELECT * FROM box WHERE id=" . $id;
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new BoxModel($result);
    }

    public function updateBoxWithId($values) {

        $sql = "UPDATE box SET casino_id = " . $values['casinoId'] . " WHERE id = " . $values['boxId'];

        echo $sql;

        $statement = $this->conn->prepare($sql);
        return $statement->execute();
    }

    private function getBoxPromotions($box){
        $getPromotions = "SELECT * FROM promotion_casino, promotion WHERE promotion_casino.box_id =". $box. " AND promotion_casino.promotion_id = promotion.id AND promotion.visible = 'T';";
        $statement = $this->conn->prepare($getPromotions);
        $statement->execute();
        $boxPromotions = $statement->fetchAll(PDO::FETCH_ASSOC);
        $temp = [];
        foreach ($boxPromotions as $promotion) {
            array_push($temp,$promotion);
        }
        return $temp;
    }

    /**
     * @return array
     */
    public function getBoxes()
    {
        return $this->boxes;
    }

    public function updateDisplayWithId($id, $name, $displayLocation){
      $sql= "UPDATE box SET name=:current_name, display_location=:display_location WHERE id=:id;";

        $result = $this->conn->prepare($sql);
        $result->bindValue(':current_name', $name, PDO::PARAM_STR);
        $result->bindValue(':display_location', $displayLocation, PDO::PARAM_STR);
           $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
    }

    public function updatePromotionsInDisplay($insertConn, $boxId, $casinoId, $promotions){

      foreach($promotions as $promotion){

        $sql= "SELECT * FROM promotion_casino WHERE promotion_id=:promotion_id AND casino_id=:casino_id;";

          $result = $this->conn->prepare($sql);
          $result->bindValue(':promotion_id', $promotion['promoId'], PDO::PARAM_STR);
          $result->bindValue(':casino_id', $casinoId, PDO::PARAM_STR);
          $result->execute();
          if($result->rowCount() > 0){
            $sql= "UPDATE promotion_casino SET box_id=:box_id WHERE promotion_id=:promotion_id AND casino_id=:casino_id;";

              $result = $this->conn->prepare($sql);
              if($promotion['checked']=="true"){
                $result->bindValue(':box_id', $boxId, PDO::PARAM_STR);
              }else{
                $result->bindValue(':box_id', 0, PDO::PARAM_STR);
              }
              $result->bindValue(':promotion_id', $promotion['promoId'], PDO::PARAM_STR);
              $result->bindValue(':casino_id', $casinoId, PDO::PARAM_STR);
              $result->execute();
          }else if ($promotion['checked']=="true"){
            $sql= "INSERT promotion_casino (promotion_id, casino_id, box_id)VALUES (:promotion_id, :casinoId, :box_id);";

              $result = $insertConn->prepare($sql);
              $result->bindValue(':promotion_id', $promotion['promoId'], PDO::PARAM_STR);
              $result->bindValue(':casino_id', $casinoId, PDO::PARAM_STR);
              $result->bindValue(':box_id', $boxId, PDO::PARAM_STR);
              $result->execute();
          }

      }

    }
}
