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

    private function createDisplayWithValuesSet($fieldArray){
        $this->setId($fieldArray['property_id']);
        $this->setName($fieldArray['property_name']);
        $this->setPropertyId($fieldArray['property_id']);
        $this->setSerial($fieldArray['property_serial']);
        $this->setMacAddress($fieldArray['property_mac_address']);
        $this->setDisplayLocation($fieldArray['property_display_location']);
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
