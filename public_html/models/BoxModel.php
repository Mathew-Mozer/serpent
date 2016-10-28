<?php
require('../../dbcon.php');
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

    public function __construct()
    {
        if(is_null($this->conn)) {

            $dbcon = new DbCon();
            $this->conn = $dbcon->read_database();
        }
    }

    public function getAllBoxesWithCasionID($casionID){
        //sql statement to get list of boxes with casinoID
    }

    public function getBoxWithId($id) {
        $sql = "SELECT * FROM box WHERE id=" . $id;
        $statement = $this->conn->prepare($sql);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->createBoxWithValuesSet($result);
    }

    private function createBoxWithValuesSet($fieldArray){
        $box = new BoxModel();
        $box->id = $fieldArray['id'];
        $box->name = $fieldArray['name'];
        $box->casinoId = $fieldArray['casino_id'];
        $box->serial = $fieldArray['serial'];
        $box->macAddress = $fieldArray['mac_address'];
        return $box;
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


}