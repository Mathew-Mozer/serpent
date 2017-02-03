<?php
include 'SkinData.php';
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 11/18/2016
 * Time: 12:17 AM
 */
class Skin
{
//Skin
    public $skinID=0;
    public $SceneID;
    public $skinData;
    public $skinName;



    //SELECT skin.skin_name,skin_tag.skin_tag_id,skin_tag.skin_tag_name,skin_tag.skin_tag_sceneid,skin_tag_data.skin_tag_data_x,skin_tag_data.skin_tag_data_y,skin_tag_data.skin_tag_data_forecolor,skin_tag_data.skin_tag_data_backcolor,skin_tag_data.skin_tag_data_textcolor,skin_tag_data.skin_tag_data_width,skin_tag_data.skin_tag_data_height,skin_tag_data.skin_tag_data_backsprite,skin_tag_data.skin_tag_data_foresprite,skin_tag_data.skin_tag_data_bordercolor FROM `skin`,skin_tag_data,skin_tag where skin_tag.skin_tag_id=skin_tag_data.skin_tag_data_tagid and skin.skin_id=2 and skin_tag.skin_tag_sceneid=4
    function __construct($sceneid, $pskinID,$propertyId)
    {

        $this->skinID=$pskinID;
        $this->SceneID=$sceneid;

        $dbcon = new DbCon();
        $conn = $dbcon->read_database();
        $sql = 'SELECT skin.skin_name,skin_tag.skin_tag_id,skin_tag.skin_tag_name,skin_tag.skin_tag_sceneid,skin_tag_data.skin_tag_data_x,skin_tag_data.skin_tag_data_y,skin_tag_data.skin_tag_data_forecolor,skin_tag_data.skin_tag_data_backcolor,skin_tag_data.skin_tag_data_textcolor,skin_tag_data.skin_tag_data_width,skin_tag_data.skin_tag_data_height,skin_tag_data.skin_tag_data_backsprite,skin_tag_data.skin_tag_data_foresprite,skin_tag_data.skin_tag_data_bordercolor FROM `skin`,skin_tag_data,skin_tag where skin_tag_data_skinid=skin.skin_id and skin_tag.skin_tag_id=skin_tag_data.skin_tag_data_tagid and skin.skin_id=? and skin_tag.skin_tag_sceneid=?';
        $statement = $conn->prepare($sql);
        $statement->execute(array($pskinID,$sceneid));
        $tmpArray = array();

        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $this->skinName=$result['skin_name'];
            $tmpdata = new SkinData();
            $tmpdata->id=$result['skin_tag_id'];
            $tmpdata->tagname=$result['skin_tag_name'];
            $tmpdata->xCoord=$result['skin_tag_data_x'];
            $tmpdata->yCoord=$result['skin_tag_data_y'];
            $tmpdata->forecolor=$result['skin_tag_data_forecolor'];
            $tmpdata->backcolor=$result['skin_tag_data_backcolor'];
            $tmpdata->textcolor= $result['skin_tag_data_textcolor'];
            $tmpdata->width=$result['skin_tag_data_width'];
            $tmpdata->height=$result['skin_tag_data_height'];
            $tmpdata->backsprite=$result['skin_tag_data_backsprite'];
            $tmpdata->foresprite=$result['skin_tag_data_foresprite'];
            $tmpdata->bordercolor = $result['skin_tag_data_bordercolor'];
            array_push($tmpArray,$tmpdata);
        }
        //echo('Skin info- sceneid:'.$sceneid." skinid:".$pskinID." propertyid:".$propertyId."/n");
        $sql = 'SELECT * FROM `skin_logo` where skin_logo.skin_logo_propertyid=? and skin_logo_skinid=? and skin_logo_sceneid=? limit 1';
        $statement = $conn->prepare($sql);
        $statement->execute(array($propertyId,$pskinID,$sceneid));
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {
            $tmpdata = new SkinData();
            $tmpdata->tagname="Logo";
            $tmpdata->id=$result['skin_logo_id'];
            $tmpdata->xCoord=$result['skin_logo_x'];
            $tmpdata->backsprite=$result['skin_logo_logoname'];
            $tmpdata->yCoord=$result['skin_logo_y'];
            $tmpdata->width=$result['skin_logo_width'];
            $tmpdata->height=$result['skin_logo_height'];
            array_push($tmpArray,$tmpdata);
        }
        $this->skinData=$tmpArray;
    }
}