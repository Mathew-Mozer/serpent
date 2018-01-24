<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 1/20/2017
 * Time: 8:27 AM
 */
include 'PictureData.php';
class PictureViewer
{

public $ID;
Public $session;
public $type;
public $picturelist= array();

    public function loadPictureData($pSessionID)
    {
        global $conn;
        $dbcon = new DbCon();
        $conn = $dbcon->read_database();
        $sql = 'SELECT * from picview_pictures where picview_pictures_promoid=? order by picview_pictures_order ASC ';
        $statement = $conn->prepare($sql);
        $statement->execute(array($pSessionID));
        //echo("found something".$pSessionID);
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $result) {

            $pd = new PictureData();
            $pd->id = $result['picview_pictures_id'];
            $pd->filename = "http://".$_SERVER['HTTP_HOST']."/clientpictures/uploads/".$result['picview_pictures_promoid']."/".$result['picview_pictures_filename'];
            $pd->duration = $result['picview_pictures_duration'];
            $pd->order = $result['picview_pictures_order'];
                array_push($this->picturelist,$pd);
        }
    }
}

