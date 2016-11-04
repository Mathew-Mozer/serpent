<div id="boxes">
    <?php
    require "/home/christopher/public_html/public_html/models/BoxModel.php";

    $boxModel = new BoxModel($dbcon->read_database());
    $displays = $boxModel->getAllBoxesWithCasinoId(1);
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
                foreach($promotions as $promo){
                    $image = $promotion->getPromotionImageByPromotionId($promo); ?>
                    <div class="promotion-preview-body">
                        <img class="promotion-preview-icon"
                             src="dependencies/images/<?php echo $image['image'];?>">
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>