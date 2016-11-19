<?php

require 'DisplayModel.php';

class PropertyDisplays
{
    private $conn;
    private $displays = [];

    /**
     * PropertyDisplays constructor.
     * @param int $propertyId
     */
    public function __construct($conn,$propertyId)
    {
        $this->conn = $conn;
        $this->displays = $this->getAllDisplaysWithPropertyId($propertyId);
    }


    private function getAllDisplaysWithPropertyId($propertyId)
    {
        $getDisplays = "SELECT * FROM display WHERE display.property_id="
            . $propertyId . " ORDER BY display.id;";
        $displayStatement = $this->conn->prepare($getDisplays);
        $displayStatement->execute();
        $result = $displayStatement->fetchAll(PDO::FETCH_ASSOC);
        $displays = array();
        $count = 0;
        $display = null;
        foreach ($result as $array) {
            $display = new DisplayModel($array);
            if ($display->getName() != $array['name']) {
                if ($count != 0) {
                    $display->setPromotions($this->getDisplayPromotions($display->getId()));
                    array_push($displays, $display);
                }
                $count = 1;
            }
            if ($display->getName() != null) {
                $display->setPromotions($this->getDisplayPromotions($display->getId()));
                array_push($displays, $display);
            }
        }
        return $displays;
    }

    public function getDisplayWithId($id) {
        $sql = "SELECT * FROM display WHERE id=" . $id;
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new DisplayModel($result);
    }

    public function assignDisplayWithId($values) {

        $sql = "UPDATE display SET property_id = " . $values['propertyId'] . " WHERE id = " . $values['displayId'];

        echo $sql;

        $statement = $this->conn->prepare($sql);
        return $statement->execute();
    }

    private function getDisplayPromotions($display){
        $getPromotions = "SELECT * FROM promotion_property, promotion WHERE promotion_property.display_id =". $display. "
                AND promotion_property.promotion_id = promotion.id AND promotion.visible = 'T';";
        $statement = $this->conn->prepare($getPromotions);
        $statement->execute();
        $displayPromotions = $statement->fetchAll(PDO::FETCH_ASSOC);
        $temp = [];
        foreach ($displayPromotions as $promotion) {
            array_push($temp,$promotion);
        }
        return $temp;
    }

    /**
     * @return array
     */
    public function getDisplays()
    {
        return $this->displays;
    }

    public function updateDisplayWithId($id, $name, $displayLocation){
      $sql= "UPDATE display SET name=:current_name, display_location=:display_location WHERE id=:id;";

        $result = $this->conn->prepare($sql);
        $result->bindValue(':current_name', $name, PDO::PARAM_STR);
        $result->bindValue(':display_location', $displayLocation, PDO::PARAM_STR);
           $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
    }

    public function updatePromotionsInDisplay($insertConn, $displayId, $propertyId, $promotions){

      foreach($promotions as $promotion){

        $sql= "SELECT * FROM promotion_property WHERE promotion_id=:promotion_id AND property_id=:property_id;";

          $result = $this->conn->prepare($sql);
          $result->bindValue(':promotion_id', $promotion['promoId'], PDO::PARAM_STR);
          $result->bindValue(':property_id', $propertyId, PDO::PARAM_STR);
          $result->execute();
          if($result->rowCount() > 0){
            $sql= "UPDATE promotion_property SET display_id=:display_id WHERE promotion_id=:promotion_id AND property_id=:property_id;";

              $result = $this->conn->prepare($sql);
              if($promotion['checked']=="true"){
                $result->bindValue(':display_id', $displayId, PDO::PARAM_STR);
              }else{
                $result->bindValue(':display_id', 0, PDO::PARAM_STR);
              }
              $result->bindValue(':promotion_id', $promotion['promoId'], PDO::PARAM_STR);
              $result->bindValue(':property_id', $propertyId, PDO::PARAM_STR);
              $result->execute();
          }else if ($promotion['checked']=="true"){
            $sql= "INSERT INTO promotion_property (promotion_id, property_id, display_id)VALUES (:promotion_id, :propertyId, :display_id);";

              $result = $insertConn->prepare($sql);
              $result->bindValue(':promotion_id', $promotion['promoId'], PDO::PARAM_STR);
              $result->bindValue(':property_id', $propertyId, PDO::PARAM_STR);
              $result->bindValue(':display_id', $displayId, PDO::PARAM_STR);
              $result->execute();
          }

      }

    }
}
