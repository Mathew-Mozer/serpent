/**
 * This file defines the update promotion modal
 */

/**
 * Create the update promotion modal
 * @type {any}
 */
//height: $( window ).height()-($( window ).height()*.10),
  //  width: $( window ).width()-($( window ).width()*.10),
var promotionViewModal = $("#promotion-view-modal").dialog({
        position: 'center',
        resizable: false,
    buttons: {
        Update: function () {
            console.log("update promotion");
            updatePromotion($("#promotion-view-modal").data('promo-id'),$("#promotion-view-modal").data('promo-type-id'),1);
            $("#promotion-view-modal").dialog('close');
          }
        },
    close: function( event, ui ) {
        $(".ui-dialog-buttonset").toggle(true);
    },
    open: function (event,ui) {
        
    }

    });
var updateCurrentPromotion = function(){

};