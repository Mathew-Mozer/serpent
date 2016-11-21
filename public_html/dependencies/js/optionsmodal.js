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
                var jsonData = $.parseJSON(response);
                if(promoType == 1) {
                    $('#settings').html(
                        '<form> '+
                        '<br> <label>Title Message</label>'+
                        '<input id="title-message" name="title-message" type="text" value="' +
                            jsonData['title_message'] + '"/>' +
                        '<br> <br> '+
                        '<label>Horn Timer</label>' +
                        '<input id="horn-timer" name="horn-timer" type = "number" value="'+
                            jsonData['horn_timer'] +'"/>' +
                        '<br> <br>' +
                        '<label>Payout Value</label>' +
                        '<input id="payout-value" name="payout-value" type = "number" value="' +
                        jsonData['payout_value'] + '"/>' +
                        '<br> <br>'+
                        '<label>Session Timer</label>'+
                        '<input id="session-timer" name="session-timer" type = "number" value="'+
                        jsonData['session_timer'] + '"/>'+
                        '<br> <br>'+
                        '<label>Show Multiple Hands</label> <br>'+
                        '<span class="high-hand-span">Disabled</span> <input id="disabled" class="high-hand-radio" ' +
                        'value="0" name="multiple-hands" type = "radio"/>  <br/>' +
                        'Previous Winners <input id="previous" class="high-hand-radio" ' +
                        'value="1" name="multiple-hands" type = "radio"/> <br/>' +
                        'Ranked Hands <input id="ranked" class="high-hand-radio" ' +
                        'value="2" name="multiple-hands" type = "radio"/> <br/>' +
                        '<br> <br>' +
                        '<label class="high-hand-label">High Hand Gold</label>' +
                        '<input class="high-hand-checkbox" id="high-hand-gold" ' +
                        'name="high-hand-gold" type = "checkbox"/>' +
                        '<br> <br>' +
                        '<label class="high-hand-label">Use Joker</label>' +
                        '<input class="high-hand-checkbox" id="use-joker" ' +
                        'name="use-joker" type = "checkbox"/>' +
                        '</form>');
                        var multipleHands = String(jsonData['multiple_hands']);
                        if(multipleHands == 0){
                            $(":radio[value='0']").prop("checked", true);
                        } else if (multipleHands == 1) {
                            $(":radio[value='1']").prop("checked", true);
                        } else {
                            $(":radio[value='2']").prop("checked", true);
                        }
                        if(jsonData['use_joker'] == 1) {
                            $("#use-joker").prop('checked', true);
                        }
                        if(jsonData['high_hand_gold'] == 1) {
                            $("#high-hand-gold").prop('checked', true);
                        }
                }else if(promoType == 11){
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
