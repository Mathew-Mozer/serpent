TEMPLATEVIEW.php<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 1/24/2018
 * Time: 3:24 AM
 */
//

?>
Add Menu Boards
<div id="add-promotion">

<!-- Make sure to set the scene ID correctly  -->
<input type="hidden" id="scene-id" name="scene_id" value="">
</div>

<script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime() ?>"></script>

<?php
if (isset($_POST['promotion_settings'])) {
    if ($_POST['promotion_settings']) {
        echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
        echo "<script>
 
</script>";
    }
}
?>

