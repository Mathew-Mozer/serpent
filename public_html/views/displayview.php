
<div id="boxes">
    <?php $displays = $box->getAllBoxesWithCasinoId(1);
    foreach ($displays as $display){?>
    <div class="display-outer">
        <div class="display-body container">
            <div class="display-header row">
                <div class="col-md-4"><h3 id="name" class="header-text display-friendly-name display-font">
                        <?php echo $display->getName();?></h3></div>
                <div class="col-md-4"><h3 id="serial" class="header-text display-font">
                        <?php echo $display->getSerial(); ?></h3></div>
                <div class="col-md-4 edit-display-div">
                    <button type="button" class="btn btn-info btn-lg edit-display-btn">EDIT</button>
                </div>
            </div>
            <hr class="display">
            <?php
            $promotions = $display->getPromotions();
            //var_dump($promotions);
            for($i = 0; $i < count($promotions) ; $i++){
            ?>
            <div class="promotion-preview-body <?php echo "test1"; //$row['promo_id'];?>">
                <img class="promotion-preview-icon" src="dependencies/images/<?php echo "pointsgt.png"; //$row['promo_image']?>">
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
</div>