<?php

require 'DisplayModel.php';

class CasinoDisplays
{
    private $conn;
    private $displays = [];

    /**
     * CasinoDisplays constructor.
     * @param int $casinoId
     */
    public function __construct($conn, $casinoId)
    {
        $this->conn = $conn;
        $this->displays = $this->getAllDisplaysWithCasinoId($casinoId);
    }


    private function getAllDisplaysWithCasinoId($casinoId)
    {
        $getDisplays = "SELECT * FROM display WHERE display.casino_id="
            . $casinoId . " ORDER BY display.id;";
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

    public function getDisplayWithId($id)
    {
        $sql = "SELECT * FROM display WHERE id=" . $id;
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new DisplayModel($result);
    }

    public function assignDisplayWithId($values)
    {

        $sql = "UPDATE display SET casino_id = " . $values['casinoId'] . " WHERE id = " . $values['displayId'];

        echo $sql;

        $statement = $this->conn->prepare($sql);
        return $statement->execute();
    }

    private function getDisplayPromotions($display)
    {
        $getPromotions = "SELECT * FROM promotion_casino, promotion WHERE promotion_casino.display_id =" . $display . " 
                AND promotion_casino.promotion_id = promotion.id AND promotion.visible = 'T';";
        $statement = $this->conn->prepare($getPromotions);
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

    public function updateDisplayWithId($id, $name, $displayLocation)
    {
        $sql = "UPDATE display SET name=:current_name, display_location=:display_location WHERE id=:id;";

        $result = $this->conn->prepare($sql);
        $result->bindValue(':current_name', $name, PDO::PARAM_STR);
        $result->bindValue(':display_location', $displayLocation, PDO::PARAM_STR);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
    }

    public function updatePromotionsInDisplay($dbdelete, $dbinsert, $displayId, $casinoId, $promotions)
    {

        foreach ($promotions as $promotion) {

            $sql = "SELECT * FROM promotion_casino WHERE promotion_id=:promotion_id AND display_id=:display_id;";

            $result = $this->conn->prepare($sql);
            $result->bindValue(':promotion_id', $promotion['promoId'], PDO::PARAM_STR);
            $result->bindValue(':display_id', $displayId, PDO::PARAM_STR);
            $result->execute();

            if ($result->rowCount() > 0) {
                if ($promotion['checked'] == "true") {
                    $sql = "UPDATE promotion_casino SET scene_duration = :scene_duration, skin_id = :skin_id
                      WHERE promotion_casino.promotion_id = :promotion_id AND display_id = :display_id;";

                    $result = $this->conn->prepare($sql);
                    $result->bindValue(':scene_duration', $promotion['sceneDuration'], PDO::PARAM_INT);
                    $result->bindValue(':skin_id', $promotion['skinId'], PDO::PARAM_INT);

                } else {
                    $sql = "DELETE FROM `promotion_casino` 
                      WHERE promotion_id = :promotion_id AND display_id = :display_id";
                    $result = $dbdelete->prepare($sql);
                }

                $result->bindValue(':display_id', $displayId, PDO::PARAM_STR);
                $result->bindValue(':promotion_id', $promotion['promoId'], PDO::PARAM_STR);

                $result->execute();
            } else if ($promotion['checked'] == "true") {
                $sql = "INSERT INTO promotion_casino (promotion_id, casino_id, display_id, scene_duration)
                        VALUES (:promotion_id, :casino_id, :display_id, :scene_duration);";

                $result = $dbinsert->prepare($sql);
                $result->bindValue(':promotion_id', $promotion['promoId'], PDO::PARAM_STR);
                $result->bindValue(':casino_id', $casinoId, PDO::PARAM_STR);
                $result->bindValue(':display_id', $displayId, PDO::PARAM_STR);
                $result->bindValue(':scene_duration', $promotion['sceneDuration'], PDO::PARAM_INT);

                $result->execute();
            }

        }

    }
}
