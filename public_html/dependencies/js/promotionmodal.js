/**
 * This file defines the update promotion modal
 */

/**
 * Create the update promotion modal
 * @type {any}
 */
var promotionViewModal = $("#promotion-view-modal").dialog({
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    modal: true,
    cache: false,
    position: 'center',
    buttons: {
        Update: function () {

            updatePromotion($("#promotion-view-modal").data('promo-id'),$("#promotion-view-modal").data('promo-type-id'),1);
            $("#promotion-view-modal").dialog('close');
          }
        }
    });
