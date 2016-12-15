<?php
/**
 * This is the promotion tile
 */
if(isset($_POST['append_promotion'])){
    if($_POST['append_promotion'] == true){
        $row = $_POST;
        $canUpdate = true;
    }else{
        $canUpdate = $permission->hasPermissionById('property', $row['property_id'],'U');
    }
}
if(isset($row['promo_status'])) {
    switch (intval($row['promo_status'])) {
        case 0:
            $glyphstatus = "glyphicon-play";
            break;
        case 1:
            $glyphstatus = "glyphicon-stop";
            break;
        case 2:
            $glyphstatus = "glyphicon-pause";
            break;
        default:
            $glyphstatus = "glyphicon-pause";
    }
}
?>
<div id="tile-<?php echo $row['promo_id'];?>" class="tile-body <?php echo $row['promo_id'];?>" data-promo-type-id="<?php echo $row['promo_type_id'];?>" data-promo-id="<?php echo $row['promo_id'];?>" data-promo-status="<?php echo $row['promo_status'];?>" data-promo-type="<?php echo $row['file_name'];?>" data-toggle="tooltip" title="<?php echo $row['promo_title']." ".$row['promo_id'];?>">
            <img class="tile-icon" src="dependencies/images/<?php echo $row['promo_image']?>">
            <div class="tile-promotion-artifact">
                <i class="font-awesome fa <?php echo $row['artifact'] ?>"></i>
            </div>
            <div class="tile-menu-bar" style="display: none">
                <?php// if ($canUpdate){?>
                <div class="tile-menu-item settingsBtn"  data-promo-id="<?php echo $row['promo_id'];?>" data-promo-type="<?php echo $row['file_name'];?>" data-promo-type-id="<?php echo $row['promo_type_id'];?>" id="<?php echo $row['property_id'] . '-' . $row['promo_id']; ?>">
                    <span class="glyphicon glyphicon-cog glyphicon-menu black" aria-hidden="true"></span>
                </div> <?php// } ?>
                <div class="tile-menu-item promotionStatusBtn" data-promo-id="<?php echo $row['promo_id'];?>" data-promo-status="<?php echo $row['promo_status'];?>" id="<?php echo $row['property_id'] . '-' . $row['promo_id']; ?>">
                    <span class="glyphicon <?php echo($glyphstatus);?> glyphicon-menu black" aria-hidden="true"></span>
                </div>
                <div class="tile-menu-item promotionDeleteBtn"  data-promo-id="<?php echo $row['promo_id'];?>">
                    <span class="glyphicon glyphicon-remove-circle glyphicon-menu black " aria-hidden="true"></span>
                </div>
            </div>
        </div>

