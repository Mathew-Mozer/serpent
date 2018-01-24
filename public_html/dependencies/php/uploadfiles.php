<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 5/25/2017
 * Time: 4:46 AM
 */
define('MB', 1048576);
    $target_dir = "../../apk/" . $_POST['folder'] . "/";
echo("folder:" + $_POST['folder']);
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
        echo('directory made');
    }
    $target_file = $target_dir . str_replace(' ','_',basename($_FILES["fileToUpload"]["name"]));
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);
// Check if file already exists
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.\n";
        echo('4');
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.\n";
            $values['filename'] = basename($_FILES["fileToUpload"]["name"]);
            echo "1";
        } else {
            echo "0";
        }
    }
?>