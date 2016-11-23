        <div class="tile-body <?php echo $row['promo_id'];?>" data-promo-type-id="<?php echo $row['promo_type_id'];?>" data-promo-id="<?php echo $row['promo_id'];?>"  data-promo-type="<?php echo $row['file_name'];?>" data-toggle="tooltip" title="<?php echo $row['promo_title'];?>">
            <img class="tile-icon" src="dependencies/images/<?php echo $row['promo_image']?>">
            <div class="tile-promotion-artifact">
                <i class="font-awesome fa <?php echo $row['artifact'] ?>"></i>
            </div>
            <div class="tile-menu-bar hidden">
                <?php if ($permission->hasPermissionById('property', $property['property_id'],'U')){?>
                <div class="tile-menu-item settingsBtn"  data-promo-id="<?php echo $row['promo_id'];?>" data-promo-type="<?php echo $row['file_name'];?>" data-promo-type-id="<?php echo $row['promo_type_id'];?>" id="<?php echo $property['property_id'] . '-' . $row['promo_id']; ?>">
                    <span class="glyphicon glyphicon-cog glyphicon-menu black" aria-hidden="true"></span>
                </div> <?php } ?>
                <div class="tile-menu-item">
                    <span class="glyphicon glyphicon-pause glyphicon-menu black" aria-hidden="true"></span>
                </div>
                <div class="tile-menu-item">
                    <span class="glyphicon glyphicon-user glyphicon-menu black" aria-hidden="true"></span>
                </div>
            </div>
        </div>
