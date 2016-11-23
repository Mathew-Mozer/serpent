var promotionViewModal = $("#promotion-view-modal").dialog({
    autoOpen: false,
    height: 800,
    width: 850,
    modal: true,
    cache: false,
    buttons: {
        Update: function () {
          alert($("#promotion-view-modal").data('promo-id')+" "+$("#promotion-view-modal").data('promo-type-id'))
            updatePromotion($("#promotion-view-modal").data('promo-id'),$("#promotion-view-modal").data('promo-type-id'),0);
            $("#promotion-view-modal").dialog('close');
          }
        }
    });
