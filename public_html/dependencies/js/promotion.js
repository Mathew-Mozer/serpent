/**
 * This file controls promotion javascript
 */

/**
 * When a tile is clicked, open the edit modal
 */
var tileBodyClick = function () {
    promotionViewModal.dialog('open');
    $("#promotion-view-modal").data('promo-id', $(this).data("promo-id"));
    $("#promotion-view-modal").data('promo-type-id', $(this).data("promo-type-id"));
    $
    $("#promotion-view-modal").load("views/displaypromotionviews/display" + $(this).data("promo-type") + "view.php");

};

/**
 * Open the settings modal
 * @param e
 */
var settingsButtonClick = function (e) {
    e.stopPropagation();
    var ids = $(this).attr('id').split('-');

    //var perm = canDelete(ids[0],id);
    //getSettings(ids[1],ids[2], perm);
    $("#settings").data('promo-id', $(this).data("promo-id"));
    $("#settings").data('promo-type-id', $(this).data("promo-type-id"));
    $("#settings").load("views/addpromotionviews/add"+$(this).data("promo-type")+"view.php",{promotion_settings:true, promotion_id:$(this).data("promo-id"), promotion_type:$(this).data("promo-type-id")});

    openSettingsModal();
};

/**
 * Show option bar
 */
var showOptionsBar = function () {
    $(this).children(".tile-menu-bar").show();
};

/**
 * Hide option bar
 */
var hideOptionsBar =  function () {
    $(this).children(".tile-menu-bar").hide();

};

/**
 * Highlight current options
 */
var highlightCurrentOption = function () {
    $(this).addClass("tile-menu-item-hover");
};

/**
 * Remove highlight from current option
 */
var dehighlightCurrentOption = function () {
    $(this).removeClass("tile-menu-item-hover");

};