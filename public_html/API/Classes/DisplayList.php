<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 8/9/2017
 * Time: 5:47 AM
 */
class DisplayList
{
    public function __construct()
    {
        $dbcon = new DbCon();
        $this->conn = $dbcon->read_database();
    }
    public function loadDataList($pSessionID)
    {
        //echo($pSessionID);
        $sql = "SELECT listdisplaylist_id as id, listdisplaylist_name as Name, listdisplaylist_data1 as Other FROM listdisplay_list WHERE listdisplay_list_promoid=:id;";
        $result = $this->conn->prepare($sql);
        $result->bindValue(':id', $pSessionID, PDO::PARAM_STR);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }
}