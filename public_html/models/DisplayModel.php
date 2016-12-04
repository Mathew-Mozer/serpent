<?php

/**
 * Class DisplayModel
 * This class generates a display object used by properties
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

    /**
     * DisplayModel constructor.
     * @param $values
     */
    public function __construct($values)
    {
        $this->createDisplayWithValuesSet($values);
    }

    /**
     * This creates a display with the value set
     * @param $fieldArray
     */
    private function createDisplayWithValuesSet($fieldArray){
        $this->setId($fieldArray['display_id']);
        $this->setName($fieldArray['display_name']);
        $this->setPropertyId($fieldArray['property_id']);
        $this->setSerial($fieldArray['display_serial']);
        $this->setMacAddress($fieldArray['display_mac_address']);
        $this->setDisplayLocation($fieldArray['display_location']);
    }

    /**
     * This sets the connection
     * @param mixed $conn
     */
    public function setConn($conn)
    {
        $this->conn = $conn;
    }
    /**
     * This sets the ID
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * This sets the name
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * This sets the propertyID
     * @param mixed $propertyId
     */
    public function setPropertyId($propertyId)
    {
        $this->propertyId = $propertyId;
    }
    /**
     * This sets the serial
     * @param mixed $serial
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;
    }
    /**
     * This sets the mac address
     * @param mixed $macAddress
     */
    public function setMacAddress($macAddress)
    {
        $this->macAddress = $macAddress;
    }
    /**
     * This gets the connection
     * @return PDO|string
     */
    public function getConn()
    {
        return $this->conn;
    }
    /**
     * This gets the id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * This gets the name
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Get property ID
     * @return mixed
     */
    public function getPropertyId()
    {
        return $this->propertyId;
    }
    /**
     * Get serial
     * @return mixed
     */
    public function getSerial()
    {
        return $this->serial;
    }
    /**
     * Get mac address
     * @return mixed
     */
    public function getMacAddress()
    {
        return $this->macAddress;
    }
    /**
     * Get promotions
     * @return mixed
     */
    public function getPromotions()
    {
        return $this->promotions;
    }
    /**
     * Set promotions
     * @param mixed $promotions
     */
    public function setPromotions($promotions)
    {
        $this->promotions = $promotions;
    }

    /**
     * Get display location
     * @param $displayLocation
     */
    public function setDisplayLocation($displayLocation)
    {
        $this->displayLocation = $displayLocation;
    }

    /**
     * Get display location
     * @return mixed
     */
    public function getDisplayLocation(){
      return $this->displayLocation;
    }
}
