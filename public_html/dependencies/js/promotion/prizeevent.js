/**
 * Created by Mathew on 1/16/2017.
 */
console.log('loaded PrizeWinners.js');
var loadPrizeWinners = function (promoid) {
    $('#prizeeventbody').load("views/displaypromotionviews/prizeeventlist.php", {promoid: promoid});

}

$(document).on("click", ".add-new-prize-event", function () {
    addNewPrizeEvent($("#promotion-view-modal").data('promo-id'));
});
$(document).on("click", ".cancel-new-prize-event", function () {
    resetUpdate();
});
$(document).on("click", ".delete-prize-event", function () {
    if (confirm("Are you sure you want to delete?")) {
        DeletePrizeEventWinner($("#promotion-view-modal").data('promo-id'),$(this).data('id'));
    }
    return false;

});

var resetUpdate = function () {
    loadPrizeWinners($("#promotion-view-modal").data('promo-id'));
    $('#curID').val('');
    $('#pew_name').val('');
    $('#pew_prize').val('');
    $('#pew_right_icon').val('None');
    $('#pew_left_icon').val('None');
    $('#pew_type').val('');
    $('.add-new-prize-event').val('Add');
}
$(document).on("click", ".edit-new-prize-event", function () {
    $('#curID').val($(this).data('id'));
    $('#pew_name').val($(this).data('name'));
    $('#pew_prize').val($(this).data('prize'));
    $('#pew_right_icon').val($(this).data('right-icon'));
    $('#pew_left_icon').val($(this).data('left-icon'));
    $('#pew_type').val($(this).data('ptype'));
    $('.add-new-prize-event').text('Update');
    $(this).parent().parent().css('background-color', '#7ba6ed');
});

var DeletePrizeEventWinner = function (promoId,$id) {

    console.log('should have deleted: ' + $id);

    $.ajax({
        url: 'controllers/promotioncontrollers/prizeeventcontroller.php',
        type: 'post',
        data: {
            action: 'DeletePrizeEventWinner',
            promotionId: promoId,
            prize_event_winner_id: $id
        },
        cache: false,
        success: function (response) {
            resetUpdate();
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });
}
var addNewPrizeEvent = function (promoId) {
    $id = $('#curID').val();
    $name = $('#pew_name').val();
    $prize = $('#pew_prize').val();
    $righticon = $('#pew_right_icon').val();
    $lefticon = $('#pew_left_icon').val();
    $prizetype = $('#pew_type').val();
    $.ajax({
        url: 'controllers/promotioncontrollers/prizeeventcontroller.php',
        type: 'post',
        data: {
            action: 'addPrizeEventWinner',
            promotionId: promoId,
            prize_event_winner_id: $id,
            prize_event_winner_name: $name,
            prize_event_winner_prize: $prize,
            prize_event_winner_type: $prizetype,
            prize_event_winner_right: $righticon,
            prize_event_winner_left: $lefticon
        },
        cache: false,
        success: function (response) {
            resetUpdate();
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });
}