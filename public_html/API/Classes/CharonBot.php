<?php
require_once '../../dependencies/php/HelperFunctions.php';
require_once(getServerPath() . "dbcon.php");
include '../Classes/DisplayData.php';
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 2/9/2017
 * Time: 4:40 AM
 */
class CharonBot
{

    public $casinoName;
    public $displayData;
    public $found = false;
    public $version='';
    private $dbcon, $conn;
    function __construct($macAddress)
    {
        $this->dbcon = new dbcon();
        $this->conn = $this->dbcon->read_database();
        $sql = 'select * from display,property where display.property_id=property.property_id and display_mac_address=? limit 1';
        $statement = $this->conn->prepare($sql);
        //echo ("sceneid".$pSceneID);
        $statement->execute(array($macAddress));
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $this->displayData = new DisplayData();
            $this->displayData->DisplayName =  $result["display_name"];
            $this->displayData->casinoID = $result["property_id"];
            $this->displayData->displayID = $result["display_id"];
            $this->displayData->gcmID = $result["display_gcmid"];
            $this->displayData->MacAddress = $result["display_mac_address"];
            $this->casinoName = $result["property_name"];
            $this->found = true;

        }


    }
    public function updateCharonSettings($fieldid, $value){
        $field="";
        if (!$this->checkCharonDbEntry())
        {
            $this->createCharonDbEntry();
        }
        switch ($fieldid){
            case 0:
                $field = "charon_settings_version";
                break;
            case 1:
                $field = "charon_settings_fbid";
                break;
        }

        $sql = "update charon_settings set $field=:fval where charon_settings_display_id=:displayid";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':displayid', $this->displayData->displayID, PDO::PARAM_STR);
        $result->bindValue(':fval', $value, PDO::PARAM_STR);
        return $result->execute();
    }
    function createCharonDbEntry(){
        echo('trying:'.$this->displayData->displayID);
        $sql = "INSERT INTO  `charon_settings` (`charon_settings_display_id`) VALUES (:displayid)";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':displayid', $this->displayData->displayID, PDO::PARAM_STR);
        $result->execute();

    }
    function checkCharonDbEntry(){
        $response = false;
        $this->dbcon = new dbcon();
        $this->conn = $this->dbcon->read_database();
        $sql = 'SELECT count(*) FROM `charon_settings` where charon_settings.charon_settings_display_id=?';
        $statement = $this->conn->prepare($sql);
        $statement->execute(array($this->displayData->displayID));
        foreach ($statement->fetch(PDO::FETCH_ASSOC) as $result) {
            $response=$result[0];
        }
        return $response;
    }


}