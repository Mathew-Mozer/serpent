<?php
/**
 * This is the update kick for cash form
 */
require "../../models/PromotionModel.php";
require_once("../../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");

//Create database connection object
$dbcon = NEW DbCon();

//Create models
$promotion = new PromotionModel($dbcon->read_database());
//echo(print_r($promotion->getPropertyInformation($_POST['promoid'])));
require "../../models/promotionmodels/TimeTargetModel.php";
$TimeTargetModel = new TimeTargetModel($dbcon->read_Database());
$TimeTargets = $TimeTargetModel->getAllTimeTargetChildren($_POST['promoid']);
?>
<div id="add-promotion">
<table class="table table-striped">
    <thead>
    <tr>
        <td>Seed</td>
        <td>Start</td>
        <td>Increment. Min.</td>
        <td>Add Amt.</td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><input id="ttSeed" type="number" name="time_target_default_seed" value="500"></td>
        <td><input id="ttStart" class="filthypillow">

        </td>
        <td><input id="ttIncrementValue" name="time_target_default_Increment" type="number" value="60"></td>
        <td><input id="ttIncrementAmount" name="time_target_default_add_amt" type="number" value="100"></td>
        <td>
            <button type="button" class="add-new-timetargetx"> Start New Board</button>
        </td>
    </tr>
    </tbody>
</table>
<input id="ttlockDef" name="time_target_lock_defaults" type="number" value="" hidden>
<input id="ttlDefhour" name="time_target_def_hour" type="number" value="-1" hidden>
<input id="ttDefmin" name="time_target_def_minute" type="number" value="-1" hidden>
<input id="ttprog" name="time_target_progressive" type="number" value="0" hidden>
</div>
<div class="promotion-view">
    <?php
    $promolist = array();
foreach ($TimeTargets as $promo){

    $row = $promotion->getPromotionDetails($promo['promotion_id']);
    $prevdir = "../";
    array_push($promolist,$row["promotion_id"]);


//    $row["promotion_label"]=$promo["promotion_label"];
  //  $row["promotion_type_title"]="";
 //   $row["promo_title"] = "";
    //$row["promo_id"] = $promo["promotion_id"];

    include '../promotionview.php';
    ?>

<?php
}
?>
    </div>
<script>
    $(".settingsBtn").unbind('click').click(function (e) {
        e.stopPropagation();
        $("#promotion-view-modal").data('promo-id', $(this).data("promo-id"));
        $("#promotion-view-modal").data('promo-type-id', $(this).data("promo-type-id"));
        $("#promotion-view-modal").load("views/addpromotionviews/add"+$(this).data("promo-type")+"view.php",{propertyId: $(this).data("promo-property-id") ,promotion_settings:true, promotion_id:$(this).data("promo-id"), promotion_type:$(this).data("promo-type-id")});
        openSettingsModal();
    });
    $(".tile-body").unbind('click').click(function () {
        $("#promotion-view-modal").data('promo-id', $(this).data("promo-id"));
        $("#promotion-view-modal").data('promo-type-id', $(this).data("promo-type-id"));
        $("#promotion-view-modal").data('promo-point-storage', $(this).data("property-point-storage"));
        console.log("Display:" +  $(this).data("promo-type"));
        $("#promotion-view-modal").load("views/displaypromotionviews/display" + $(this).data("promo-type") + "view.php",{promoid:$(this).data("promo-id"),pointstorage:$(this).data("property-point-storage")});
        promotionViewModal.dialog('open');
    });
</script>


<script src="dependencies/js/promotion/formhelperfunctions.js"></script>
<script>
    var enableFP = function () {
        var $fp = $( ".filthypillow" ), now=moment().subtract( "seconds", 1 ) ;
        $fp.val(d1.format( "YYYY-MM-DD HH:mm:00") );
        $fp.filthypillow( {
            calendar: {
                saveOnDateSelect: false,
                isPinned: true
            },
            initialDateTime: function( m ) {
                if($('#ttlDefhour').val()>-1){
                    m.hour($('#ttlDefhour').val())
                }
                if($('#ttDefmin').val()>-1){
                    m.minute($('#ttDefmin').val());
                }
                return m;
            }
        });
        $fp.on( "focus", function( ) {
            $fp.filthypillow( "show" );
        } );
        $fp.on( "fp:save", function( e, dateObj ) {
            $fp.val( dateObj.format( "YYYY-MM-DD HH:mm:00") );
            $fp.filthypillow( "hide" );
        } );

    }
    var d1 = moment().subtract( "seconds", 1 );
    var now =moment().subtract( "seconds", 1 );
    $( "#ttlockDef" ).bind("change paste keyup", function(){
        if($( "#ttlockDef" ).val()=="1"){
            $('#ttIncrementValue').attr('disabled', true);
            $('#ttIncrementAmount').attr('disabled', true);
            $('#ttSeed').attr('disabled', true);
            $('#ttStart').attr('disabled', true);
            if($('#ttlDefhour').val()>-1) {
                d1.hour($('#ttlDefhour').val())
            }
            if($('#ttDefmin').val()>-1){
                d1.minute($('#ttDefmin').val());
            }
            if(d1>now){
                d1 = d1.subtract("days",1);
                console.log("Time is later than now so I removed a day")
            }else{
                console.log("Time was fine so I didn't remove a day")
            }
            console.log("disabled");
            enableFP();
        }else{

        }
    });
    getModalData('<?php echo($promolist[0])?>', 14)
    var timetargetpromos = <?php echo json_encode($promolist) ?>


</script>