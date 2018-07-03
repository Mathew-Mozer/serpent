<?php
require "../../models/PromotionModel.php";
require_once("../../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");

//Create database connection object
$dbcon = NEW DbCon();

//Create models
$promotion = new PromotionModel($dbcon->read_database());

$properties = $promotion->getAssignableProperties();
if(isset($_POST["promotion_id"])){


?>


<div class="outer">
    Promotions Linked:
    <div class="innerwrap">

    </div>

    <?php
    $childPromos = $promotion->getPromotionChildren($_POST["promotion_id"]);
    switch (sizeof($childPromos)) {
        case 4:
        case 6:
        case 13:
            break;
        default:
            ?>
            <span
                style="font-size: large; color: red">You need 4,6 or 13 active promotions. You currently have <?php echo(sizeof($childPromos)) ?>
                .</span>
            <?php
    }
    foreach ($childPromos as $promo) {

        ?>
        <script>
            $("#tile-<?php echo($promo["promotion_id"]) ?>").toggle(false)
        </script>
        <div style="border-style: solid ">
            <img style="width: 30px; height: 30px" src="dependencies/images/<?php echo $promo['promo_image'] ?>">

            <span title="<?php echo($promo["promotion_id"]) ?>"><?php

                if (trim($promo["promotion_label"]) == "") {
                    echo($promo["promotion_type_title"]);
                } else {
                    echo($promo["promotion_label"]);
                }
                ?></span>
            <button data-parent-id="0" data-promo-id="<?php echo $promo['promotion_id'] ?>" style="float: right"
                    class="btn btn-sm btn-danger promoChildButton">Remove From Promotion
            </button>
        </div>
        <?php
    }
    ?>
    <br>
    <div class="outer">
        Linkable Promotions
        <div class="innerwrap"></div>
        <?php
        $promocnt = 0;
        foreach ($properties as $property) {
            foreach ($promotion->getAllPromotionsByProperty($property["property_id"], "14") as $promo) {
                if ($promo["promotion_id"] != $_POST['promotion_id']) {
                    $promocnt++;
                    ?>
                    <script>
                        $("#tile-<?php echo($promo["promotion_id"]) ?>").toggle(true)
                    </script>
                    <div style="border-style: solid ">
                        <img style="width: 30px; height: 30px"
                             src="dependencies/images/<?php echo $promo['promo_image'] ?>">

                        <span title="<?php echo($promo["promotion_id"]) ?>"><?php

                            if (trim($promo["promotion_label"]) == "") {
                                echo($promo["promotion_type_title"]);
                            } else {
                                echo($promo["promotion_label"]);
                            }
                            ?></span>
                        <button data-parent-id="<?php echo $_POST["promotion_id"] ?>"
                                data-promo-id="<?php echo $promo['promotion_id'] ?>" style="float: right"
                                class="btn btn-sm btn-success promoChildButton">Add To Promotion
                        </button>


                    </div>
                    <?php
                }
            }
        }
        if ($promocnt = 0) {
            ?>
            There are currently no Time Target Promotions to link.
            <?php
        }
        }else{
            echo("Promotions are linked after this promotion is created");
        }
        ?>

    </div>
    <div id="add-promotion">
        <input type="hidden" id="promotionTypeName" name="tt_promotionType" value="timetargetx">
        <input type="hidden" id="promotionTypeId" name="tt_promotionTypeId" value="15">
        <br>
        <br>
        <input type="hidden" id="scene-id" name="scene_id" value="15"/>

        <script src="dependencies/js/promotion/formhelperfunctions.js?t=<?php echo microtime() ?>"></script>
        <?php
        if (isset($_POST['promotion_settings'])) {
            if ($_POST['promotion_settings']) {
                echo "<script>getModalData(" . $_POST['promotion_id'] . "," . $_POST['promotion_type'] . ");</script>";
            }
        }

 ?>
<script>
    $(".promoChildButton").unbind('click').click(changePromotionChildStatus);

    function changePromotionChildStatus() {
        $.ajax({
            url: 'controllers/promotioncontroller.php',
            type: 'post',
            data: {
                action: 'updateChildPromoId',
                parentId: $(this).data("parent-id"),
                childId: $(this).data("promo-id")
            },
            cache: false,
            success: function (response) {
               console.log(response);
                //$("#settings").data('promo-id', $(this).data("promo-id"));
                //$("#settings").data('promo-type-id', $(this).data("promo-type-id"));
                $("#promotion-view-modal").load("views/addpromotionviews/addtimetargetxview.php",<?php echo json_encode($_POST) ?>);

            },
            error: function(xhr, desc, err) {
                console.log(xhr + "\n" + err);
            }

        });
    }

</script>