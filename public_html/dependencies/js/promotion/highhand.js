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
