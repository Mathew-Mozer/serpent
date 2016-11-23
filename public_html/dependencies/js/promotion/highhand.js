var addPromotionByType = function(casinoId, promotionId) {
    var titleMessage = $('input[name=title-message]').val();
    var useJoker = $('input[name=use-joker]').prop('checked');
    var highHandGold = $('input[name=high-hand-gold]').prop('checked');
    var hornTimer = $('input[name=horn-timer]').val();
    var payoutValue = $('input[name=payout-value]').val();
    var sessionTimer = $('input[name=session-timer]').val();
    var multipleHands = $("input:radio[name='multiple-hands']:checked").val();
    var sceneType = $('input[name=scene-type]').val();
    var template = $('input[name=template]').prop('checked');
    alert(template);
    $.ajax({
        url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        cache: false,
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
            multipleHands: multipleHands,
            sceneType : sceneType,
            isTemplate : template
        },
        success: function(response) {
            //update view with new promotion
            if(template != true){
                addPromotion(response.image, casinoId);
            }
            addPromotionModal.dialog('close');
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

var getHighHandData = function(promotionId) {
    $.ajax({
        url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        data: {
            action: 'read',
            promotionId: promotionId
        },
        cache: false,
        success: function (response) {
            $('#title-message-modal').attr('value',response.title_message);
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

var getTemplate = function() {
    $.ajax({
       url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        data: {
            action: 'template',
        },
        cache: false,
        success: function (response) {
            $('#title-message').attr('value',response.title_message);
            $('#horn-timer').attr('value',response.horn_timer);
            $('#payout-value').attr('value',response.payout_value);
            $('#session-timer').attr('value',response.session_timer);
            $('#scene-type').attr('value',2);
            $('#multiple-hands').attr('value',response.multiple_hand);
            $('#use-joker').prop('checked', response.use_joker);
            $('#high-hand').prop('checked',response.high_hand_gold);

        }
    });
};