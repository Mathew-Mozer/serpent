<div class="displays">
    <h2 class="casino-title"><?php echo $casino['casinoName'];?></h2>
    <?php
    $casinoDisplay = new CasinoDisplays($dbcon->read_database(), $casino['id']);
    $casinoDisplays = $casinoDisplay->getDisplays();
    foreach ($casinoDisplays as $display){?>
        <div class="display-outer">
            <div class="display-body container">
                <div class="display-header row">
                    <div class="col-md-4"><h3 id="name" class="header-text display-friendly-name display-font">
                            <?php echo $display->getName();?></h3></div>
                    <div class="col-md-4"><h3 id="location" class="header-text display-font">
                            <?php echo $display->getDisplayLocation(); ?></h3></div>
                    <div class="col-md-4 edit-display-div">
                        <button type="button" data-casino-id="<?php echo $casino['id'];?>"
                                data-display-id="<?php echo $display->getId();?>"
                                class="btn btn-info btn-lg edit-display-btn">EDIT</button>
                    </div>
                </div>
                <hr class="display">
                <?php
                $promotions = $display->getPromotions();
                    foreach ($promotions as $promo) {
                        $image = $promotion->getPromotionImageByPromotionId($promo['promotion_id']); ?>
                        <div class="promotion-preview-body">
                            <img class="promotion-preview-icon"
                                 src="dependencies/images/<?php echo $image['image']; ?>">
                        </div>
                    <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
