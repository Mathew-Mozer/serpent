/**
 * Created by Mathew on 1/16/2017.
 */
console.log('loaded timetracker.js');
var loadViewTimes = function (promoid) {
    $('#timetrackerbody').load("views/displaypromotionviews/timetrackerlist.php", {promoid: promoid});
}

$(document).on("click", ".add-new-timetarget", function () {
    addNewTimeTarget($("#promotion-view-modal").data('promo-id'));
});
$(document).on("click", ".time-table-confirm", function () {
    TimeTargetUpdate($("#promotion-view-modal").data('promo-id'), 0,$(this).attr('data-target-id'),0);
});
$(document).on("click", ".time-table-end", function () {
    TimeTargetUpdate($("#promotion-view-modal").data('promo-id'), 1,$(this).attr('data-target-id'),1);
});
$(document).on("click", ".time-table-unconfirm", function () {
    TimeTargetUpdate($("#promotion-view-modal").data('promo-id'), 1,$(this).attr('data-target-id'),0);
});
$(document).on("click", ".time-table-archive", function () {
    TimeTargetUpdate($("#promotion-view-modal").data('promo-id'), 2,$(this).attr('data-target-id'),0);
});

var TimeTargetUpdate = function (promoId, action,timeTargetId,endTimeTarget) {
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
    $.ajax({
        url: 'controllers/promotioncontrollers/timetargetcontroller.php',
        type: 'post',
        data: {
            action: $action,
            promotionId: promoId,
            timeTargetId: timeTargetId,
            endTime:endTimeTarget
        },
        cache: false,
        success: function (response) {
            loadViewTimes(promoId);
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
    console.log($start);
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
            loadViewTimes(promoId);
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });
}