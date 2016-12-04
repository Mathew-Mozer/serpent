/**
 * This file contains functions to create and update High Hand promotions
 */

$('#new-hand').hide();

/**
 * Delete this
 */
var getTemplate = function () {
    $.ajax({
        url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        data: {
            action: 'template',
        },
        cache: false,
        success: function (response) {
            $('#title-message-modal').attr('value', response.title_message);
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
var updatePromotion = function (promotionId) {

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
        success: function (response) {

        }
    });
};

/**
 * Get the user selected card ID
 * @type {Array}
 */

var cards = ['CB', 'CB', 'CB', 'CB', 'CB', 'CB', 'CB', 'CB'];
var handIndex = 1;
function addCards(clicked_id) {

    if (handIndex < 9) {
        cards[handIndex] = clicked_id;


    } else if (handIndex >= 9) {
        handIndex = 1;
        addCards(clicked_id);
        return;
    }

    $("#hh_index" + handIndex).removeClass("card-index-highlight");
    $("#hh_index" + handIndex).attr('src', 'dependencies/images/cards/' + clicked_id + ".png");
    handIndex++;
    moveHighlightToNextCard(clicked_id);
}

/**
 * Lock used card so duplicates can't be used
 * @param clicked_id
 */
function flagUsedCard(clicked_id) {

    $("#" + clicked_id).attr('src', 'dependencies/images/cards/CB.png');
}

$(".card").click(function () {
    //flagUsedCard(this.id);
    addCards(this.id);
});

/**
 * Highlight the card that will be modified
 * @param clicked_id
 */
function moveHighlightToNextCard(clicked_id) {
    if (handIndex < 9) {
        $("#hh_index" + (handIndex)).addClass("card-index-highlight");
    } else if (handIndex >= 9) {
        $("#hh_index1").addClass("card-index-highlight");
    }
}

/**
 * Delete this
 */
var getTemplate = function () {
    $.ajax({
        url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        data: {
            action: 'template'
        },
        cache: false,
        success: function (response) {
            $('#title-message').attr('value', response.title_message);
            $('#horn-timer').attr('value', response.horn_timer);
            $('#payout-value').attr('value', response.payout_value);
            $('#session-timer').attr('value', response.session_timer);
            $('#scene-type').attr('value', 2);
            $('#multiple-hands').attr('value', response.multiple_hand);
            $('#use-joker').prop('checked', response.use_joker);
            $('#high-hand').prop('checked', response.high_hand_gold);

        }
    });
};

/**
 * This gets all hands assigned to a high hand promotion
 * @type {boolean}
 */
var customPayout = false;
var getAllHands = function (id) {
    $.ajax({
        url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        data: {
            action: 'view',
            highHandSession: id
        },
        cache: false,
        success: function (response) {
            console.log(response);
            $.each(response, function (index, element) {
                var promotionID = element.high_hand_session;
                var handID = element.high_hand_record_id;
                var handCards1 = element.high_hand_card1;
                var handCards2 = element.high_hand_card2;
                var handCards3 = element.high_hand_card3;
                var handCards4 = element.high_hand_card4;
                var handCards5 = element.high_hand_card5;
                var handCards6 = element.high_hand_card6;
                var handCards7 = element.high_hand_card7;
                var handCards8 = element.high_hand_card8;
                var handName = element.high_hand_name;
                var handDate = element.high_hand_timestamp;
                var handWinner = element.high_hand_isWinner;
                customPayout = element.high_hand_custom_payout;

                $('#high_hand_table > tbody:last-child').append('<tr>');
                $('#high_hand_table > tbody:last-child').append('<td>' + handID + '</td>');
                $('#high_hand_table > tbody:last-child').append('<td>' + handDate + '</td>');
                $('#high_hand_table > tbody:last-child').append('<td>' + handName + '</td>');
                $('#high_hand_table > tbody:last-child').append('<td>' + handCards1 + '</td>');
                $('#high_hand_table > tbody:last-child').append('<td>' + handCards2 + '</td>');
                $('#high_hand_table > tbody:last-child').append('<td>' + handCards3 + '</td>');
                $('#high_hand_table > tbody:last-child').append('<td>' + handCards4 + '</td>');
                $('#high_hand_table > tbody:last-child').append('<td>' + handCards5 + '</td>');
                $('#high_hand_table > tbody:last-child').append('<td>' + handCards6 + '</td>');
                $('#high_hand_table > tbody:last-child').append('<td>' + handCards7 + '</td>');
                $('#high_hand_table > tbody:last-child').append('<td>' + handCards8 + '</td>');
                $('#high_hand_table > tbody:last-child').append('<td> <input class="is-winner-checkbox" ' +
                    'id="is-winner-' + promotionID + '" name="is-winner" type="checkbox"></td>');

                $('#high_hand_table > tbody:last-child ').append('</tr>');

                if (handWinner == 1) {
                    $('#is-winner-' + promotionID).prop('checked', true);
                }
            });

            $("#high_hand_table").DataTable();

        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);

        }
    });
};

/**
 * This toggles the view to create hand inside an update high hand modal
 */
$('#create-new-hand').click(function () {
    $('#view-hands').hide();
    $('#new-hand').show();
});

/**
 * This toggles the view to view hand in an update high hand modal
 */
$('#view-hands-btn').click(function () {
    $('#new-hand').hide();
    $('#view-hands').show();
});