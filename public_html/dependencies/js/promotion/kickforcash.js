var addPromotionByType = function(casinoId, promotionId) {
    var cashPrize = $('input[name=cash-prize]').val();
    var targetNumber = $('input[name=target-number]').val();
    $.ajax({
        url: 'controllers/promotioncontrollers/kickforcashcontroller.php',
        type: 'post',
        data: {
            action: 'add',
            casinoId: casinoId,
            promotionId: promotionId,
            cashPrize: cashPrize,
            targetNumber: targetNumber
        },
        cache: false,
        success: function(response) {
            console.log(response);

            //update view with new promotion
            addPromotion(response.image, casinoId);
            addPromotionModal.dialog('close');
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};
