<?php
/**
 * This is the property view
 */
$prevdir="";
require_once "../models/PropertyDisplays.php";
?>
<div class="promotion-view" id=<?php echo "\"promotion-list-" . $property['property_id'] . "\""; ?>>
    <h2 class="property-title"><?php echo $property['property_name']; ?>
        <?php
        if ($_SESSION['isGod']) {
            ?>
            <span><i data-property-id="<?php echo($property['property_id']); ?>"
                     class="fa fa-list-alt property-option-icon view-subscriptions-btn"></i></span>


            <span><i data-property-id="<?php echo($property['property_id']); ?>"
                     class="fa fa-caret-square-o-down property-isviewing"></i></span>
            <?php
        }
        ?>
    </h2>
    <div id="promotioncontainer<?php echo($property['property_id']); ?>">
        <?php
        if ($permission->hasPermissionById('promotion', $property['property_id'], 'C') || $_SESSION['isGod']){
        ?>
        <div title="New Promotion" data-toggle="tooltip"
             data-point-storage="<?php echo($property['property_point_storage']) ?>"
             id=<?php echo "\"" . $property['property_id'] . "\""; ?> class="add-promotion-btn tile-body tile-insert
        ">
        <img class="tile-icon" src="dependencies/images/clear.png">
        <div class="glyphicon-new-container">
            <span class="glyphicon glyphicon-plus-sign glyphicon-new-tile white" aria-hidden="true"></span>
        </div>
    </div>
    <?php
    }

    $promotionList = $promotion->getAllPromotionsByProperty($property['property_id']);
    if (count($promotionList) > 0) {
        foreach ($promotionList as $row) {
            include 'promotionview.php';
        }
    } ?>

</div>

</div>
<div style="background-color: #c3cacc;">
    <?php if ($permission->hasPermissionById('display', $property['property_id'], 'R') || $_SESSION['isGod']) { ?>
        <div style="float: left; line-height: 60px; margin-left: 55px; margin-right:20px"><h3 id="display-name" class="header-text display-friendly-name display-font">Displays</h3></div>
        <?php

        $propertyDisplay = new PropertyDisplays($dbcon->read_database(), $property['property_id']);
        $promotionData = new PromotionModel($dbcon->read_database());
        $propertyDisplays = $propertyDisplay->getDisplays();
        foreach ($propertyDisplays as $display) { ?>
            <div style="float: left">
                <button title="<?php  echo($display->getDisplayLocation()."&nbsp;")?>" data-toggle="tooltip" type="button" data-property-id="<?php echo $property['property_id']; ?>"
                        data-property-name="<?php echo $property['property_name']; ?>"
                        data-display-id="<?php echo $display->getId(); ?>"
                        data-display-linkcode="<?php echo $display->getLinkCode(); ?>"
                        class="btn btn-info btn-lg edit-display-btn" style="width: 150px; margin-right: 15px;margin-left: 15px"><span class="display-name-label" style=""><?php echo($display->getName()."&nbsp;")?></span><br><span class="display-location" style="font-size: small"><?php  echo($display->getDisplayLocation()."&nbsp;")?></span>
                </button>
            </div>
        <?php }
    }
    ?>
    <div style="clear:both; float: none"></div>

</div>

