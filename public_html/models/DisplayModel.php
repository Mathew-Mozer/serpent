<?php
/**
 * Model to control the display view
 *
 */

class DisplayModel
{
    private $id;
    private $name;
    private $propertyId;
    private $serial;
    private $macAddress;
    private $promotions = array();
    private $displayLocation;

    public function __construct($values)
    {
        $this->createDisplayWithValuesSet($values);
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

    private function createDisplayWithValuesSet($fieldArray){
        $this->setId($fieldArray['display_id']);
        $this->setName($fieldArray['display_name']);
        $this->setPropertyId($fieldArray['property_id']);
        $this->setSerial($fieldArray['display_serial']);
        $this->setMacAddress($fieldArray['display_mac_address']);
        $this->setDisplayLocation($fieldArray['display_location']);
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
     * @param mixed $propertyId
     */
    public function setPropertyId($propertyId)
    {
        $this->propertyId = $propertyId;
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
    public function getPropertyId()
    {
        return $this->propertyId;
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

    public function setDisplayLocation($displayLocation)
    {
        $this->displayLocation = $displayLocation;
    }

    public function getDisplayLocation(){
      return $this->displayLocation;
    }
}
