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


function promoLockButtonClick(lockstatus,promoId,displayId,propertyName,propertyId) {
    if(lockstatus){
        promoId=0;
    }
    //console.log('promoLock=' + displayId);

    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'updateLockStatus',
            promotionId: promoId,
            displayId: displayId
        },
        cache: false,
        success: function (response) {
            $("#displayViewContainer"+propertyId).load("views/displayview.php", {propertyId: propertyId, displayId: displayId,property_name:propertyName});
            //console.log("return ls:" + lockstatus + " - promoid:" + promoId + " - displayid:"+ displayId + " - propertyname:" + propertyId)
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });
}

 function toggleMonitorStatusBtnClick (currentObject,displayId,monitorState) {
    if(monitorState>2)
        monitorState=0;
    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'changeMonitorStatus',
            displayId: displayId,
            monitorState: monitorState
        },
        cache: false,
        success: function (response) {
    console.log(response);
            currentObject.data("monitor-state",response['display_monitor']);
            switch(parseInt(response['display_monitor'])){
                case 0:
                    currentObject.removeClass('glyphicon-warning-sign');
                    currentObject.addClass('glyphicon-eye-close');
                    console.log('closed');
                    break;
                case 1:
                    currentObject.removeClass('glyphicon-eye-close');
                    currentObject.addClass('glyphicon-eye-open');
                    console.log('open');
                    break;
                case 2:
                    currentObject.removeClass('glyphicon-eye-open');
                    currentObject.addClass('glyphicon-warning-sign');
                    console.log('warning');
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });
};
    var promotionDeleteBtnClick = function (e) {
        e.stopPropagation();

    var currentObject = $(this);
    var promoId = currentObject.data("promo-id");
    if(confirm('Are you sure you want to delete this promotion?')){
        $.ajax({
            url: 'controllers/promotioncontroller.php',
            type: 'post',
            data: {
                action: 'archivePromotion',
                promotionId: promoId
            },
            cache: false,
            success: function (response) {
                if(response==1){
                    $('#tile-'+promoId).remove();
                    $('#promolockbtn-'+promoId).remove();
                    $('.promolockbtn-'+promoId).remove();
                }
            },
            error: function(xhr, desc, err) {
                console.log(xhr + "\n" + err);
            }

        });
    }else{
        alert('did not delete');
        alert("this-" +$('#promolockbtn-'+promoId).data('display-id'));
    }

};
var promoStatusButtonClick = function (e) {
    e.stopPropagation();
    var currentObject = $(this);
    var curStatus = parseInt($(this).data("promo-status"));
    var nextStatus = parseInt($(this).data("promo-status"))+1;
    var promoId = $(this).data("promo-id");
    if(nextStatus>2)
        nextStatus=0;
    //console.log("current status="+curStatus);
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: {
            action: 'updatePromotionStatus',
            promotionId: promoId,
            nextStatus: nextStatus
        },
        cache: false,
        success: function (response) {

            currentObject.data("promo-status",response['promo_status']);

            //console.log('setting promo status '+currentObject.data("promo-status"));
            switch(parseInt(response['promo_status'])){
                case 0:
                    currentObject.find('span').removeClass('glyphicon-pause');
                    currentObject.find('span').addClass('glyphicon-play');
                    break;
                case 1:
                    currentObject.find('span').removeClass('glyphicon-play');
                    currentObject.find('span').addClass('glyphicon-stop');
                    break;
                case 2:
                    currentObject.find('span').removeClass('glyphicon-stop');
                    currentObject.find('span').addClass('glyphicon-pause');
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });
};
var settingsButtonClick = function (e) {
    e.stopPropagation();
    console.log('settings clicked');
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