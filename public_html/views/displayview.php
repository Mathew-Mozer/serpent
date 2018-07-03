<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['property_name'])) {
    $property['property_name'] = $_POST['property_name'];
    $property['property_id'] = $_POST['propertyId'];
    require_once('../models/PropertyDisplays.php');
    include('../models/PromotionModel.php');
    require "../models/PermissionModel.php";
    require_once("../dependencies/php/HelperFunctions.php");
    require_once(getServerPath() . "dbcon.php");
    $dbcon = NEW DbCon();

    $permission = new PermissionModel($dbcon->update_database(), $_SESSION['userId']);
}
/**
 * This is the display tile
 */
?>
<div class="displays">
    <h2 class="property-title"><?php echo $property['property_name']; ?></h2>
    <?php
    $propertyDisplay = new PropertyDisplays($dbcon->read_database(), $property['property_id']);
    $promotionData = new PromotionModel($dbcon->read_database());
    $propertyDisplays = $propertyDisplay->getDisplays();
    foreach ($propertyDisplays as $display) {
        $lockedpromoid = $display->getLockedPromoId();
        switch (intval($display->getMonitorState())) {
            case 0:
                $glyphmonitor = "glyphicon-eye-close";
                break;
            case 1:
                $glyphmonitor = "glyphicon-eye-open";
                break;
            case 2:
                $glyphmonitor = "glyphicon-warning-sign";
                break;
            default:
                $glyphmonitor = "glyphicon-eye-open";
        }
        ?>

        <div class="display-outer">
            <div class="display-body display-background-normal"
                 id="<?php echo "display-box-id-" . $display->getId(); ?>">
                <div class="display-header row">
                    <div class="col-md-4">
                        <h3 id="display-name" class="header-text display-friendly-name display-font">
                            <?php if ($permission->hasPermissionByAccount('display_manager', 'U') || $_SESSION['isGod']) { ?>
                                <div class="glyphicon <?php echo $glyphmonitor; ?>  toggleMonitorStatusBtn"
                                     data-display-id="<?php echo $display->getId(); ?>"
                                     data-monitor-state="<?php echo $display->getMonitorState(); ?>"></div> <?php } ?>
                            <?php if ($permission->hasPermissionByAccount('display_manager', 'U') || $_SESSION['isGod']) {
                                if (strlen($display->getFCMToken()) > 10) {
                                    ?>
                                    <div class="send-fcm-command glyphicon glyphicon-repeat"
                                         data-display-id="<?php echo $display->getId(); ?>"
                                         data-command="RestartApp" data-command="RestartApp"></div> <?php }
                            } ?><?php echo $display->getName(); ?>
                        </h3>
                    </div>
                    <div class="col-md-4"><h3 id="display-location" class="header-text display-font">
                            <?php echo $display->getDisplayLocation(); ?></h3></div>
                    <div class="col-md-4 edit-display-div">
                        <?php if ($permission->hasPermissionById('display', $property['property_id'], 'U') || $_SESSION['isGod']) { ?>
                            <button type="button" data-property-id="<?php echo $property['property_id']; ?>"
                                    data-property-name="<?php echo $property['property_name']; ?>"
                                    data-display-id="<?php echo $display->getId(); ?>"
                                    class="btn btn-info btn-lg edit-display-btn">EDIT
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <hr class="display">

                <?php
                $promotions = $display->getPromotions();
                foreach ($promotions as $promo) {
                    $image = $promotionData->getPromotionImageByPromotionId($promo['promotion_id']);
                    $artifact = $promotionData->getPromotionArtifactById($promo['promotion_id']);
                    $promoType = $promotionData->getPromotionTypeById($promo['promotion_id']);

                    if ($lockedpromoid == $promo['promotion_id']) {
                        $lockcontainerclass = "promotion-lock-overlay";
                        $lockglyphclass = "<i class='font-awesome fa fa-lock lock-glyphicon locked'></i>";
                        $lockstatus = "1";

                    } else {
                        $lockcontainerclass = "promotion-preview-body";
                        $lockglyphclass = "<i class='font-awesome fa lock-glyphicon hidden unlocked'></i>";
                        $lockstatus = "0";
                    }
                    if ($promo['promotion_label'] == "") {
                        $apromoname = $promoType['promotion_type_title'];
                    } else {
                        $apromoname = $promo['promotion_label'];

                    }
                    ?>

                    <div
                        class="<?php echo $lockcontainerclass ?>  promolockbtn-<?php echo $promo['promotion_id'] ?> promotionLockBtn"
                        data-property-id="<?php echo $property['property_id']; ?>"
                        data-property-name="<?php echo $property['property_name']; ?>"
                        data-promo-lockstatus="<?php echo $lockstatus; ?>"
                        data-promo-id="<?php echo $promo['promotion_id'] ?>"
                        data-display-id="<?php echo $display->getId() ?>" data-toggle="tooltip"
                        title="<?php echo $apromoname . " " . $promo['promotion_id'] ?>"
                        style="background-size: contain; background-image: url('dependencies/images/<?php echo $image['image']; ?>')">
                        <div class="tile-promotion-title"
                             style="float:left; display:block;clear: both;overflow: hidden; min-width: 75px;font-size: small;font-variant: small-caps;">
                            <?php echo substr($promo['promotion_label'], 0, 9);
                            if (strlen($promo['promotion_label']) > 10) {
                                echo('..');
                            }

                            ?></div>
                        <div class="lock-glyphicon-container">
                            <?php echo $lockglyphclass; ?>
                        </div>

                        <!-- <div class="promotion-artifact-preview">
                           <!-- <i class="font-awesome fa <?php //echo $artifact; ?>"></i>
                        </div>-->
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>