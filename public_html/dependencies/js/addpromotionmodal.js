//Adds a new tile to the view with the image that is passed into the function
var addPromotion = function (image, propertyId) {
    $('#promotion-list-' + propertyId).append(
        '<div class="tile-body">' +
        '<img class="tile-icon" src="dependencies/images/' + image + '">' +
        '<div class="tile-menu-bar hidden">' +
        '<div class="tile-menu-item settingsBtn">' +
        '<span class="glyphicon glyphicon-cog glyphicon-menu black" aria-hidden="true"></span>' +
        '</div>' +
        '<div class="tile-menu-item">' +
        '<span class="glyphicon glyphicon-pause glyphicon-menu black" aria-hidden="true"></span>' +
        '</div>' +
        '<div class="tile-menu-item">' +
        '<span class="glyphicon glyphicon-user glyphicon-menu black" aria-hidden="true"></span>' +
        '</div>' +
        '</div>' +
        '</div>'
    );
};


//Construct the add promotion modal
var addPromotionModal = $("#addPromotion").dialog({
    autoOpen: false,
    height: 400,
    width: 350,
    modal: true,
    buttons: {
        Submit: function () {
            var promotionId = $('select[name=promoId]').val();
            var propertyId = $('input[name=propertyId]').val();
            $("#promotion-select").show();
            $("#promotion-details").hide();
            addPromotionByType(propertyId, currentPromotionType);
        }
    }
});
