        <div class="tile-body <?php echo $row['promo_id'];?>" data-promo-id="<?php echo $row['promo_id'];?>"  data-promo-type="<?php echo $row['file_name'];?>" data-toggle="tooltip" title="<?php echo $row['promo_title'];?>">
            <img class="tile-icon" src="dependencies/images/<?php echo $row['promo_image']?>">
            <div class="tile-menu-bar hidden">
                <?php if ($permission->canUpdatePropertyPromtion($property['id'])){?>
                <div class="tile-menu-item settingsBtn" id="<?php echo $property['id'] . '-' . $row['promo_id']; ?>">
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
