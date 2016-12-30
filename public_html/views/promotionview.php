<?php
/**
 * This is the promotion tile
 */
if(!isset($_SESSION)) {
    session_start();
}
require_once "../models/PermissionModel.php";
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
$canUpdate = false;
if(isset($_POST['append_promotion'])){
    if($_POST['append_promotion'] == true){
        $row = $_POST;

    }else{

    }

}
$glyphstatus = "glyphicon-play";

if(isset($row['promo_status'])) {
    
    switch (intval($row['promo_status'])) {
        case 0:
            $glyphstatus = "glyphicon-stop";
            break;
        case 1:
            $glyphstatus = "glyphicon-play";
            break;
        case 2:
            $glyphstatus = "glyphicon-pause";
            break;
        default:
            $glyphstatus = "glyphicon-play";
    }

}
$permission = new PermissionModel($dbcon->update_database(), $_SESSION['userId']);
?>
<div id="tile-<?php echo $row['promo_id'];?>" class="tile-body <?php echo $row['promo_id'];?>" data-promo-type-id="<?php echo $row['promo_type_id'];?>" data-promo-id="<?php echo $row['promo_id'];?>" data-promo-status="<?php echo $row['promo_status'];?>" data-promo-type="<?php echo $row['file_name'];?>" data-toggle="tooltip" title="<?php echo $row['promo_title']." ".$row['promo_id'];?>">
            <img class="tile-icon" src="dependencies/images/<?php echo $row['promo_image']?>">
            <div class="tile-promotion-artifact">
                <i class="font-awesome fa <?php echo $row['artifact'] ?>"></i>
            </div>
            <div class="tile-menu-bar" style="display: none">
                <div class="tile-menu-item">
                <?php if ((bool)$permission->hasPermissionById('promotion_settings', $row['property_id'],'U')||$_SESSION['isGod']){?>
                <div class="tile-menu-item settingsBtn"  data-promo-id="<?php echo $row['promo_id'];?>" data-promo-type="<?php echo $row['file_name'];?>" data-promo-type-id="<?php echo $row['promo_type_id'];?>" id="<?php echo $row['property_id'] . '-' . $row['promo_id']; ?>">
                    <span class="glyphicon glyphicon-cog glyphicon-menu black" aria-hidden="true"></span>
                </div> <?php }?></div>
                <div class="tile-menu-item promotionStatusBtn" data-promo-id="<?php echo $row['promo_id'];?>" data-promo-status="<?php echo $row['promo_status'];?>" id="<?php echo $row['property_id'] . '-' . $row['promo_id']; ?>">
                    <span class="glyphicon <?php echo($glyphstatus);?> glyphicon-menu black" aria-hidden="true"></span>
                </div>
                <?php if ((bool)$permission->hasPermissionById('promotion_settings', $row['property_id'],'D')||$_SESSION['isGod']){?>
                <div class="tile-menu-item promotionDeleteBtn"  data-promo-id="<?php echo $row['promo_id'];?>">
                    <span class="glyphicon glyphicon-remove-circle glyphicon-menu black " aria-hidden="true"></span>
                </div><?php }?>
            </div>
        </div>

