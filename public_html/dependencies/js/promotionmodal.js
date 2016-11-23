var promotionViewModal = $("#promotion-view-modal").dialog({
    autoOpen: false,
    height: 800,
    width: 850,
    modal: true,
    cache: false,
    buttons: {
        Update: function () {

            updatePromotion($("#promotion-view-modal").data('promo-id'),$("#promotion-view-modal").data('promo-type-id'),1);
            $("#promotion-view-modal").dialog('close');
          }
        }
    });
