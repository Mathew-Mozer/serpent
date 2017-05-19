/**
 * This file contains functions to create and update High Hand promotions
 */

$('#new-hand').hide();

console.log('Loaded Highhand.js');
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
$('#player-name-modal').bind("enterKey",function(e){
});
$('#hhname').on('keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        updatePromotion($("#promotion-view-modal").data('promo-id'));
        $("#promotion-view-modal").dialog('close');
        return false;
    }
});
/**
 * Update the database with the selected high hand
 * @param promotionId
 */
var updatePromotion = function (promotionId) {
    if($('#new-hand').is(":visible")) {


        console.log('Updating now');
        var name = $('#player-name-modal').val();

        $.ajax({

            url: 'controllers/promotioncontrollers/highhandcontroller.php',
            type: 'post',
            data: {
                action: 'update',
                promotionId: promotionId,
                name: name,
                cards: cards
            },
            cache: false,
            success: function () {

            }


        });
    }else{
        console.log('didn\'t update hand');
    }
};

/**
 * Get the user selected card ID
 * @type {Array}
 */

var cards = ['CB', 'CB', 'CB', 'CB', 'CB', 'CB', 'CB', 'CB'];
var handIndex = 0;
function addCards(clicked_id) {

    console.log(handIndex);

    if (handIndex < (cardcount) && clicked_id.indexOf("hh_index") < 0) {

        cards[handIndex] = clicked_id;
        lockInCard(clicked_id);

    } else if (handIndex >= (cardcount) && clicked_id.indexOf("hh_index") < 0) {
        handIndex = 0;
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

$(".selected-card").click(function () {
    //flagUsedCard(this.id);
    addCards(this.id);
});

/**
 * Highlight the card that will be modified
 * @param clicked_id
 */
function moveHighlightToNextCard(clicked_id) {
    if (handIndex < (cardcount+1)) {
        $("#hh_index" + (handIndex)).addClass("card-index-highlight");
    } else if (handIndex >= (cardcount+1)) {
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
    $('#high_hand_hands').empty();
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
                var date = new Date(element.high_hand_timestamp+' UTC');
                var dts = date.toLocaleString().split(",");
                var handDate = dts[1] + "</br>" + dts[0];
                var isWinner = element.high_hand_isWinner;
                payout = element.high_hand_custom_payout;

                if(payout == 0){
                    payout = element.payout_value;
                }


                var html = "";
                html+='<tr><td class="no-mobile">' + handID + '</td>';
                html+='<td class="no-mobile">' + handDate + '</td>';
                html+='<td>' + handName + "<div id='currentStatus-"+handID+"'></div></td>";

                html+='<td width="500px">';
                for(card=1;card < cardcount+1;card++){
                    html+='' + "<img class='card standard-card' id='handCards"+card+"-"+handID+"'>"
                }
                //html+='' + "<img class='card standard-card' id='handCards1-"+handID+"'>" + '';
                //html+='' + "<img class='card standard-card' id='handCards2-"+handID+"'>" + '';
                //html+='' + "<img class='card standard-card' id='handCards3-"+handID+"'>" + '';
                //html+='' + "<img class='card standard-card' id='handCards4-"+handID+"'>" + '';
                //html+='' + "<img class='card standard-card' id='handCards5-"+handID+"'>" + '';
                //html+='' + "<img class='card standard-card' id='handCards6-"+handID+"'>" + '';
                //html+='' + "<img class='card standard-card' id='handCards7-"+handID+"'>" + '';
                //html+='' + "<img class='card standard-card' id='handCards8-"+handID+"'>"
                html+='</td>';

                html+="<td> <button class='to-winner' id='set-to-winner-" + handID + "' name='"+handID+"'  type='button'>Winner</button>"+
                    "<button class='to-pending' id='set-to-pending-" + handID + "' name='"+handID+"'  type='button'>Pending</button>"+
                    "<button class='to-last' id='set-to-last-" + handID + "' name='"+handID+"'  type='button'>Last Hand</button>"+
                    "<button class='to-delete' id='delete-last-" + handID + "' name='"+handID+"'  type='button'>Delete Hand</button></td>";

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
                updateHandStatus(1,payout,this.name,id);
                updateCurrentStatus(this.name,1);
            });

            $('.to-pending').click(function() {
                updateHandStatus(0,0,this.name,id);
                updateCurrentStatus(this.name,0);

            });

            $('.to-last').click(function() {
                updateHandStatus(2,0,this.name,id);
                updateCurrentStatus(this.name,2);
            });
            $('.to-delete').click(function() {
                var tmp = confirm("Delete Current Hand?");
                if(tmp){
                    deleteHand(this.name,id);
                    RemoveHand(this);
                }

            });

            $(document).ready(function() {
                $('#high_hand_table').DataTable( {
                    "order": [[ 0, "desc" ]],
                    "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
                    "bLengthChange" : false,
                    "columnDefs": [
                        { "width": "20%", "targets": 0 }
                    ]
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
var loadViewHands = function () {
    $('#view-hands').load("views/displaypromotionviews/highhandviewhands.php", {propertyId: this.id});
}

$(document).on("click", "#create-new-hand", function () {
    console.log('create new hand');
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
$(document).on("click", "#Delete-hands-btn",function () {
    $promoid = $("#promotion-view-modal").data('promo-id');
    $.ajax({

        url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        data: {
            action: 'archiveHands',
            promotionId:$promoid
        },
        cache: false,
        success: function () {
            $("#promotion-view-modal").dialog('close');
        }


    });
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

var updateHandStatus = function (isWinner, payout, handId,id) {

    $.ajax({

        url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        data: {
            action: 'updateHand',
            isWinner: isWinner,
            payout: payout,
            handId: handId,
            promotionId:id
        },
        cache: false,
        success: function () {
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });
};
var deleteHand = function (handId,id) {

    $.ajax({

        url: 'controllers/promotioncontrollers/highhandcontroller.php',
        type: 'post',
        data: {
            action: 'deleteHand',
            handId: handId,
            promotionId:id
        },
        cache: false,
        success: function () {
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });
};

var RemoveHand = function (handID) {
    $(handID).parent().parent().empty();

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