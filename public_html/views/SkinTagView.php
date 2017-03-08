<?php
if (!isset($_SESSION)) {
    session_start();
}
require "../models/SkinModel.php";
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
$skinModel = new SkinModel($dbcon->read_database());
//echo($_POST['skinId']." - ".$_POST['sceneId']);

if (isset($_SESSION['userId']) && isset($_POST['skinId'])) {

    $skinTags = $skinModel->getSkinTags($_POST['sceneId']);
    foreach ($skinTags as $skinTag) {
        ?>
        <div class="edit-user-button edit-skin-tag" data-tag-id="<?php echo $skinTag['skin_tag_id'] ?>">
            <?php echo $skinTag['skin_tag_name'] ?>
        </div>
        <?php
    }
}
?>
