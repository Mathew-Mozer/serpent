var getTemplate = function() {
    $.ajax({
       url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        data: {
            action: 'template',
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

/**
 * Update the database with the selected high hand
 * @param promotionId
 */
var updatePromotion = function(promotionId){

    var name = $('#player-name-modal').val();


    $.ajax({
        url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        data: {
            action: 'update',
            promotionId: promotionId,
            name: name,
            card1: cards[1],
            card2: cards[2],
            card3: cards[3],
            card4: cards[4],
            card5: cards[5],
            card6: cards[6],
            card7: cards[7],
            card8: cards[8]
        },
        cache: false,
        success: function(response) {

        }
    });
};

/**
 * Get the user selected card ID
 * @type {Array}
 */

var cards = ['CB', 'CB', 'CB', 'CB', 'CB', 'CB', 'CB', 'CB'];
var handIndex = 1;
function addCards(clicked_id){

    if(handIndex < 9) {
        cards[handIndex] = clicked_id;


    }else if(handIndex >= 9){
        handIndex = 1;
        addCards(clicked_id);
        return;
    }

    $("#hh_index" + handIndex).removeClass("card-index-highlight");
    $("#hh_index" + handIndex).attr('src', 'dependencies/images/cards/' + clicked_id +".png");
    handIndex++;
    moveHighlightToNextCard(clicked_id);
}

/**
 * Lock used card so duplicates can't be used
 * @param clicked_id
 */
function flagUsedCard(clicked_id){

    $("#" + clicked_id).attr('src', 'dependencies/images/cards/CB.png');
}

$(".card" ).click(function() {
    //flagUsedCard(this.id);
    addCards(this.id);
});

/**
 * Highlight the card that will be modified
 * @param clicked_id
 */
function moveHighlightToNextCard(clicked_id){
    if(handIndex < 9){
        $("#hh_index" + (handIndex)).addClass("card-index-highlight");
    }else if(handIndex >= 9){
        $("#hh_index1").addClass("card-index-highlight");
    }
}

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
