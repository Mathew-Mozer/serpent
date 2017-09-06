<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 8/9/2017
 * Time: 5:47 AM
 */
class mmcard
{
    public $Card;
    public $Value = 0;
    public $TimeStampHit = "";
    function __construct($card,$value,$timehit) {
        $this->Card=$card;
        $this->Value=$value;
        $this->TimeStampHit=$timehit;
    }

}
class MatchMadness
{
    public $cardList = array();
    public function __construct()
    {
        $dbcon = new DbCon();
        $this->conn = $dbcon->read_database();
    }
    public function loadMMCards($pSessionID)
    {
        $sql = 'SELECT * from multi_madness_cards where multi_madness_cards_promoid=? order by multi_madness_cards_id';
        $statement = $this->conn->prepare($sql);
        $statement->execute(array($pSessionID));
        //echo('Found: This:'.$pSessionID);
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {

            array_push($this->cardList, new mmcard($result['multi_madness_cards_card'],$result['multi_madness_cards_value'],$result['multi_madness_cards_hit']));
        }
        //echo sizeof($this->mmCardList);
        //return $this->mmCardList;
    }
}