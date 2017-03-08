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
    private $lockedPromoId;
    private $monitorState;
    private $apiId;
    private $appVersion;
    private $height;
    private $width;
    private $fitw;
    private $fith;
    private $flip;

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
    private function createDisplayWithValuesSet($fieldArray)
    {
        $this->setId($fieldArray['display_id']);
        $this->setName($fieldArray['display_name']);
        $this->setPropertyId($fieldArray['property_id']);
        $this->setSerial($fieldArray['display_serial']);
        $this->setMacAddress($fieldArray['display_mac_address']);
        $this->setDisplayLocation($fieldArray['display_location']);
        $this->setLockedPromo($fieldArray['display_lockedpromo']);
        $this->setMonitorState($fieldArray['display_monitor']);
        $this->setApiId($fieldArray['display_api_id']);
        $this->setAppVersion($fieldArray['display_appversion']);
        $this->setHeight($fieldArray['display_height']);
        $this->setWidth($fieldArray['display_width']);
        $this->setFitW($fieldArray['display_fitw']);
        $this->setFitH($fieldArray['display_fith']);
        $this->setFlip($fieldArray['display_flip']);
        $this->setDebug($fieldArray['display_debug']);
//var_dump($fieldArray);
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
    public function setApiId($val)
    {
        $this->apiId = $val;
    }

    public function setAppVersion($val)
    {
        $this->appVersion = $val;
    }

    public function setHeight($val)
    {
        $this->height = $val;
    }

    public function setWidth($val)
    {
        $this->width = $val;
    }

    public function setFitW($val)
    {
        $this->fitw = $val;
    }

    public function setFitH($val)
    {
        $this->fith = $val;
    }
    public function setFlip($val)
    {
        $this->flip = $val;
    }
    public function setDebug($val)
    {
        $this->debug = $val;
    }
    public function setLockedPromo($promoid)
    {
        $this->lockedPromoId = $promoid;
    }

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

    public function getApiId()
    {
        return $this->apiId;
    }

    public function getAppVersion()
    {
        return $this->appVersion;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getFitW()
    {
        return $this->fitw;
    }

    public function getFitH()
    {
        return $this->fith;
    }
    public function getFlip()
    {
        return $this->flip;
    }
    public function getDebug()
    {
        return $this->debug;
    }
    public function getLockedPromoId()
    {
        return $this->lockedPromoId;
    }

    public function getMonitorState()
    {
        return $this->monitorState;
    }

    public function setMonitorState($state)
    {
        $this->monitorState = $state;
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
    public function getDisplayLocation()
    {
        return $this->displayLocation;
    }
}
