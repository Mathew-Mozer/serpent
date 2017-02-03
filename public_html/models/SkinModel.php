<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 1/23/2017
 * Time: 2:00 AM
 */
class SkinModel
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    //This retrives all promotions that are stored.
    public function SaveSkin($post)
    {
        $sql = "";
        $result = $this->db->prepare($sql);
        $result->execute();
        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }
}