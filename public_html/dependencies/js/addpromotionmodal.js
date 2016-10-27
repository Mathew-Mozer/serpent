
//Adds a new tile to the view with the image that is passed into the function
var addPromotion = function (image, casinoId) {
        $('#promotion-list-' + casinoId).append(
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
            var casinoId = $('input[name=casinoId]').val();
            //Ajax call to update database with new promotion
            $.ajax({
                url: 'controllers/addpromotioncontroller.php',
                type: 'post',
                data: {casinoId: casinoId, promotionId: promotionId},
                cache: false,
                success: function (response) {
                    console.log(response);

                    //update view with new promotion
                    addPromotion(response.image, casinoId);
                    addPromotionModal.dialog('close');
                },
                error: function (xhr, desc, err) {
                    console.log(xhr + "\n" + err);
                }
            });
        }
    }
});