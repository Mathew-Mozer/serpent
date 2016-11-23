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

    public function add($values) {

      $sql = "";
      if($template == 'true') {
          $oldTemplate = $this->getTemplate();
          if($oldTemplate){
              $id = $oldTemplate['id'];
              $sql = 'UPDATE high_hand SET promotion_id=:promotionId,title_message=:title_message
                  ,use_joker=:use_joker,high_hand_gold=:high_hand_gold,horn_timer=:horn_timer,payout_value=:payout_value,session_timer=:session_timer,multiple_hands=:multiple_hands,template=:template
                  WHERE id ='.$id;

          }
      } if($sql == ''){

        $sql = "INSERT INTO high_hand (promotion_id, title_message, use_joker, high_hand_gold,
            horn_timer, payout_value, session_timer, multiple_hands, template)
            VALUES (:promotionId,:title_message,:use_joker,:high_hand_gold,:horn_timer,:payout_value,:session_timer,:multiple_hands, :template);";
          }
        $result = $this->conn->prepare($sql);
        $result->bindValue(':promotionId', $values['promotionId'], PDO::PARAM_STR);
        $result->bindValue(':title_message', $values['title_message'], PDO::PARAM_STR);
        $result->bindValue(':use_joker', $values['use_joker'], PDO::PARAM_STR);
        $result->bindValue(':high_hand_gold', $values['high_hand_gold'], PDO::PARAM_STR);
        $result->bindValue(':horn_timer', $values['horn_timer'], PDO::PARAM_STR);
        $result->bindValue(':payout_value', $values['payout_value'], PDO::PARAM_STR);
        $result->bindValue(':session_timer', $values['session_timer'], PDO::PARAM_STR);
        $result->bindValue(':multiple_hands', $values['multiple_hands'], PDO::PARAM_STR);
        $result->bindValue(':template', $values['templete'], PDO::PARAM_STR);
        $result->execute();
    }

    public function update($values){
      $this->add($values);
    }

    public function get($id){

        $sql = "SELECT
               *
             FROM
               high_hand
             WHERE
               promotion_id=:id
               ORDER BY
               created DESC;";
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
