//TODO  COMMENT!!!!!!!!!!!!!
console.log("Loaded EditDisplay.js")
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
            $('#EditDisplayNameForm').hide();
            $('button.edit-display-btn[data-display-id=' + $('#display-id').val() + ']').children('.display-location').text($('#display-location-field').val())
            $('button.edit-display-btn[data-display-id=' + $('#display-id').val() + ']').children('.display-name-label').text($('#display-name-field').val())
            $('#sidenav-display-name').text($('#display-name-field').val())
            $('#sidenav-display-location').text($('#display-location-field').val())
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

var removePromotionFromDisplay = function (promotionId,linkcode) {

    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'removePromotion',
            promotionId: promotionId,
            displayId: $('#display-id').val()
        },
        cache: false,
        success: function (htm) {
            var propertyId = $('#property-id').val();
            var displayId = $('#display-id').val();
            var propertyName = $('#property-name').val();
            console.log("pname=" + propertyName);
            /*
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
             */
            reloadSideNav()
            console.log("sUCKEDDSA!!" + htm)
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
            console.log("NOT!")
        }
    });
};

var addPromotionToDisplay = function (promotionId, skinId, defaultTime, propertyID) {
    if (skinId == 0) {
        skinId = $('#default-skin').val();
    }
    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'addPromotion',
            displayId: $('#display-id').val(),
            propertyId: propertyID,
            propertyName: $('#property-name').val(),
            skinId: skinId,
            sceneDuration: defaultTime,
            promotionId: promotionId,
            active: 1
        },
        cache: false,
        success: function (html) {
            var propertyId = $('#property-id').val();
            var displayId = $('#display-id').val();
            var propertyName = $('#property-name').val();
            console.log("pname=" + propertyName);
            // $("#editDisplayModal").load("modals/displaymodalform.php", {
            //     propertyId: propertyId,
            //     displayId: displayId,
            //      propertyName: propertyName
            //   });
            //  $("#displayViewContainer" + propertyId).load("views/displayview.php", {
            //    propertyId: propertyId,
            //  displayId: displayId,
            //     property_name: propertyName
            //   });
            if (html.toString() == "Promo Already Added") {
                alert("Promotion already exists on the display")
            }

            reloadSideNav()
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};
var reloadSideNav = function () {
    var propertyId = $('#property-id').val();
    var displayId = $('#display-id').val();
    var propertyName = $('#property-name').val();
    var linkcode=$('#display-id-form').data("linkcode");
    $("#sidenavPage").load("views/newdisplaymodalform.php", {
        propertyId: propertyId,
        displayId: displayId,
        propertyName: propertyName,
        linkcode: linkcode
    });
}
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
            console.log("Promotion Updated")
            updatePromoSettingsDialog.dialog("close");
            reloadSideNav();
            $('#save-btn-' + promotionId).hide();
            //$('.remove-from-display').show();

        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });

};
$(document).on("click", "#update-display-btn", function () {
    saveDisplayOptions();
});
$(document).on("click", "#cancel-update-display-btn", function () {
    $('#EditDisplayNameForm').hide();
});

$(document).on("click", "#display-info-field-edit", function () {
    $('#EditDisplayNameForm').show();
});

$(document).on("click", ".remove-from-display", function () {
    removePromotionFromDisplay($(this).data("promo-id"),$(this).data("linkcode"));
});
$(document).on("click", ".add-to-display", function () {
    addPromotionToDisplay(this.id, $(this).data('skin-id'), $(this).data('default-time'));
});
$(document).on("keyup change", ".scene-duration", function () {
    $('.remove-from-display').hide();
    $('#save-btn-' + this.name).show();
});
$(document).on("change", ".skin-id", function () {
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

$(document).on("click", ".send-fccm-command", function (evt) {
    evt.stopImmediatePropagation();
    if (typeof Display == 'undefined') {
        console.log("Display is not defined")
    } else {
        var useToken = "";
        var serviceId = $(this).data("service-id");
        var tokenId = $(this).data("token-id");
        console.log("Key:" + Display.Key)
        switch ($(this).data("command")){
            case "Quit":
                firebase.database().ref('Displays/' + Display.Key + "/Kiosk").set(true);
                break;
            case "LaunchApp":
                switch ($(this).data("package-name")){
                    case "com.typhonpacific.ChimeraTV":
                        firebase.database().ref('Displays/' + Display.Key + "/Kiosk").set(true);
                        break;
                }
            break;
        }
        switch(+tokenId){
            case 0:
                console.log("Sending to CTV");
                useToken = Display.ctvfirebasetoken;
                break;
            case 1:
                console.log("Sending to Home");
                useToken = Display.FCMToken;
                break
        }
        $.ajax({
            url: 'controllers/displaycontroller.php',
            type: 'post',
            data: {
                action: 'SendCommandToDisplay',
                display_id: $(this).data("display-id"),
                FCMToken: useToken,
                command: $(this).data("command"),
                packageName: $(this).data("package-name"),
                serviceID: serviceId,
                tokenID: tokenId
            },
            cache: false,
            success: function ($results) {
                $("<div style='text-align: center'>Please allow 30 seconds for the app to restart.<br> If it does not restart please contact customer support.</div>").dialog();
            },
            error: function (xhr, desc, err) {
                console.log(xhr + "\n" + err);
            }
        });
    }
});
$(document).on("click", "#view-api-data", function () {
    window.open(window.location.href + 'API/104/index.php?action=GetSettings&mac=' + $("#display-mac").val() + '&linkcode=' + $("#display-linkcode").val(), "");
    return false;
});

$(document).on("click", "#save-display-options", function () {

    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'updatePromotionDisplayOptions',
            display_mac: $('#display-mac').val(),
            display_propertyid: $('#display-propertyID').val(),
            display_api_id: $('#display-api-id').val(),
            display_height: $('#display-height').val(),
            display_width: $('#display-width').val(),
            display_fitw: $('#display-fitw').is(":checked"),
            display_fith: $('#display-fith').is(":checked"),
            displayId: $('#display-id').val(),
            display_linkcode: $('#display-linkcode').val(),
            display_flip: $('#display-flip').is(":checked"),
            display_flipv: $('#display-flipv').is(":checked"),
            display_debug: $('#display-debug').is(":checked"),
            display_vertical: $('#display-vertical').is(":checked"),
            display_kiosk: $('#display-kiosk').is(":checked")
        },
        cache: false,
        success: function ($results) {
            //location.reload();
            console.log($results);
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
});
$(document).on("click", ".display-modal-view-switch", function () {
    $displayinfo = $('#display-info');
    $selecteTab = $(this).attr('data-tab');
    console.log('tab=' + $selecteTab);
    switch ($selecteTab) {
        case 'display-admin-options-modal':
            $("#editDisplayModal").load("views/editdisplaypreferences.php", {
                propertyId: $displayinfo.attr('data-property-id'),
                displayid: $displayinfo.attr('data-display-id')
            });
            ///$('#display-admin-options-modal').load("views/editdisplaypreferences.php", {propertyId: $displayinfo.attr('data-property-id'),displayid: $displayinfo.attr('data-display-id')});
            editDisplayModal.dialog('open');
            break;
    }

});

