<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 1/12/2017
 * Time: 4:49 PM
 */
date_default_timezone_set('America/Los_Angeles');
class TimeTarget
{
    public $id;
    public $seed;
    public $startTime;
    public $endTime;
    public $min;
    public $add;
    public $cards;
    public $promoid;
    public $MaxPayout;
    public $defhour;
    public $defmin;
    public $valoption;
    public $otherPromoID;
    public $useMult;
    public $multiplier;
    private $cardlist = array("AH","2H","3H","4H","5H","6H","7H","8H","9H","10H","JH","QH","KH","AC","2C","3C","4C","5C","6C","7C","8C","9C","10C","JC","QC","KC","AD","2D","3D","4D","5D","6D","7D","8D","9D","10D","JD","QD","KD","AS","2S","3S","4S","5S","6S","7S","8S","9S","10S","JS","QS","KS");
    function updateCard(){
        $dbcon = new DbCon();
        $this->conn = $dbcon->update_database();
        $sql="update time_target set time_target_cards=:tcards, time_target_lastcardchange=:dttoset where time_target_id=:tid;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':tcards', $this->cardlist[rand(0,51)], PDO::PARAM_STR);
        $result->bindValue(':tid', $this->id, PDO::PARAM_STR);
        $result->bindValue(':dttoset', date("Y-m-d")." ".$this->defhour.":".$this->defmin.":00", PDO::PARAM_STR);
        $result->execute();
        //echo ("updating card:".$this->id);
    }
}