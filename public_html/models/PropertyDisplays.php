<?php
require 'DisplayModel.php';

/**
 * Class PropertyDisplays
 * This class manages the sql statements for updating editing and assigning promotions
 * to displays.
 */
class PropertyDisplays
{
    private $conn;
    private $displays = [];
    /**
     * PropertyDisplays constructor.
     * @param $conn
     * @param $propertyId
     */
    public function __construct($conn, $propertyId){
        $this->conn = $conn;
        if ($propertyId != null) {
            $this->displays = $this->getAllDisplaysWithPropertyId($propertyId);
        }
    }

    /**
     * Get all displays with property ID
     * @param $propertyId
     * @return array
     */
        private function getAllDisplaysWithPropertyId($propertyId){
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
            if ($propertyId == 0) {
                array_push($displays, $display);
            }
        }
        return $displays;
    }

    /**
     * Get display with ID
     * @param $id
     * @return DisplayModel
     */
    public function getDisplayWithId($id) {
        $sql = "SELECT * FROM display WHERE display_id=" . $id;
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new DisplayModel($result);
    }

    /**
     * Assign display to property by property ID
     * @param $values
     * @return mixed
     */
    public function assignDisplayWithId($values) {
        $sql = "UPDATE display SET property_id = " . $values['propertyId'] . " WHERE display_id = " . $values['displayId'];
        echo $sql;
        $statement = $this->conn->prepare($sql);
        return $statement->execute();
    }

    /**
     * This gets promotions that are assigned to a display
     * @param $display
     * @return array
     */
    private function getDisplayPromotions($display) {
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
     * Get displays
     * @return array
     */
    public function getDisplays() {
        return $this->displays;
    }

    /**
     * Update display with ID
     * @param $id
     * @param $name
     * @param $displayLocation
     */
    public function updateDisplayWithId($id, $name, $displayLocation) {
        $sql = "UPDATE display SET display_name=:current_name, display_location=:display_location WHERE display_id=:id;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':current_name', $name, PDO::PARAM_STR);
        $result->bindValue(':display_location', $displayLocation, PDO::PARAM_STR);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
    }

    /**
     * Add promotion to display
     */
    public function addPromotionToDisplay($values) {
        $sql = "INSERT INTO `promotion_property`(`promotion_id`, `property_id`, `skin_id`, `display_id`, `scene_duration`, `active`)
        VALUES (:promotionId,:propertyId,:skinId,:display,:sceneDuration,:active)";
        $statement = $this->conn->prepare($sql);

        $statement->bindValue(':promotionId', $values['promotionId'], PDO::PARAM_STR);
        $statement->bindValue(':propertyId', $values['propertyId'], PDO::PARAM_STR);
        $statement->bindValue(':skinId', $values['skinId'], PDO::PARAM_STR);
        $statement->bindValue(':display', $values['displayId'], PDO::PARAM_STR);
        $statement->bindValue(':sceneDuration', $values['sceneDuration'], PDO::PARAM_STR);
        $statement->bindValue(':active', $values['active'], PDO::PARAM_STR);

        $statement->execute();
    }

    /**
     * Remove promotion from display
     * @param $promotionId
     * @param $displayId
     */
    public function removePromotionFromDisplay($promotionId, $displayId) {
        $sql = 'DELETE FROM `promotion_property` 
 WHERE promotion_property.promotion_id = :promotionId 
 AND promotion_property.display_id = :displayId';
        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':promotionId', $promotionId, PDO::PARAM_STR);
        $statement->bindValue(':displayId', $displayId, PDO::PARAM_STR);
        $statement->execute();
    }

    /**
     * Get skin types
     * @param $propertyId
     * @return mixed
     */
    public function getSkinTypes($propertyId) {
        $sql = 'SELECT skin.skin_name,skin.skin_id FROM skin WHERE skin.skin_casino = 0 OR skin.skin_casino = :propertyId;';
        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':propertyId', $propertyId, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Update promotion display settings
     * @param $promotionId
     * @param $displayId
     * @param $sceneDuration
     * @param $skinId
     */
    public function updatePromotionDisplaySettings($promotionId, $displayId, $sceneDuration, $skinId) {
        $sql = 'UPDATE promotion_property SET skin_id=:skinId, scene_duration=:sceneDuration
 WHERE promotion_property.promotion_id = :promotionId AND promotion_property.display_id = :displayId';
        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':promotionId', $promotionId, PDO::PARAM_STR);
        $statement->bindValue(':displayId', $displayId, PDO::PARAM_STR);
        $statement->bindValue(':skinId', $skinId, PDO::PARAM_STR);
        $statement->bindValue(':sceneDuration', $sceneDuration, PDO::PARAM_STR);
        $statement->execute();
    }
}