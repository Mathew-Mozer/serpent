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
    public function add($post)
    {
        $sql = "replace
                        INTO
                        `skin_tag_data`(
                        `skin_tag_data_id`,
                        `skin_tag_data_skinid`,
                        `skin_tag_data_tagid`,
                        `skin_tag_data_x`,
                        `skin_tag_data_y`,
                        `skin_tag_data_forecolor`,
                        `skin_tag_data_backcolor`,
                        `skin_tag_data_textcolor`,
                        `skin_tag_data_width`,
                        `skin_tag_data_height`,
                        `skin_tag_data_backsprite`,
                        `skin_tag_data_foresprite`,
                        `skin_tag_data_bordercolor`)
                        VALUES (
                        :id,
                        :skinid,
                        :tagid,
                        :xcoor,
                        :ycoor,
                        :forecolor,
                        :backcolor,
                        :textcolor,
                        :width,
                        :height,
                        :backsprite,
                        :foresprite,
                        :bordercolor);";
        echo(var_dump($post));
        $statement = $this->db->prepare($sql);
        if (!isset($post['xcoor']) || empty($post['xcoor'])) {
            $post['xcoor'] = null;
        }
        if (!isset($post['ycoor']) || empty($post['ycoor'])) {
            $post['ycoor'] = null;
        }
        if (!isset($post['forecolor']) || empty($post['forecolor'])) {
            $post['forecolor'] = null;
        }
        if (!isset($post['backcolor']) || empty($post['backcolor'])) {
            $post['backcolor'] = null;
        }
        if (!isset($post['textcolor']) || empty($post['textcolor'])) {
            $post['textcolor'] = null;
        }
        if (!isset($post['width']) || empty($post['width'])) {
            $post['width'] = null;
        }
        if (!isset($post['height']) || empty($post['height'])) {
            $post['height'] = null;
        }
        if (!isset($post['backsprite']) || empty($post['backsprite'])) {
            $post['backsprite'] = null;
        }
        if (!isset($post['foresprite']) || empty($post['foresprite'])) {
            $post['foresprite'] = null;
        }
        if (!isset($post['bordercolor']) || empty($post['bordercolor'])) {
            $post['bordercolor'] = null;
        }
        $statement->bindValue(':id', $post['id'], PDO::PARAM_STR);
        $statement->bindValue(':skinid', $post['skinid'], PDO::PARAM_STR);
        $statement->bindValue(':tagid', $post['tagid'], PDO::PARAM_STR);
        $statement->bindValue(':xcoor', $post['xcoor'], $this->getParamType($post['xcoor']));
        $statement->bindValue(':ycoor', $post['ycoor'], $this->getParamType($post['ycoor']));
        $statement->bindValue(':forecolor', str_replace("#", "", $post['forecolor']), $this->getParamType($post['forecolor']));
        $statement->bindValue(':backcolor', str_replace("#", "", $post['backcolor']), $this->getParamType($post['backcolor']));
        $statement->bindValue(':textcolor', str_replace("#", "", $post['textcolor']), $this->getParamType($post['textcolor']));
        $statement->bindValue(':width', $post['width'], $this->getParamType($post['width']));
        $statement->bindValue(':height', $post['height'], $this->getParamType($post['height']));
        $statement->bindValue(':backsprite', $post['backsprite'], $this->getParamType($post['backsprite']));
        $statement->bindValue(':foresprite', $post['foresprite'], $this->getParamType($post['foresprite']));
        $statement->bindValue(':bordercolor', str_replace("#", "", $post['bordercolor']), $this->getParamType($post['bordercolor']));
        echo($statement->execute());

        return $statement;
    }

    public function getParamType($val)
    {
        if (!isset($val) || empty($val)) {
            return PDO::PARAM_NULL;
        } else {
            return PDO::PARAM_STR;
        }

    }

    public function getSkins()
    {
        $sql = 'SELECT skin.skin_name,skin.skin_id FROM skin';
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getScenes()
    {
        $sql = 'SELECT * FROM scenes';
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSkinTags($sceneid)
    {
        $sql = 'SELECT * FROM skin_tag where skin_tag_sceneid=:id';
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':id', $sceneid, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSkinTagById($skinTagId)
    {
        $sql = 'SELECT * FROM skin_tag where skin_tag_id=:id';
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':id', $skinTagId, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUsedSkinColors($skinId)
    {
        $usedColors = array();
        $sql = 'SELECT * FROM skin_tag_data where skin_tag_data_skinid=:id';
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':id', $skinId, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $color) {

                if (!in_array("#" . $color['skin_tag_data_forecolor'], $usedColors)&&!empty($color['skin_tag_data_forecolor'])&&$color['skin_tag_data_forecolor']!=" ") {
                    array_push($usedColors, "#" . $color['skin_tag_data_forecolor']);
                }
                if (!in_array("#" . $color['skin_tag_data_backcolor'], $usedColors)&&!empty($color['skin_tag_data_backcolor'])&&$color['skin_tag_data_backcolor']!=" ") {
                    array_push($usedColors, "#" . $color['skin_tag_data_backcolor']);
                }
                if (!in_array("#" . $color['skin_tag_data_textcolor'], $usedColors)&&!empty($color['skin_tag_data_textcolor'])&&$color['skin_tag_data_textcolor']!=" ") {
                    array_push($usedColors, "#" . $color['skin_tag_data_textcolor']);
                }
                if (!in_array("#" . $color['skin_tag_data_bordercolor'], $usedColors)&&!empty($color['skin_tag_data_bordercolor'])&&$color['skin_tag_data_bordercolor']!=" ") {
                    array_push($usedColors, "#" . $color['skin_tag_data_bordercolor']);

                }

        }
        return $usedColors;
    }

    public function getSkinDataById($skinTagDataId, $skinId)
    {
        $sql = 'SELECT * FROM skin_tag_data where skin_tag_data_skinid=:skinid and skin_tag_data_tagid=:skintagid limit 1';
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':skinid', $skinId, PDO::PARAM_STR);
        $statement->bindValue(':skintagid', $skinTagDataId, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}