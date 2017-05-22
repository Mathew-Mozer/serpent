<?php

/**
 * Class HighHandModel
 * This file contains the SQL statements required to define
 * the high hand data
 */

class HighHandModel{

    private $conn;

    /**
     * HighHandModel constructor.
     * @param $conn
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Add high hand
     * @param $values
     */
    public function add($values) {
        $sql = "INSERT INTO high_hand (promotion_id, title_message, use_joker, high_hand_attachmc,
            horn_timer, payout_value, session_timer, multiple_hands, high_hand_custom_payout, high_hand_isodd,high_hand_cardcount,high_hand_locktotime,high_hand_handcount)
            VALUES (:promotionId,:title_message,:use_joker,:high_hand_gold,:horn_timer,:payout_value,
                    :session_timer,:multiple_hands, :custom_payout, :is_odd,:cardcount,:locktotime,:high_hand_handcount);";

        $result = $this->conn->prepare($sql);
        $result->bindValue(':promotionId', $values['promotionId'], PDO::PARAM_STR);
        $result->bindValue(':title_message', $values['title_message'], PDO::PARAM_STR);
        $result->bindValue(':use_joker', $values['use_joker'], PDO::PARAM_STR);
        $result->bindValue(':high_hand_gold', $values['high_hand_attachmc'], PDO::PARAM_STR);
        $result->bindValue(':horn_timer', $values['horn_timer'], PDO::PARAM_STR);
        $result->bindValue(':payout_value', $values['payout_value'], PDO::PARAM_STR);
        $result->bindValue(':session_timer', $values['session_timer'], PDO::PARAM_STR);
        $result->bindValue(':multiple_hands', $values['multiple_hands'], PDO::PARAM_INT);
        $result->bindValue(':custom_payout', $values['high_hand_custom_payout'], PDO::PARAM_STR);
        $result->bindValue(':is_odd', $values['high_hand_isodd'], PDO::PARAM_STR);
        $result->bindValue(':cardcount', $values['high_hand_cardcount'], PDO::PARAM_STR);
        $result->bindValue(':locktotime', $values['high_hand_locktotime'], PDO::PARAM_STR);
        $result->bindValue(':high_hand_handcount', $values['high_hand_handcount'], PDO::PARAM_STR);
        $result->execute();
    }

    /**
     * Updates high hand
     * @param $values
     */
    public function update($values){
      $this->add($values);
    }

    /**
     * Gets high hand
     * @param $id
     * @return mixed
     */
    public function get($id){

        $sql = "SELECT * FROM high_hand WHERE promotion_id=:id ORDER BY id DESC LIMIT 1;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();

        $promoResult = $result->fetch(PDO::FETCH_ASSOC);

        return $promoResult;
    }
    public function getCurrentHighHands($id){

        $sql = "SELECT DISTINCT * FROM promotion,promotion_property WHERE promotion.promotion_type_id=1 and promotion_property.property_id=:id and promotion_property.promotion_id=promotion.promotion_id ORDER BY promotion.promotion_id DESC;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }
    /**
     * Insert a new high hand into the database
     * @param $promotionID
     * @param $playerName
     * @param $card1
     * @param $card2
     * @param $card3
     * @param $card4
     * @param $card5
     * @param $card6
     * @param $card7
     * @param $card8
     */
    public function updateHighHand($promotionID, $playerName, $cards){
        var_dump($cards);

        $sql ='INSERT INTO high_hand_records(
                high_hand_session,
                high_hand_name,
                high_hand_card1,
                high_hand_card2,
                high_hand_card3,
                high_hand_card4,
                high_hand_card5,
                high_hand_card6,
                high_hand_card7,
                high_hand_card8,
                high_hand_record_rank
              )

              VALUES(:promotionID, :playerName, :card1, :card2, :card3, :card4, :card5, :card6, :card7, :card8,:hhrank);
        ';
        $curHand = $cards[0][0].$cards[1][0].$cards[2][0].$cards[3][0].$cards[4][0];
        $result = $this->conn->prepare($sql);
        $result->bindValue(':promotionID', $promotionID, PDO::PARAM_INT);
        $result->bindValue(':playerName', $playerName, PDO::PARAM_STR);
        $result->bindValue(':card1', $cards[0], PDO::PARAM_STR);
        $result->bindValue(':card2', $cards[1], PDO::PARAM_STR);
        $result->bindValue(':card3', $cards[2], PDO::PARAM_STR);
        $result->bindValue(':card4', $cards[3], PDO::PARAM_STR);
        $result->bindValue(':card5', $cards[4], PDO::PARAM_STR);
        $result->bindValue(':card6', $cards[5], PDO::PARAM_STR);
        $result->bindValue(':card7', $cards[6], PDO::PARAM_STR);
        $result->bindValue(':card8', $cards[7], PDO::PARAM_STR);
        $result->bindValue(':card8', $cards[7], PDO::PARAM_STR);
        $result->bindValue(':hhrank', $this->getRank($curHand), PDO::PARAM_STR);



        $result->execute();
}

    /**
     * This will be refactored for all promotions
     * @return mixed
     */
    function getRank($hand){
        $hands = array("22233", "22244", "22255", "22266", "22277", "22288", "22299", "22211", "222JJ", "222QQ", "222KK", "222AA", "33322", "33344", "33355", "33366", "33377", "33388", "33399", "33311", "333JJ", "333QQ", "333KK", "333AA", "44422", "44433", "44455", "44466", "44477", "44488", "44499", "44411", "444JJ", "444QQ", "444KK", "444AA", "55522", "55533", "55544", "55566", "55577", "55588", "55599", "55511", "555JJ", "555QQ", "555KK", "555AA", "66622", "66633", "66644", "66655", "66677", "66688", "66699", "66611", "666JJ", "666QQ", "666KK", "666AA", "77722", "77733", "77744", "77755", "77766", "77788", "77799", "77711", "777JJ", "777QQ", "777KK", "777AA", "88822", "88833", "88844", "88855", "88866", "88877", "88899", "88811", "888JJ", "888QQ", "888KK", "888AA", "99922", "99933", "99944", "99955", "99966", "99977", "99988", "99911", "999JJ", "999QQ", "999KK", "999AA", "11122", "11133", "11144", "11155", "11166", "11177", "11188", "11199", "111JJ", "111QQ", "111KK", "111AA", "JJJ22", "JJJ33", "JJJ44", "JJJ55", "JJJ66", "JJJ77", "JJJ88", "JJJ99", "JJJ11", "JJJQQ", "JJJKK", "JJJAA", "QQQ22", "QQQ33", "QQQ44", "QQQ55", "QQQ66", "QQQ77", "QQQ88", "QQQ99", "QQQ11", "QQQJJ", "QQQKK", "QQQAA", "KKK22", "KKK33", "KKK44", "KKK55", "KKK66", "KKK77", "KKK88", "KKK99", "KKK11", "KKKJJ", "KKKQQ", "KKKAA", "AAA22", "AAA33", "AAA44", "AAA55", "AAA66", "AAA77", "AAA88", "AAA99", "AAA11", "AAAJJ", "AAAQQ", "AAAKK", "22223", "22223", "22224", "22225", "22226", "22227", "22228", "22229", "22221", "2222J", "2222Q", "2222K", "2222A", "33332", "33334", "33335", "33336", "33337", "33338", "33339", "33331", "3333J", "3333Q", "3333K", "3333A", "44442", "44443", "44445", "44446", "44447", "44448", "44449", "44441", "4444J", "4444Q", "4444K", "4444A", "55552", "55553", "55554", "55556", "55557", "55558", "55559", "55551", "5555J", "5555Q", "5555K", "5555A", "66662", "66663", "66664", "66665", "66667", "66668", "66669", "66661", "6666J", "6666Q", "6666K", "6666A", "77772", "77773", "77774", "77775", "77776", "77778", "77779", "77771", "7777J", "7777Q", "7777K", "7777A", "88882", "88883", "88884", "88885", "88886", "88887", "88889", "88881", "8888J", "8888Q", "8888K", "8888A", "99992", "99993", "99994", "99995", "99996", "99997", "99998", "99991", "9999J", "9999Q", "9999K", "9999A", "11112", "11113", "11114", "11115", "11116", "11117", "11118", "11119", "1111J", "1111Q", "1111K", "1111A", "JJJJ2", "JJJJ3", "JJJJ4", "JJJJ5", "JJJJ6", "JJJJ7", "JJJJ8", "JJJJ9", "JJJJ1", "JJJJQ", "JJJJK", "JJJJA", "QQQQ2", "QQQQ3", "QQQQ4", "QQQQ5", "QQQQ6", "QQQQ7", "QQQQ8", "QQQQ9", "QQQQ1", "QQQQJ", "QQQQK", "QQQQA", "KKKK2", "KKKK3", "KKKK4", "KKKK5", "KKKK6", "KKKK7", "KKKK8", "KKKK9", "KKKK1", "KKKKJ", "KKKKQ", "KKKKA", "AAAA2", "AAAA3", "AAAA4", "AAAA5", "AAAA6", "AAAA7", "AAAA8", "AAAA9", "AAAA1", "AAAAJ", "AAAAQ", "AAAAK", "65432", "76543", "87654", "98765", "19876", "J1987", "QJ198", "KQJ19", "A2345", "A5432", "AKQJ1", "AAAAA");
        $rank = array_search($hand,$hands);
//        echo"Hand: ".$hand."<hr>";
        if($rank<=0){
            $sort = str_split($hand);
            sort($sort);
            $sort=implode($sort);
            $rank = array_search($sort,$hands);
  //              echo"Sorted Hand: ".$sort." - rank:".$rank."<hr>";
        }
        if($rank<=0){
            $sort = str_split($hand);
            rsort($sort);
            $sort=implode($sort);
            $rank = array_search($sort,$hands);
    //              echo"Sorted Hand: ".$sort." - rank:".$rank."<hr>";
        }
    //echo 'Final Rank: '.$rank.'<hr>';
        return $rank;
    }
    public function getTemplate(){

        $sql = "SELECT * FROM high_hand WHERE template=1";
        $result = $this->conn->prepare($sql);
        $result->execute();

        $template = $result->fetch(PDO::FETCH_ASSOC);
        return $template;
    }

    /**
     * This retrieves all hands assigned to the promotion ID
     * @param $id
     * @return array
     */
    public function getAllHands($id){
       $sql = "SELECT * FROM high_hand_records
                WHERE high_hand_records.high_hand_session = :id and high_hand_record_archive='0' order by high_hand_record_id DESC ";
        $result = $this->conn->prepare($sql);

        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $response = $result->fetchAll(PDO::FETCH_ASSOC);

        return $response;

    }

    public function updateCardSet($value){
        $sql = "UPDATE high_hand_records SET high_hand_isWinner=:isWinner, high_hand_payout=:payout WHERE high_hand_record_id=:handId";

        $result = $this->conn->prepare($sql);

        $result->bindValue(':isWinner', $value['isWinner'], PDO::PARAM_STR);
        $result->bindValue(':payout', $value['payout'], PDO::PARAM_STR);
        $result->bindValue(':handId', $value['handId'], PDO::PARAM_STR);

        $result->execute();
    }
    public function archiveHands($value){
        $sql = "UPDATE high_hand_records SET high_hand_record_archive='1' WHERE high_hand_session=:promoid";

        $result = $this->conn->prepare($sql);
        $result->bindValue(':promoid', $value['promotionId'], PDO::PARAM_STR);
        $result->execute();
    }
    public function deleteHand($value){
        $sql = "UPDATE high_hand_records SET high_hand_record_archive='1' WHERE high_hand_record_id=:handId";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':handId', $value['handId'], PDO::PARAM_STR);
        $result->execute();
    }

}
