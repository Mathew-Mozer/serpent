<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 1/24/2018
 * Time: 3:26 AM
 */
class ListDisplayModel
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Add high hand
     * @param $values
     */
    public function add($values) {
        $sql = "INSERT INTO listdisplay (listdisplay_promoid,listdisplay_text1,listdisplay_text1title,listdisplay_slideshowid)
            VALUES (:promotionId,:text1,:text1title,:slideshowid);";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':promotionId', $values['promotionId'], PDO::PARAM_STR);
        $result->bindValue(':text1title', $values['listdisplay_text1title'], PDO::PARAM_STR);
        $result->bindValue(':text1', $values['listdisplay_text1'], PDO::PARAM_STR);
        $result->bindValue(':slideshowid', $values['listdisplay_slideshowid'], PDO::PARAM_STR);
        $result->execute();
    }

    public function update($values){
        $this->add($values);
    }

    public function get($id){
        //echo($id);
        $sql = "SELECT * FROM listdisplay WHERE listdisplay_promoid=:id ORDER BY listdisplay_id DESC LIMIT 1;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();

        $promoResult = $result->fetch(PDO::FETCH_ASSOC);

        return $promoResult;
    }
    public function getList($post){
        $sql = "SELECT listdisplaylist_id as id, listdisplaylist_name as Name, listdisplaylist_data1 as Other FROM listdisplay_list WHERE listdisplay_list_promoid=:id;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':id', $post["promotionId"], PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }
    public function deleteListItem($post){
        $sql = "delete FROM listdisplay_list WHERE listdisplaylist_id=:id and listdisplay_list_promoid=:promoid;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':id', $post["entryID"], PDO::PARAM_STR);
        $result->bindValue(':promoid', $post["promotionId"], PDO::PARAM_STR);
        $promoResult = $result->execute();
        return $promoResult;
    }
    public function addListItem($values) {
        $sql = "INSERT INTO listdisplay_list (listdisplay_list_promoid,listdisplaylist_name,listdisplaylist_data1)
            VALUES (:promotionId,:nme,:data1);";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':promotionId', $values['promotionId'], PDO::PARAM_STR);
        $result->bindValue(':nme', $values['name'], PDO::PARAM_STR);
        $result->bindValue(':data1', $values['data1'], PDO::PARAM_STR);
        $result->execute();
    }

}