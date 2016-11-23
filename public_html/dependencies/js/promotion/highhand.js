// var addPromotionByType = function(casinoId, promotionId) {
//     var titleMessage = $('input[name=title-message]').val();
//     var useJoker = $('input[name=use-joker]').prop('checked');
//     var highHandGold = $('input[name=high-hand-gold]').prop('checked');
//     var hornTimer = $('input[name=horn-timer]').val();
//     var payoutValue = $('input[name=payout-value]').val();
//     var sessionTimer = $('input[name=session-timer]').val();
//     var multipleHands = $("input:radio[name='multiple-hands']:checked").val();
//     var sceneType = $('input[name=scene-type]').val();
//     $.ajax({
//         url: 'controllers/promotioncontrollers/highhandcontroller.php',
//         type: 'post',
//         cache: false,
//         data: {
//             action: 'add',
//             casinoId: casinoId,
//             promotionId: promotionId,
//             titleMessage: titleMessage,
//             useJoker: useJoker,
//             highHandGold: highHandGold,
//             hornTimer: hornTimer,
//             payoutValue: payoutValue,
//             sessionTimer: sessionTimer,
//             multipleHands: multipleHands,
//             sceneType : sceneType
//         },
//         success: function(response) {
//             //update view with new promotion
//             addPromotion(response.image, casinoId);
//             addPromotionModal.dialog('close');
//         },
//         error: function(xhr, desc, err) {
//             console.log(xhr + "\n" + err);
//         }
//     });
// };

// var getHighHandData = function(promotionId) {
//     $.ajax({
//         url: 'controllers/promotioncontrollers/highhandcontroller.php',
//         type: 'post',
//         data: {
//             action: 'read',
//             promotionId: promotionId
//         },
//         cache: false,
//         success: function (response) {
//             $('#title-message-modal').attr('value',response.title_message);
//             $('#use-joker-modal').prop('checked', response.use_joker);
//             $('#high-hand-gold-modal').prop('checked',response.high_hand_gold);
//
//         },
//         error: function (xhr, desc, err) {
//             console.log(xhr + "\n" + err);
//         }
//     });
// };



// var updatePromotion = function(promotionId){
//     var name = $('#name-modal').val();
//    // var cards = $('#chosen-number-modal').val();
//
//     $.ajax({
//         url: 'controllers/promotioncontrollers/highhandcontroller.php',
//         type: 'post',
//         data: {
//             action: 'update',
//             promotionId: promotionId,
//             name: name
//         },
//         cache: false,
//         success: function(response) {
//
//         },
//         error: function(xhr, desc, err) {
//             console.log(xhr + "\n" + err);
//         }
//     });
// };

/**
 * Get the user selected card ID
 * @type {Array}
 */
var cards = [];
var handIndex = 0;
var addCards = function(clicked_id){
    if(handIndex > 8) {
        cards[handIndex] = clicked_id
        alert(handIndex);
    }
    handIndex++;
}
