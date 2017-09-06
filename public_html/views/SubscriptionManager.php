<?php
if (!isset($_SESSION)) {
    session_start();
}
require "../models/SubscriptionModel.php";
require "../models/PromotionModel.php";
require "../models/UsersModel.php";
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
$user = new UsersModel($dbcon->read_database());
$subscriptionModel = new SubscriptionModel($dbcon->update_database());
$promotionModel = new PromotionModel($dbcon->update_database());
$subscribedPromotions = $subscriptionModel->getSubscribedPromotions($_POST['propertyId']);
?>
<table>
<?php

//var_dump($subscribedPromotions);

foreach ($promotionModel->getAllPromotionTypes() as $promotions) {
    if (findKey($subscribedPromotions, $promotions['promotion_type_id'])) {
        $isChecked = "checked";
    } else {
        $isChecked = "";
    }
    ?>
<tr><td><?php echo($promotions['promotion_type_title']);?></td><td>
    <input data-property-id="<?php echo($_POST['propertyId']) ?>"
           data-promo-id="<?php echo($promotions['promotion_type_id']) ?>"
           class="switch-wrapper swtchbtn"
           type="checkbox" value="1" <?php echo($isChecked) ?>>
    </td></tr>
    <?php
}
?>
</table>
<?php function findKey($array, $value)
{
    foreach ($array as $key) {
        if ($key['promotion_type_id'] === $value)
            return true;
    }
    return false;
}

?>
<script>
    $('.swtchbtn').switchButton().change(function () {
        $isit = $(this).prop("checked") ? 1 : 0;
        updateSubscription($(this).data('property-id'), $(this).data('promo-id'), $isit)
    });

    var updateSubscription = function (propertyid,promoid,permvalue) {
        var propertyID = propertyid;
        var proId = promoid;
        $.ajax({

            url: 'controllers/promotioncontroller.php',
            global: false,
            type: 'post',
            success: function (response){
                console.log(response);
                //alert(response);
            },
            data: {
                action: 'updatePromoSubscription', permValue:permvalue, propertyId: propertyID,promoId:proId}

        })
    };
</script>