//Adds a new tile to the view with the image that is passed into the function
var addPromotion = function (data) {
    data['append_promotion']=true;
    $.ajax({
        url: 'views/promotionview.php',
        type:'post',
        data:data,
        cache:false,
        success: function(html) {
            $("#promotion-list-" + data['property_id']).append(html);
            $("#tile-"+data['promo_id']).unbind('click').click(tileBodyClick);
            $("#tile-"+data['promo_id'] + " div div.settingsBtn").unbind('click').click(settingsButtonClick);

            $("#tile-"+data['promo_id'] + " div.tile-menu-item").hover(highlightCurrentOption, dehighlightCurrentOption);
            $("#tile-"+data['promo_id']).hover(showOptionsBar,hideOptionsBar);
            $("#tile-"+data['promo_id']).tooltip();
        }
    });
};


//Construct the add promotion modal
var addPromotionModal = $("#addPromotion").dialog({
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    position: 'center',
    modal: true,
    buttons: {
        Submit: function () {
            var promotionTypeId = $("#promotion-details").data("promotion-id");
            var propertyId = $('input[name=propertyId]').val();
            var promotionType = $('input[name=promotionType]').val();

          
            var accountId = 1;
            $("#promotion-select").show();
            $("#promotion-details").hide();
            addPromotionByType(propertyId, promotionTypeId, promotionType, accountId);
        }
    }
});
