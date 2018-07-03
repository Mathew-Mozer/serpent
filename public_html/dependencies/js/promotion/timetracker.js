/**
 * Created by Mathew on 1/16/2017.
 */
console.log('loaded timetracker.js');
var loadViewTimes = function (promoid,propertyid) {
    $('#timetrackerbody').load("views/displaypromotionviews/timetrackerlist.php", {promoid: promoid,propertyid:propertyid});
}

$(document).on("click", ".add-new-timetarget", function () {
    addNewTimeTarget($("#promotion-view-modal").data('promo-id'));
});
$(document).on("click", ".add-new-timetargetx", function () {

    //addNewTimeTarget($("#promotion-view-modal").data('promo-id'));
    var passnum = Math.floor((Math.random() * 999999) + 1);
    var person = prompt("THIS WILL RESTART ALL JACKPOTS! USE WISELY!\nPlease enter this number exactly: " + passnum, "");

    if (person == null || person == "") {
        txt = "Board was NOT reset";
    } else {
        if(passnum==person){
            alert("Reset Complete");
            timetargetpromos.forEach(promoloop)
        }else{
            alert("Password Incorrect. Please Try Again");
        }
    }


});

$(document).on("click", ".time-table-confirm", function () {
    TimeTargetUpdate($("#promotion-view-modal").data('promo-id'), 0,$(this).attr('data-target-id'),0,$(this).attr('data-target-paidamt'));
});
$(document).on("click", ".time-table-end", function () {
    TimeTargetUpdate($("#promotion-view-modal").data('promo-id'), 1,$(this).attr('data-target-id'),1,$(this).attr('data-target-paidamt'));
});
$(document).on("click", ".time-table-unconfirm", function () {
    TimeTargetUpdate($("#promotion-view-modal").data('promo-id'), 1,$(this).attr('data-target-id'),0,$(this).attr('data-target-paidamt'));
});
$(document).on("click", ".time-table-archive", function () {
    TimeTargetUpdate($("#promotion-view-modal").data('promo-id'), 2,$(this).attr('data-target-id'),0,$(this).attr('data-target-paidamt'));
});
var promoloop = function(item,index){
    addNewTimeTarget(item);
}
var TimeTargetUpdate = function (promoId, action,timeTargetId,endTimeTarget,paidamt) {
    switch (action) {
        case 0:
            $action = 'confirmTimeTarget';
            break;
        case 1:
            $action = 'endTimeTarget';
            break;
        case 2:
            $action = 'archiveTimeTarget';
            break
    }
    data = {
        action: $action,
        promotionId: promoId,
        timetargetpaidamt: paidamt,
        timetargetpaidby: $("#promotion-view-modal").data('property-id'),
        timeTargetId: timeTargetId,
        endTime:endTimeTarget
    };
    console.log("dd " + JSON.stringify(data))

    $.ajax({
        url: 'controllers/promotioncontrollers/timetargetcontroller.php',
        type: 'post',
        data: data ,
        cache: false,
        success: function (response) {
            loadViewTimes(promoId,$("#promotion-view-modal").data('property-id'));
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });

}
var addNewTimeTarget = function (promoId) {
    $seed = $('#ttSeed').val();
    $start = $('#ttStart').val();
    $incrmin = $('#ttIncrementValue').val();
    $addamt = $('#ttIncrementAmount').val();
    console.log("proid"+$("#promotion-view-modal").data('property-id'));
    $.ajax({
        url: 'controllers/promotioncontrollers/timetargetcontroller.php',
        type: 'post',
        data: {
            action: 'addTimeTarget',
            promotionId: promoId,
            time_target_seed: $seed,
            time_target_start: $start,
            time_target_increment_min: $incrmin,
            time_target_add: $addamt
        },
        cache: false,
        success: function (response) {
            loadViewTimes(promoId,$("#promotion-view-modal").data('property-id'));
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });

}