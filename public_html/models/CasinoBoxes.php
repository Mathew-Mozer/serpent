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
        $getPromotions = "SELECT * FROM promotion_casino WHERE promotion_casino.box_id =". $box;
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
}