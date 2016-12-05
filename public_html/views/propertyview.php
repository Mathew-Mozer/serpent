<?php
/**
 * This is the property view
 */
?>
<div class="promotion-view" id=<?php echo "\"promotion-list-" . $property['property_id'] . "\""; ?>>
    <h2 class="property-title"><?php echo $property['property_name'];?></h2>

    <?php
    if($permission->hasPermissionById('promotion',$property['property_id'],'C')){?>
    <div title="New Promotion"  data-toggle="tooltip"  id=<?php echo "\"" . $property['property_id'] . "\""; ?> class="add-promotion-btn tile-body tile-insert">
        <img class="tile-icon" src="dependencies/images/clear.png">
        <div class="glyphicon-new-container">
            <span class="glyphicon glyphicon-plus-sign glyphicon-new-tile white" aria-hidden="true"></span>
        </div>
    </div>

    <?php
  }
    $promotionList = $promotion->getAllPromotionsByProperty($property['property_id']);
    if(count($promotionList)>0){
        foreach($promotionList as $row){

          include 'promotionview.php';
        }
      }?>

</div>
