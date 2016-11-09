var promotionViewModal = $("#promotion-view-modal").dialog({
    autoOpen: false,
    height: 400,
    width: 350,
    modal: true,
    buttons: {
        Update: function () {
            updatePromotion($("#promotion-view-modal").data('promo-id'));
            $("#promotion-view-modal").dialog('close');
          }
        }
    });
