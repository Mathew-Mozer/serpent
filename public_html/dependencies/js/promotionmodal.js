/**
 * This file defines the update promotion modal
 */

/**
 * Create the update promotion modal
 * @type {any}
 */
var promotionViewModal = $("#promotion-view-modal").dialog({
    autoOpen: false,
        height: '800',
    width: '900',
    modal: true,
    cache: false,
    position: 'center',
    buttons: {
        Update: function () {
            console.log("update promotion");
            updatePromotion($("#promotion-view-modal").data('promo-id'),$("#promotion-view-modal").data('promo-type-id'),1);
            $("#promotion-view-modal").dialog('close');
          }
        }
    });
var updateCurrentPromotion = function(){

};