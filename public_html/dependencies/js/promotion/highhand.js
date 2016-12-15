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

    console.log(clicked_id.indexOf("hh_index"));

    if (handIndex < 9 && clicked_id.indexOf("hh_index") < 0) {

        cards[handIndex] = clicked_id;
        lockInCard(clicked_id);

    } else if (handIndex >= 9 && clicked_id.indexOf("hh_index") < 0) {
        handIndex = 1;
        addCards(clicked_id);
        //lockInCard(clicked_id);

    } else if(clicked_id.indexOf("hh_index") == 0){
        setSelectionIndex(clicked_id);
    }


}

/**
 * Set the current card selection
 * @param clicked_id
 */
function lockInCard(clicked_id){
        $("#hh_index" + handIndex).removeClass("card-index-highlight");
        $("#hh_index" + handIndex).attr('src', 'dependencies/images/cards/' + clicked_id + ".png");
        handIndex++;
        moveHighlightToNextCard(clicked_id);
    }

/**
 * Select the card index that was clicked on
 * @param clicked_id
 */
function setSelectionIndex(clicked_id){
    $("#hh_index" + handIndex).removeClass("card-index-highlight");
        handIndex = clicked_id.substr(clicked_id.length - 1);
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
var payout;
var handID;
/**
 * This gets all hands assigned to a high hand promotion
 * @type {boolean}
 */
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

            $.each(response, function (index, element) {
                handID = element.high_hand_record_id;
                var handCards1 = 'dependencies/images/cards/'+element.high_hand_card1+'.png';
                var handCards2 = 'dependencies/images/cards/'+element.high_hand_card2+'.png';
                var handCards3 = 'dependencies/images/cards/'+element.high_hand_card3+'.png';
                var handCards4 = 'dependencies/images/cards/'+element.high_hand_card4+'.png';
                var handCards5 = 'dependencies/images/cards/'+element.high_hand_card5+'.png';
                var handCards6 = 'dependencies/images/cards/'+element.high_hand_card6+'.png';
                var handCards7 = 'dependencies/images/cards/'+element.high_hand_card7+'.png';
                var handCards8 = 'dependencies/images/cards/'+element.high_hand_card8+'.png';
                var handName = element.high_hand_name;
                var handDate = element.high_hand_timestamp;
                var isWinner = element.high_hand_isWinner;
                payout = element.high_hand_custom_payout;

                if(payout == 0){
                    payout = element.payout_value;
                }


                var html = "";
                html+='<tr><td>' + handID + '</td>';
                html+='<td>' + handDate + '</td>';
                html+='<td>' + handName + "<div id='currentStatus-"+handID+"'></div></td>";

                html+='<td>' + "<img class='card standard-card' id='handCards1-"+handID+"'>" + '';
                html+='' + "<img class='card standard-card' id='handCards2-"+handID+"'>" + '';
                html+='' + "<img class='card standard-card' id='handCards3-"+handID+"'>" + '';
                html+='' + "<img class='card standard-card' id='handCards4-"+handID+"'>" + '';
                html+='' + "<img class='card standard-card' id='handCards5-"+handID+"'>" + '';
                html+='' + "<img class='card standard-card' id='handCards6-"+handID+"'>" + '';
                html+='' + "<img class='card standard-card' id='handCards7-"+handID+"'>" + '';
                html+='' + "<img class='card standard-card' id='handCards8-"+handID+"'>" + '</td>';

                html+="<td> <button class='to-winner' id='set-to-winner-" + handID + "' name='"+handID+"'  type='button'>Winner</button>"+
                    "<button class='to-pending' id='set-to-pending-" + handID + "' name='"+handID+"'  type='button'>Pending</button>"+
                    "<button class='to-last' id='set-to-last-" + handID + "' name='"+handID+"'  type='button'>Last Hand</button></td>";

                $('#high_hand_table > tbody:last-child ').append(html);
                updateCurrentStatus(handID,isWinner);
                $('#handCards1-'+handID).attr('src',handCards1);
                $('#handCards2-'+handID).attr('src',handCards2);
                $('#handCards3-'+handID).attr('src',handCards3);
                $('#handCards4-'+handID).attr('src',handCards4);
                $('#handCards5-'+handID).attr('src',handCards5);
                $('#handCards6-'+handID).attr('src',handCards6);
                $('#handCards7-'+handID).attr('src',handCards7);
                $('#handCards8-'+handID).attr('src',handCards8);

            });
            $('.to-winner').click(function() {
                updateHandStatus(1,payout,this.name);
                updateCurrentStatus(this.name,1);
            });

            $('.to-pending').click(function() {
                updateHandStatus(0,0,this.name);
                updateCurrentStatus(this.name,0);

            });

            $('.to-last').click(function() {
                updateHandStatus(2,0,this.name);
                updateCurrentStatus(this.name,2);
            });

            $(document).ready(function() {
                $('#high_hand_table').DataTable( {
                    "order": [[ 0, "desc" ]],
                    "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
                    "bLengthChange" : false
                } );
            } );

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

$('#hr').click(function(){
    $('#hr-option').show();
});

$('#15').click(function() {
    $('#hr-option').hide();
});

$('#30').click(function() {
    $('#hr-option').hide();
});

var updateHandStatus = function (isWinner, payout, handId) {
    $.ajax({
        url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        data: {
            action: 'updateHand',
            isWinner: isWinner,
            payout: payout,
            handId: handId
        },
        cache: false,
        success: function () {
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

var updateCurrentStatus = function (handID,isWinner) {
    $('#currentStatus-'+handID).empty();
    if(isWinner == 0){
        status = 'Pending';
        classattr = 'pending-status';
    } else if (isWinner == 1) {
        status = 'Winner';
        classattr = 'winning-status';
    } else {
        status = 'Last Hand';
        classattr = 'last-hand-status';
    }

    $('#currentStatus-'+handID).append('<div>'+status+'</div>');
    $('#currentStatus-'+handID).attr('class',classattr);
};