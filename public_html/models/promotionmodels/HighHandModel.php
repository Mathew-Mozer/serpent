<?php


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

    public function addHighHand($promotionId, $titleMessage, $useJoker,
                                $highHandGold, $hornTimer, $payoutValues, $sessionTimer, $multipleHands, $template) {
        $sql = "";
        if($template == 'true') {
            $oldTemplate = $this->getTemplate();
            if($oldTemplate){
                $id = $oldTemplate['id'];
                $sql = 'UPDATE high_hand SET promotion_id='.$promotionId.",title_message='".$titleMessage.
                    "',use_joker=".$useJoker.',high_hand_gold='.$highHandGold.',horn_timer='.
                    $hornTimer.',payout_value='.$payoutValues.',session_timer='.$sessionTimer.',multiple_hands='.$multipleHands.',template='.$template.'
                    WHERE id ='.$id;

            }
        } if($sql == ''){
            $sql = 'INSERT INTO high_hand (promotion_id, title_message, use_joker, high_hand_gold, 
            horn_timer, payout_value, session_timer, multiple_hands, template)
            VALUES ('.$promotionId.",'".$titleMessage."',".$useJoker.','.$highHandGold.','.
                $hornTimer.','.$payoutValues.','.$sessionTimer.','.$multipleHands.','.$template.')';
        }
        $result = $this->conn->prepare($sql);
        $result->execute();
    }

    public function getHighHand($id){

        $sql = "SELECT
               *
             FROM
               high_hand
             WHERE
               promotion_id=:id;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();

        $promoResult = $result->fetch(PDO::FETCH_ASSOC);

        return $promoResult;
    }

    public function getTemplate(){

        $sql = "SELECT * FROM high_hand WHERE template=1";
        $result = $this->conn->prepare($sql);
        $result->execute();

        $template = $result->fetch(PDO::FETCH_ASSOC);
        return $template;
    }


}