<?php
/**
 * Model to control the box view
 *
 */

class BoxModel
{
    private $conn;
    private $id;
    private $name;
    private $casinoId;
    private $serial;
    private $macAddress;
    private $promotions = array();
    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }
    public function getAllBoxesWithCasinoId($casinoId){
        $getBoxes = "SELECT * FROM box,promotion_casino WHERE promotion_casino.box_id = box.id AND box.casino_id="
            . $casinoId . " ORDER BY promotion_casino.box_id;";
        $boxStatement = $this->conn->prepare($getBoxes);
        $boxStatement->execute();
        $result = $boxStatement->fetchAll(PDO::FETCH_ASSOC);
        $boxes = array();
        $box = new BoxModel($this->conn);
        $count = 0;
        $temp = array();
        foreach ($result as $array){
            if($box->getName() != $array['name']){
                if($count != 0){
                    array_push($boxes,$box);
                    $temp = array();
                }
                $box = $box->createBoxWithValuesSet($array);
                $count = 1;
            }
            array_push($temp,$array['promotion_id']);
            $box->setPromotions($temp);
        }
        if($box->getName() != null) {
            array_push($boxes, $box);
        }
        return $boxes;
    }
    public function getBoxWithId($id) {
        $sql = "SELECT * FROM box WHERE id=" . $id;
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->createBoxWithValuesSet($result);
    }
    private function createBoxWithValuesSet($fieldArray){
        $box = new BoxModel($this->conn);
        $box->setId($fieldArray['id']);
        $box->setName($fieldArray['name']);
        $box->setCasinoId($fieldArray['casino_id']);
        $box->setSerial($fieldArray['serial']);
        $box->setMacAddress($fieldArray['mac_address']);
        return $box;
    }
    private function addPromotionToBox($promotion){
        array_push($this->promotions,$promotion);
    }
    /**
     * @param mixed $conn
     */
    public function setConn($conn)
    {
        $this->conn = $conn;
    }
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * @param mixed $casinoId
     */
    public function setCasinoId($casinoId)
    {
        $this->casinoId = $casinoId;
    }
    /**
     * @param mixed $serial
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;
    }
    /**
     * @param mixed $macAddress
     */
    public function setMacAddress($macAddress)
    {
        $this->macAddress = $macAddress;
    }
    /**
     * @return PDO|string
     */
    public function getConn()
    {
        return $this->conn;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @return mixed
     */
    public function getCasinoId()
    {
        return $this->casinoId;
    }
    /**
     * @return mixed
     */
    public function getSerial()
    {
        return $this->serial;
    }
    /**
     * @return mixed
     */
    public function getMacAddress()
    {
        return $this->macAddress;
    }
    /**
     * @return mixed
     */
    public function getPromotions()
    {
        return $this->promotions;
    }
    /**
     * @param mixed $promotions
     */
    public function setPromotions($promotions)
    {
        $this->promotions = $promotions;
    }
}