<?php
/**
 * Created by PhpStorm.
 * User: zhydi
 * Date: 12/23/2016
 * Time: 10:53 AM
 */
if (!isset($_SESSION)) {
    session_start();
}
require_once "../models/DocumentsModel.php";
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
$documentsModel = new DocumentsModel($dbcon->read_database());
?>

<?php
if (isset($_SESSION['userId'])) {
    $documents = $documentsModel->getAllDocuments();
    $ttl = "";
    foreach ($documents as $document) {
        if ($ttl != $document['promotion_type_title']) {
            $ttl = $document['promotion_type_title']; ?>
            <div style="clear: left;">
            <br>
            <h1 class="centerText"> <?php echo $document['promotion_type_title'] ?></h1>
            <hr>
        <?php } ?>
        <div class='file-div centerText' style=" border: solid;border-color:gray">
            <img style='width:140px; height:80px'
                 src='../dependencies/images/supportingfiles/<?php echo $document['documents_filename'] . ".png" ?>'>
            <br>
            <span class="center" style="font-weight: bolder"><?php echo $document['documents_title'] ?></span>
            <br>
            <?php $fileTypes = explode(",", $document['documents_types']);
            foreach ($fileTypes as $file) {
                ?>
                <a style="color: blue; text-decoration: underline; text-transform: uppercase" href="../dependencies/supportingdocuments/<?php echo $document['documents_filename'].".".$file ?>"><?php echo $file ?></a>&nbsp;
            <?php } ?>
            <br>
            <span><?php echo $document['documents_description'] ?></span><br>
        </div>

        <?php
    }
    echo "</div>";
}
?>