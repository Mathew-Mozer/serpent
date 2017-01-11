<?php
if (!isset($_SESSION)) {
    session_start();
}
require "../models/PromotionModel.php";
require "../models/PermissionModel.php";
require "../models/UsersModel.php";
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
$user = new UsersModel($dbcon->read_database());
$myPermission = new PermissionModel($dbcon->update_database(), $_SESSION['userId']);
$theirPermission = new PermissionModel($dbcon->update_database(), $_POST['userId']);
$tagCategory = "";
?>
<br>
<?php
//
function cmp(array $a, array $b) {
    if ($a['tag_toggle_cat_id'] < $b['tag_toggle_cat_id']) {
        return -1;
    } else if ($a['tag_toggle_cat_id'] > $b['tag_toggle_cat_id']) {
        return 1;
    } else {
        return 0;
    }
}
//

if (isset($_SESSION['userId'])) {
    $myTags = $myPermission->getPermissionTagTriggers($_POST['propertyId']);
    usort($myTags,'cmp');

    foreach ($myTags as $tagToggles) {
        $isChecked = "";
        if ($theirPermission->hasPermissionById($tagToggles['tag_type'], $_POST['propertyId'], $tagToggles['tag_toggle_permission_value'])) {
            $isChecked = "checked";
        } else {
            $isChecked = "";
        }

        ?>

        <div>
            <?php if ($tagToggles['tag_toggle_cat_name'] != $tagCategory) {
                echo("<h3>" . $tagToggles['tag_toggle_cat_name'] . "</h3>");
                $tagCategory = $tagToggles['tag_toggle_cat_name'];
            }

            ?>

            <div style="float:left;  width :225px">
                <?php echo($tagToggles['tag_toggle_description']) ?></div>
            <div style="float:left; width :200px">
                <input data-user-id="<?php echo($_POST['userId']) ?>"
                       data-permvalue="<?php echo($tagToggles['tag_toggle_permission_value']) ?>"
                       data-property-id="<?php echo($_POST['propertyId']) ?>"
                       data-permid="<?php echo($tagToggles['tag_id']) ?>" class="switch-wrapper swtchbtn"
                       type="checkbox" value="1" <?php echo($isChecked) ?>>
            </div>
            <br style="clear: left;" />
        </div>

        <?php
    }
}
?>
<script>
    $('.swtchbtn').switchButton().change(function () {
        $isit = $(this).prop("checked") ? 1 : 0;
        updateUserPermissions($(this).data('user-id'), $(this).data('property-id'), $(this).data('permid'), $isit, $(this).data('permvalue'))
    });
</script>
