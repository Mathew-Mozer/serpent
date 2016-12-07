/**
 * This file adds new promotion tiles.
 */

/**
 * This adds a new tile to the tile view with the proper image
 * @param data
 */
var addPromotion = function (data) {
    data['append_promotion'] = true;
    $.ajax({
        url: 'views/promotionview.php',
        type: 'post',
        data: data,
        cache: false,
        success: function (html) {
            $("#promotion-list-" + data['property_id']).append(html);
            $("#tile-" + data['promo_id']).unbind('click').click(tileBodyClick);
            $("#tile-" + data['promo_id'] + " div div.settingsBtn").unbind('click').click(settingsButtonClick);

            $("#tile-" + data['promo_id'] + " div.tile-menu-item").hover(highlightCurrentOption, dehighlightCurrentOption);
            $("#tile-" + data['promo_id']).hover(showOptionsBar, hideOptionsBar);
            $("#tile-" + data['promo_id']).tooltip();
        }
    });
};


/**
 * Construct the modal
 * @type {any}
 */
var addPromotionModal = $("#addPromotion").dialog({
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    position: 'center',
    modal: true
});

$("div.addPromotion").on('click', function (e) {

    e.preventDefault();
    $("#promotion-details").data("promotion-id", $(this).data('promotion-id'));
    promotionName = $(this).data('promotion-name');
    $("#promotion-select").hide();
    $("#promotion-details").show();
    $("#promotion-details").load("views/addpromotionviews/add" + promotionName + "view.php");
    $('#add-promotion-buttons').append("<button type='button' id='next-page'>Next</button>");

    $('#next-page').click(function () {
        templatePrompt();
    });
});

var templatePrompt = function () {
    $('#promotion-details').hide();
    $('#add-promotion-buttons').empty();
    $('#create-template').load("views/createtemplateview.php");

    $('#add-promotion-buttons').append(
        "<button type='button' id='create-template-btn'>Save Template</button>" +
        "<br><br>" +
        "<button type='button' id='create-promotion-btn'>Create Promotion</button>");

    $('#create-template-btn').click(function () {
        $('#add-promotion-buttons').empty();
        $('#add-promotion-buttons').append(
            "<button type='button' id='save-template-btn'>Save Template</button>");
        $('#template-prompt').hide();
        $('#template-data').show();

        $('#save-template-btn').click(function () {
           saveTemplate();
        });
    });

    $('#create-promotion-btn').click(function () {
        var promotionTypeId = $("#promotion-details").data("promotion-id");
        var propertyId = $('input[name=propertyId]').val();
        var promotionType = $('input[name=promotionType]').val();
        var accountId = 1;
        $("#promotion-details").hide();
        addPromotionByType(propertyId, promotionTypeId, promotionType, accountId);
    });
};