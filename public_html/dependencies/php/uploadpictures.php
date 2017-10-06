<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 5/25/2017
 * Time: 4:46 AM
 */
require_once("../../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
require "../../models/promotionmodels/PicViewerModel.php";
$PicViewerModel = new PicViewerModel($dbcon->read_Database());
define('MB', 1048576);
if(isset($_POST['promoid'])) {


    $target_dir = "../../clientpictures/uploads/" . $_POST['promoid'] . "/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
        echo('directory made');
    }
    $target_file = $target_dir . str_replace(' ','_',basename($_FILES["fileToUpload"]["name"]));
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo('2');
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo('3');
            //echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.\n";
        echo('4');
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 15 * MB) {
        //echo "Sorry, your file is too large.\n";
        echo('5');
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo('6'.$imageFileType);
        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.\n";
            $values['picview_pictures_filename'] = str_replace(' ','_',basename($_FILES["fileToUpload"]["name"]));
            $values['promoid'] = $_POST['promoid'];
            $PicViewerModel->AddPictureToDatabase($values);
            echo "1";
        } else {
            echo "0";
        }
    }
}
else{
    echo('PromoID isn\'t set');
    print_r($_POST);
}
?>