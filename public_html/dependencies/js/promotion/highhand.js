var addPromotionByType = function(casinoId, promotionId) {
    var titleMessage = $('input[name=title-message]').val();
    var useJoker = $('input[name=use-joker]').prop('checked');
    var highHandGold = $('input[name=high-hand-gold]').prop('checked');
    var hornTimer = $('input[name=horn-timer]').val();
    var payoutValue = $('input[name=payout-value]').val();
    var sessionTimer = $('input[name=session-timer]').val();
    var multipleHands = $("input:radio[name='multiple-hands']:checked").val();
    var sceneType = $('input[name=scene-type]').val();
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
            sceneType : sceneType
        },
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
            $('#use-joker-modal').prop('checked', response.use_joker);
            $('#high-hand-gold-modal').prop('checked',response.high_hand_gold);

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

        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
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