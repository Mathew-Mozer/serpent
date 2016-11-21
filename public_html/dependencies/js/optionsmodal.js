//sets settingsModal variable to the described modal window

    var promotionID;
    var permission;
    var promotionType;

    //variable for the modal window
    var settingsModal = $("#settings").dialog({
        autoOpen: false,
        height: 400,
        width: 350,
        modal: true,
        closeOnEscape: false,
        create: function (){
            //removes the x button on the top right corner
            $(this).dialog("widget").find('.ui-dialog-titlebar-close').remove();
        }
    });

    //buttons for the modal
    var modalButtons = {

        Submit: function () {
            var settings = [];
            settings['promotionType'] = promotionType;
            settings['cashPrize'] = $('#cash-prize').val();
            settings['targetNumber'] = $('#target-number').val();
            console.log(settings);
            updateSettings(settings);
            settingsModal.dialog('close');
            //resets div to blank
            $('#settings').empty();
        }
    };

    //when the settings icon is clicked on the promotion tile
    var openSettingsModal = function() {
        //include buttons
        settingsModal.dialog('option','buttons',modalButtons);
        settingsModal.dialog('open');
    };

    //returns the settings stored in the database
    var getSettings = function (id, promoType, perm) {
        promotionID = id;
        permission = perm;
        promotionType = promoType;

        $.ajax({
            url: 'controllers/optionsmodalcontroller.php',
            type: 'post',
            data: {action: 'get', id: promotionID, typeId: promoType},
            cache: false,
            success: function (response) {
                var row;
                var jsonData = $.parseJSON(response);
                if(promoType == 11){
                    $('#settings').html('<br><label>Target Number</label><br>' +
                        '<input id="target-number" name="target-number" type="number" value="'+ jsonData['target_number'] + '"/> <br> ' +
                        '<label>Cash Prize </label> <br> ' +
                        '<input id="cash-prize" name="cash-prize" type = "number" value="'+ jsonData['cash_prize'] + '"/> <br>');
                }

                if(permission) {
                    modalButtons["Delete"] = function () {
                        deletePromotion();
                        $('#settings').dialog('close');
                        //resets div to blank
                        $('#settings').empty();
                    };
                }
                openSettingsModal();
            }
        });
    };

    //archives the promotion
    var deletePromotion = function () {
        $.ajax({
            url: 'controllers/optionsmodalcontroller.php',
            type: 'post',
            data: {action: 'archive', id: promotionID},
            cache: false,
            success: function () {
                $('.'+promotionID).hide();
            }
        });
    };

    var canDelete = function(casinoId, perm) {
        $.ajax({
            url: 'controllers/optionsmodalcontroller.php',
            type: 'post',
            data: {action: 'canDelete', id: casinoId, permission: perm},
            cache: false,
            success: function (response) {
                permission = $.parseJSON(response);
                return permission['permission'];
            }
        });
    };

    var updateSettings = function (updatedSettings) {
        $.ajax({
            url: 'controllers/optionsmodalcontroller.php',
            type: 'post',
            data: {action: 'update', id: promotionID, typeId: promotionType, cashPrize: updatedSettings['cashPrize'], targetNumber: updatedSettings['targetNumber']},
            cache: false
        })
    };
