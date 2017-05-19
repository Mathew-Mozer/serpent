<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 11/2/2016
 * Time: 11:58 PM
 */
class MonsterCarlo
{

    public $id;
    public $active="";
    public $session;
    public $HHtype;
    public $cardList = array();
    private $conn;
    public function __construct()
    {
        $dbcon = new DbCon();
        $this->conn = $dbcon->read_database();
    }
    public function loadMonsterCarloCards($pSessionID)
    {
        $sql = 'SELECT high_hand_card8 from high_hand_records where  high_hand_session=? and high_hand_record_archive=0 and high_hand_card8!=\'CB\' and high_hand_isWinner >0  order by high_hand_record_id';
        $statement = $this->conn->prepare($sql);
        $statement->execute(array($pSessionID));
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
                array_push($this->cardList,$result['high_hand_card8']);
        }
        //$this->loadFakeCards();
    }
    public function loadFakeCards(){
        array_push($this->cardList,"AH");
        array_push($this->cardList,"2H");
        array_push($this->cardList,"3H");
        array_push($this->cardList,"4H");
        array_push($this->cardList,"5H");
        array_push($this->cardList,"6H");
        array_push($this->cardList,"7H");
        array_push($this->cardList,"8H");
        array_push($this->cardList,"9H");
        array_push($this->cardList,"10H");
        array_push($this->cardList,"JH");
        array_push($this->cardList,"QH");
        array_push($this->cardList,"KH");
        array_push($this->cardList,"AC");
        array_push($this->cardList,"2C");
        array_push($this->cardList,"3C");
        array_push($this->cardList,"4C");
        array_push($this->cardList,"5C");
        array_push($this->cardList,"6C");
        array_push($this->cardList,"7C");
        array_push($this->cardList,"8C");
        array_push($this->cardList,"9C");
        array_push($this->cardList,"10C");
        array_push($this->cardList,"JC");
        array_push($this->cardList,"QC");
        array_push($this->cardList,"KC");
        array_push($this->cardList,"AD");
        array_push($this->cardList,"2D");
        array_push($this->cardList,"3D");
        array_push($this->cardList,"4D");
        array_push($this->cardList,"5D");
        array_push($this->cardList,"6D");
        array_push($this->cardList,"7D");
        array_push($this->cardList,"8D");
        array_push($this->cardList,"9D");
        array_push($this->cardList,"10D");
        array_push($this->cardList,"JD");
        array_push($this->cardList,"QD");
        array_push($this->cardList,"KD");
        array_push($this->cardList,"AS");
        array_push($this->cardList,"2S");
        array_push($this->cardList,"3S");
        array_push($this->cardList,"4S");
        array_push($this->cardList,"5S");
        array_push($this->cardList,"6S");
        array_push($this->cardList,"7S");
        array_push($this->cardList,"8S");
        array_push($this->cardList,"9S");
        array_push($this->cardList,"10S");
        //array_push($this->cardList,"JS");
        //array_push($this->cardList,"QS");
        array_push($this->cardList,"KS");
    }
    public function findMonsterCarlo($hhid)
    {
        $dbcon = new DbCon();
        $this->conn = $dbcon->read_database();
        $mid="";
        $sql = 'SELECT * from monster_carlo_settings where monster_carlo_settings_hhid=? order by monster_carlo_settings_id DESC limit 1';
        $statementa = $this->conn->prepare($sql);
        $statementa->execute(array($hhid));
        foreach ($statementa->fetchAll(PDO::FETCH_ASSOC) as $result) {
           $mid = $result['monster_carlo_settings_promotion_id'];
        }
        return $mid;

    }

}