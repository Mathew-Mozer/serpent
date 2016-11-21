var addPromotionByType = function(casinoId, promotionId) {
    var titleMessage = $('input[name=title-message]').val();
    var useJoker = $('input[name=use-joker]').prop('checked');
    var highHandGold = $('input[name=high-hand-gold]').prop('checked');
    var hornTimer = $('input[name=horn-timer]').val();
    var payoutValue = $('input[name=payout-value]').val();
    var sessionTimer = $('input[name=session-timer]').val();
    var multipleHands = $("input:radio[name='multiple-hands']:checked").val();
    $.ajax({
        url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        data: {
            action: 'add',
            casinoId: casinoId,
            promotionId: promotionId,
            titleMessage: titleMessage,
            useJoker: useJoker,
            highHandGold: highHandGold,
            hornTimer: hornTimer,
            payoutValue: payoutValue,
            sessionTimer: sessionTimer,
            multipleHands: multipleHands
        },
        cache: false,
        success: function(response) {
            //update view with new promotion
            addPromotion(response.image, casinoId);
            addPromotionModal.dialog('close');
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};