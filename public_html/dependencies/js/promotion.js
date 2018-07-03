/**
 * This file controls promotion javascript
 */
var isMobile = false; //initiate as false
// device detection

detectMobile();
function detectMobile() {
    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) isMobile = true;
}
/**
 * When a tile is clicked, open the edit modal
 */
var tileBodyClick = function () {
//alert('data:' + $(this).data("property-point-storage"));
    console.log("clicked Promotion");
    $("#promotion-view-modal").data('promo-id', $(this).data("promo-id"));
    $("#promotion-view-modal").data('promo-type-id', $(this).data("promo-type-id"));
    $("#promotion-view-modal").data('promo-point-storage', $(this).data("property-point-storage"));
    $("#promotion-view-modal").data('property-id', $(this).data("property-id"));
    console.log("Display:" +  $(this).data("promo-type"));
    $("#promotion-view-modal").load("views/displaypromotionviews/display" + $(this).data("promo-type") + "view.php",{propertyid:$(this).data("property-id"),promoid:$(this).data("promo-id"),pointstorage:$(this).data("property-point-storage")});
    var diagheight = 850;
    var diagwidth = 1400;
    switch ($(this).data("promo-type-id")){
        case 1: //High Hand Gold
            diagheight = 768;
            diagwidth = 1024;
        break;
        case 4: // Point Race
            diagheight = 768;
            diagwidth = 1024;
            break;
        case 5: //Picture Slideshow
            diagheight = 768;
            diagwidth = 1024;
            break;
        case 8: // Prize Event
            diagheight = 768;
            diagwidth = 1024;
            break;
        case 9: // Monster Carlo
            diagheight = 768;
            diagwidth = 1024;
            break;
        case 11: // Kick for cash
            diagheight = 768;
            diagwidth = 1024;
            break;
        case 13: // Multiplier Madness
            diagheight = 768;
            diagwidth = 1024;
            break;
        case 14: // Time Target
            diagheight = 768;
            diagwidth = 1024;
            break;
        case 15: // Time Target X
            diagheight = 768;
            diagwidth = 1024;
            break;
        case 15: // Custom Promotion
            diagheight = 768;
            diagwidth = 1200;
            break;
    }

    promotionViewModal.dialog('option','height',$(window).height());
    promotionViewModal.dialog('option','width',$(window).width());
    document.body.scrollTop = document.documentElement.scrollTop = 0;
    promotionViewModal.dialog('open');
    closeNav();
};

/**
 * Open the settings modal
 * @param e
 */


function promoLockButtonClick(lockstatus,promoId,displayId,propertyName,propertyId) {
    if(lockstatus){
        promoId=0;
    }
    console.log('promoLock=' + displayId);

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
            console.log("return ls:" + lockstatus + " - promoid:" + promoId + " - displayid:"+ displayId + " - propertyname:" + propertyName)
            $("#sidenavPage").load("views/newdisplaymodalform.php", {
                propertyId: propertyId,
                displayId: displayId,
                propertyName: propertyName
            });
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
var promoStatusButtonClick = function (e) {
    e.stopPropagation();
    var currentObject = $(e);
    changePromotionStatusModal =$("#dialog").dialog();
    var promoId = $(this).data("promo-id");
    $("#dialog").load("views/changepromostatusview.php",{promoid:promoId});

    selectedElement = this;

    changePromotionStatusModal.dialog('open');
    changePromotionStatusModal.dialog({width: 250,height:325});
    return false
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

    }

};

var selectedElement;
var editPromoName = function (e) {
    e.stopPropagation();

}
var changePromoStatus = function () {
    changePromotionStatusModal.dialog('close');
    currentObject = $(selectedElement);
    var curStatus = parseInt($(this).data("promo-status"));
    //alert(curStatus + " - promoid:" + $(this).data("promoid"));
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: {
            action: 'updatePromotionStatus',
            promotionId: $(this).data("promoid"),
            nextStatus: curStatus
        },
        cache: false,
        success: function (response) {

            currentObject.data("promo-status",response['promo_status']);

            console.log('setting promo status '+currentObject.data("promo-status"));
            switch(parseInt(response['promo_status'])){
                case 0:
                    currentObject.find('span').removeClass('glyphicon-clock');
                    currentObject.find('span').removeClass('glyphicon-stop');
                    currentObject.find('span').removeClass('glyphicon-pause');
                    currentObject.find('span').addClass('glyphicon-stop');

                    break;
                case 1:
                    currentObject.find('span').removeClass('glyphicon-clock');
                    currentObject.find('span').removeClass('glyphicon-stop');
                    currentObject.find('span').removeClass('glyphicon-pause');
                    currentObject.find('span').addClass('glyphicon-play');
                    break;
                case 2:
                    currentObject.find('span').removeClass('glyphicon-clock');
                    currentObject.find('span').removeClass('glyphicon-stop');
                    currentObject.find('span').removeClass('glyphicon-pause');
                    currentObject.find('span').addClass('glyphicon-pause');
                    break;
                case 3:
                    currentObject.find('span').removeClass('glyphicon-clock');
                    currentObject.find('span').removeClass('glyphicon-stop');
                    currentObject.find('span').removeClass('glyphicon-pause');
                    currentObject.find('span').addClass('glyphicon-time');
                    break;
            }
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }

    });

}

var settingsButtonClick = function (e) {
    e.stopPropagation();
    console.log('settings clicked');
    var ids = $(this).attr('id').split('-');

    //var perm = canDelete(ids[0],id);
    //getSettings(ids[1],ids[2], perm);
    $("#promotion-view-modal").data('promo-id', $(this).data("promo-id"));
    $("#promotion-view-modal").data('promo-type-id', $(this).data("promo-type-id"));
    $("#promotion-view-modal").load("views/addpromotionviews/add"+$(this).data("promo-type")+"view.php",{propertyId: $(this).data("promo-property-id") ,promotion_settings:true, promotion_id:$(this).data("promo-id"), promotion_type:$(this).data("promo-type-id")});
    openSettingsModal();
};
/**
 * Show option bar
 */
var showOptionsBar = function () {
    $(this).children(".tile-menu-bar").show();
    //showStatusBar();
};

/**
 * Hide option bar
 */
var hideOptionsBar =  function () {
    if(!isMobile)
    $(this).children(".tile-menu-bar").hide();
    //hideStatusBar();

};
/**
 * Show option bar
 */
var showStatusBar = function () {
    $(this).parent().children(".tile-status-bar").show();
    console.log("id" +$(this).children(".tile-status-bar").id);
};

/**
 * Hide option bar
 */
var hideStatusBar =  function () {
    $(this).parent().children(".tile-status-bar").hide();
    console.log("that");
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


var updatePromoSettingsDialog = $( "#promo-display-settings-dialog" ).dialog({
    autoOpen: false,
    height: 200,
    width: 350,
    modal: true,
    buttons: {
        "Save": function () {
            var sceneDuration = $('#update-promo-scene-duration').val();
            var skinId = $('#update-promo-scene-skin').val();
            var promoid = $('#update-promo-scene-skin').data("promo-id");
            console.log("dur:" + sceneDuration + " skinId: " + skinId + " promoid: " + promoid)
            savePromotionDisplaySettings(promoid, sceneDuration, skinId);
        },
        Cancel: function() {
            updatePromoSettingsDialog.dialog( "close" );
        }
    },
    close: function() {

    }
});
var updatePromoTitleDialog = $( "#promo-display-settings-dialog" ).dialog({
    autoOpen: false,
    height: 200,
    width: 350,
    modal: true,
    buttons: {
        "Save": function () {
            var sceneDuration = $('#update-promo-scene-duration').val();
            var skinId = $('#update-promo-scene-skin').val();
            var promoid = $('#update-promo-scene-skin').data("promo-id");
            console.log("dur:" + sceneDuration + " skinId: " + skinId + " promoid: " + promoid)
            savePromotionDisplaySettings(promoid, sceneDuration, skinId);
        },
        Cancel: function() {
            updatePromoSettingsDialog.dialog( "close" );
        }
    },
    close: function() {

    }
});