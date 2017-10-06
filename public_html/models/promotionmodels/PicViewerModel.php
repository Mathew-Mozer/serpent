<?php

/**
 * Class KickForCashModel
 * This file contains the SQL statements required to define
 * the kick for cash data
 */
class PicViewerModel
{

    protected $db;

    /**
     * KickForCashModel constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;

    }

    /**
     * Add new  data
     * @param $values
     */
    public function add($values)
    {
        $sql = "INSERT INTO picview_settings (picview_settings_promoid, picview_settings_type)
                                 VALUES (:promotion_id,:pictype);";
        $result = $this->db->prepare($sql);
        $result->bindValue(':promotion_id', $values['promotionId'], PDO::PARAM_STR);
        $result->bindValue(':pictype', 0, PDO::PARAM_STR);
        $result->execute();
        return $result;
    }

    public function update($values)
    {
        $this->add($values);
    }

    /**
     * Get kicked for cash
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        $sql = "SELECT
               *
             FROM
               picview_settings
             WHERE
               picview_settings_promoid=:id
             ORDER BY
              picview_settings_id DESC
               LIMIT 1;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();

        $promoResult = $result->fetch(PDO::FETCH_ASSOC);
        return $promoResult;
    }


    public function AddPictureToDatabase($values)
    {
        $sql = "INSERT INTO picview_pictures (picview_pictures_promoid, picview_pictures_filename)
                                 VALUES (:promotion_id,:picname);";
        $result = $this->db->prepare($sql);
        $result->bindValue(':promotion_id', $values['promoid'], PDO::PARAM_STR);
        $result->bindValue(':picname', $values['picview_pictures_filename'], PDO::PARAM_STR);
        $result->execute();
        return $result;
    }
    public function deletePictureFromDatabase($values)
    {

        $sql = "delete from picview_pictures where picview_pictures_id=:picid limit 1;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':picid', $values['pictureid'], PDO::PARAM_STR);
        $result->execute();
        $target_dir = "../../clientpictures/uploads/".$_POST['promotionId']."/";
        unlink($target_dir.$values["picview_pictures_filename"]);
        return($values);
    }

    public function getAllPictures($id)
    {
        $sql = "SELECT
               *
             FROM
               picview_pictures
             WHERE
               picview_pictures_promoid=:id
             ORDER BY
              picview_pictures_id DESC;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();

        $promoResult = $result->fetchAll(PDO::FETCH_ASSOC);
        return $promoResult;
    }
    public function RemovePicture($id)
    {
        $sql = "Delete
             FROM
               picview_pictures
             WHERE
               picview_pictures_id=:id
               limit 1;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_STR);
        $result->execute();
        //return var_dump($result);
    }
    public function changeDuration($values)
    {
        $sql = "Update
               picview_pictures
               set picview_pictures_duration=:duration
             WHERE
               picview_pictures_id=:id
               limit 1;";
        $result = $this->db->prepare($sql);
        $result->bindValue(':id', $values['pictureid'], PDO::PARAM_STR);
        $result->bindValue(':duration', $values['newduration'], PDO::PARAM_STR);
        $result->execute();
        //return var_dump($result);
    }

}

?>