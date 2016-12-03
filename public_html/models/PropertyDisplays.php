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
        if($propertyId != null){
            $this->displays = $this->getAllDisplaysWithPropertyId($propertyId);
        }
    }


    private function getAllDisplaysWithPropertyId($propertyId)
    {
        $getDisplays = "SELECT * FROM display WHERE display.property_id="
            . $propertyId . " ORDER BY display.display_id;";
        $displayStatement = $this->conn->prepare($getDisplays);
        $displayStatement->execute();
        $result = $displayStatement->fetchAll(PDO::FETCH_ASSOC);
        $displays = array();
        $count = 0;
        $display = null;
        foreach ($result as $array) {
            $display = new DisplayModel($array);
            if ($display->getName() != $array['display_name']) {
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
        $sql = "SELECT * FROM display WHERE display_id=" . $id;
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new DisplayModel($result);
    }

    public function assignDisplayWithId($values)
    {
        $sql = "UPDATE display SET property_id = " . $values['propertyId'] . " WHERE display_id = " . $values['displayId'];

        echo $sql;

        $statement = $this->conn->prepare($sql);
        return $statement->execute();
    }

    private function getDisplayPromotions($display){
        $getPromotions = "SELECT * FROM `promotion_property` WHERE display_id =:display";
        $statement = $this->conn->prepare($getPromotions);

        $statement->bindValue(':display',$display, PDO::PARAM_STR);
        $statement->execute();
        $displayPromotions = $statement->fetchAll(PDO::FETCH_ASSOC);
        $temp = [];
        foreach ($displayPromotions as $promotion) {
            array_push($temp, $promotion);
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
      $sql= "UPDATE display SET display_name=:current_name, display_location=:display_location WHERE display_id=:id;";

        $result = $this->conn->prepare($sql);
        $result->bindValue(':current_name', $name, PDO::PARAM_STR);
        $result->bindValue(':display_location', $displayLocation, PDO::PARAM_STR);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
    }

    public function addPromotionToDisplay(){
        $sql ="INSERT INTO `promotion_property`(`promotion_id`, `property_id`, `skin_id`, `display_id`, `scene_duration`, `active`)
                VALUES (308,14,0,16,1,1)";
        $statement = $this->conn->prepare($sql);
        $statement->execute();


    }

    public function removePromotionFromDisplay($promotionId,$displayId){
       $sql =  'DELETE FROM `promotion_property` 
                WHERE promotion_property.promotion_id = :promotionId 
                AND promotion_property.display_id = :displayId';
        $statement = $this->conn->prepare($sql);

        $statement->bindValue(':promotionId',$promotionId, PDO::PARAM_STR);
        $statement->bindValue(':displayId',$displayId, PDO::PARAM_STR);
        $statement->execute();
    }

    public function getSkinTypes($propertyId) {
        $sql = 'SELECT skin.skin_name,skin.skin_id FROM skin WHERE skin.skin_casino = 0 OR skin.skin_casino = :propertyId;';
        $statement = $this->conn->prepare($sql);

        $statement->bindValue(':propertyId',$propertyId, PDO::PARAM_STR);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
