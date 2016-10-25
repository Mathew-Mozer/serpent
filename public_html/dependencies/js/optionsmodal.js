//sets settingsModal variable to the described modal window

    var promotionID;
    var permission;
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
            //submit changes to db through options modal class
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
    var getSettings = function (id, perm) {
        promotionID = id;
        permission = perm;
        $.ajax({
            url: 'controllers/optionscontroller.php',
            type: 'post',
            data: {action: 'get', id: promotionID},
            cache: false,
            success: function (response) {
                var row;
                var jsonData = $.parseJSON(response);

                //appends resulting rows to settings div
                $.each(jsonData, function(key,value) {
                   row = key + " = " + value + "<br/>";
                    $('#settings').append(row);
                });
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
            url: 'controllers/optionscontroller.php',
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
            url: 'controllers/optionscontroller.php',
            type: 'post',
            data: {action: 'canDelete', id: casinoId, permission: perm},
            cache: false,
            success: function (response) {
                permission = $.parseJSON(response);
                return permission['permission'];
            }
        });
    };
