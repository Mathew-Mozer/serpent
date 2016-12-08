<?php
/**
 * This is the display tile
 */
?>
<div class="displays">
    <h2 class="property-title"><?php echo $property['property_name'];?></h2>
    <?php
    $propertyDisplay = new PropertyDisplays($dbcon->read_database(), $property['property_id']);
    $promotionData = new PromotionModel($dbcon->read_database());
    $propertyDisplays = $propertyDisplay->getDisplays();

    foreach ($propertyDisplays as $display){?>
        <div class="display-outer">
            <div class="display-body display-background-normal container" id="<?php echo "display-box-id-" . $display->getId(); ?>">
                <div class="display-header row">
                    <div class="col-md-4"><h3 id="display-name" class="header-text display-friendly-name display-font">
                            <?php echo $display->getName();?></h3></div>
                    <div class="col-md-4"><h3 id="display-location" class="header-text display-font">
                            <?php echo $display->getDisplayLocation(); ?></h3></div>
                    <div class="col-md-4 edit-display-div">
                        <button type="button" data-property-id="<?php echo $property['property_id'];?>" data-display-id="<?php echo $display->getId();?>" class="btn btn-info btn-lg edit-display-btn">EDIT</button>
                    </div>
                </div>
                <hr class="display">
                <?php
                $promotions = $display->getPromotions();
                    foreach ($promotions as $promo) {
                        $image = $promotion->getPromotionImageByPromotionId($promo['promotion_id']);
                        $artifact = $promotionData->getPromotionArtifactById($promo['promotion_id']);
                        $promoType = $promotionData->getPromotionTypeById($promo['promotion_id']); ?>
                        <div class="promotion-preview-body" data-toggle="tooltip" title="<?php echo $promoType['promotion_type_title'] . " " .$promo['promotion_id'];?>">
                            <img class="promotion-preview-icon"
                                 src="dependencies/images/<?php echo $image['image']; ?>">
                            <div class="promotion-artifact-preview">
                                <i class="font-awesome fa <?php echo $artifact; ?>"></i>
                            </div>
                        </div>
                    <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
