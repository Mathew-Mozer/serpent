
<div class="promotion-view" id=<?php echo "\"promotion-list-" . $casino['id'] . "\""; ?>>
    <h2 class="casino-title"><?php echo $casino['casinoName'];?></h2>
    <!--New Promotion Title-->
    <?php
    if($permission->canCreateCasinoPromotion($casino['id'])){?>
    <div id=<?php echo "\"" . $casino['id'] . "\""; ?> class="add-promotion-btn tile-body tile-insert">
        <img class="tile-icon" src="dependencies/images/clear.png">
        <div class="glyphicon-new-container">
            <span class="glyphicon glyphicon-plus-sign glyphicon-new-tile white" aria-hidden="true"></span>
        </div>
    </div>
    <!--End New Promotion Tile-->
    <!--Promotion Title-->
    <?php
  }
    $promotionList = $promotion->getAllPromotionsByCasino($casino['id']);
    if(count($promotionList)>0){
        foreach($promotionList as $row){
          include 'promotionview.php';
        }
      }?>
    <!--End Promotion Tile-->
</div>