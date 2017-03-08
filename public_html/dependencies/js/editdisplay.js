//TODO  COMMENT!!!!!!!!!!!!!

var saveDisplayOptions = function () {

    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'updateDisplaySettings',
            propertyId: $('#property-id').val(),
            displayId: $('#display-id').val(),
            displayName: $('#display-name-field').val(),
            displayLocation: $('#display-location-field').val()
        },
        cache: false,
        success: function () {
            $('#update-display-btn').hide();
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

var removePromotionFromDisplay = function (promotionId) {

    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'removePromotion',
            promotionId: promotionId,
            displayId: $('#display-id').val()
        },
        cache: false,
        success: function () {
            var propertyId = $('#property-id').val();
            var displayId = $('#display-id').val();
            var propertyName = $('#property-name').val();
            console.log("pname=" + propertyName);
            $("#editDisplayModal").load("modals/displaymodalform.php", {
                propertyId: propertyId,
                displayId: displayId,
                propertyName: propertyName
            });
            $("#displayViewContainer" + propertyId).load("views/displayview.php", {
                propertyId: propertyId,
                displayId: displayId,
                property_name: propertyName
            });
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

var addPromotionToDisplay = function (promotionId, skinId, defaultTime) {
    console.log("pskin:" + skinId);
    if (skinId == 0) {
        skinId = $('#default-skin').val();
    }
    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'addPromotion',
            displayId: $('#display-id').val(),
            propertyId: $('#property-id').val(),
            propertyName: $('#property-name').val(),
            skinId: skinId,
            sceneDuration: defaultTime,
            promotionId: promotionId,
            active: 1
        },
        cache: false,
        success: function () {
            var propertyId = $('#property-id').val();
            var displayId = $('#display-id').val();
            var propertyName = $('#property-name').val();
            console.log("pname=" + propertyName);
            $("#editDisplayModal").load("modals/displaymodalform.php", {
                propertyId: propertyId,
                displayId: displayId,
                propertyName: propertyName
            });
            $("#displayViewContainer" + propertyId).load("views/displayview.php", {
                propertyId: propertyId,
                displayId: displayId,
                property_name: propertyName
            });
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

var savePromotionDisplaySettings = function (promotionId, sceneDuration, skinId) {
    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'updatePromotionDisplaySettings',
            promotionId: promotionId,
            displayId: $('#display-id').val(),
            sceneDuration: sceneDuration,
            skinId: skinId
        },
        cache: false,
        success: function () {
            $('#save-btn-' + promotionId).hide();
            $('.remove-from-display').show();

        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });

};
$(document).on("click", "#update-display-btn", function () {
    saveDisplayOptions();
});
$(document).on("click", ".remove-from-display", function () {
    removePromotionFromDisplay(this.id);
});
$(document).on("click", ".add-to-display", function () {
    addPromotionToDisplay(this.id, $(this).data('skin-id'), $(this).data('default-time'));
});
$(document).on("keyup change", ".scene-duration", function () {
    $('.remove-from-display').hide();
    $('#save-btn-' + this.name).show();
});
$(document).on("change",".skin-id",function () {
    $('.remove-from-display').hide();
    $('#save-btn-' + this.name).show();
})
$('select').change(function () {
    $('#save-btn-' + this.name).show();
});
$(document).on("keyup change", "#display-name-field", function () {
    $('#update-display-btn').show();
});
$(document).on("keyup change", "#display-location-field", function () {
    $('#update-display-btn').show();
});

$(document).on("click", ".save-btn", function () {
    var sceneDuration = $('#scene-duration-' + this.name).val();
    var skinId = $('#skin-id-' + this.name).val();
    savePromotionDisplaySettings(this.name, sceneDuration, skinId);
});

$(document).on("click", "#save-display-options", function () {

    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'updatePromotionDisplayOptions',
            display_mac:$('#display-mac').val(),
            display_propertyid:$('#display-propertyID').val(),
            display_api_id:$('#display-api-id').val(),
            display_height:$('#display-height').val(),
            display_width:$('#display-width').val(),
            display_fitw:$('#display-fitw').is(":checked"),
            display_fith:$('#display-fith').is(":checked"),
            displayId:$('#display-id').val(),
            display_flip:$('#display-flip').is(":checked"),
            display_debug:$('#display-debug').is(":checked")
        },
        cache: false,
        success: function ($results) {
            location.reload();
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
});
$(document).on("click", ".display-modal-view-switch", function () {
    $displayinfo = $('#display-info');

    $selecteTab = $(this).attr('data-tab');
    console.log('tab='+$selecteTab);
    $('.display-modal-view').hide();
    $('#'+$selecteTab).show();
    switch ($selecteTab){
        case 'display-admin-options-modal':
            $('#display-admin-options-modal').load("views/editdisplaypreferences.php", {propertyId: $displayinfo.attr('data-property-id'),displayid: $displayinfo.attr('data-display-id')});
            break;
    }

});

