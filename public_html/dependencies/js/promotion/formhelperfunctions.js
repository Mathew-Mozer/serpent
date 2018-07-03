/**
 * This file defines promotion forms
 */

/**
 * Add promotion by type
 * @param propertyId
 * @param promotionTypeId
 * @param promotionType
 * @param accountId
 */

var addPromotionByType = function (propertyId, promotionTypeId, promotionType, accountId,selectedSkin,promotionlabel, animation) {
    var data = getFormData('add-promotion');
    data['action'] = 'add';
    data['promotionTypeId'] = promotionTypeId;
    data['propertyId'] = propertyId;
    data['promotionType'] = promotionType;
    data['accountId'] = accountId;
    data['chosenSkin'] = selectedSkin;
    data['Promotion-Label']= promotionlabel;
    data['Promotion-Animation'] = animation ? 1:0;

    console.log("animation:" + animation);
    //console.log("promotion label: " + data['Promotion-Label']);
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: data,
        cache: false,
        beforeSend: function(){
            $(".loader").removeClass("hidden");
        },
        success: function (response) {
            //update view with new promotion

            addPromotion(response);
            addPromotionModal.dialog('close');
            $("#promotion-details").empty();
            $('#add-promotion-buttons').empty();
            $('#create-template').empty();
            $("#promotion-select").show();

        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err + "\n" + desc);

        },
        complete: function(){
            $(".loader").addClass("hidden");
        }
    });
};

/**
 * Update Promotion by ID
 * @param promotionId
 * @param promotionTypeId
 * @param accountId
 */
var updatePromotion = function (promotionId, promotionTypeId, accountId) {
    var data = getFormData('add-promotion');

    data['action'] = 'update';
    data['promotionTypeId'] = promotionTypeId;
    data['promotionId'] = promotionId;
    data['accountId'] = accountId;
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: data,
        cache: false,
        beforeSend: function(){
            $(".loader").removeClass("hidden");
        },
        Update: function (response) {
            alert(response);
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        },
        complete: function(){
            $(".loader").addClass("hidden");
        }
    });
};

/**
 * Update promotion settings by id
 * @param promotionId
 */
var updatePromotionSettings = function (promotionId) {
    var data = getFormData('add-promotion');
    console.log('Updating now');
    data['action'] = 'updateSettings';
    data['promotionTypeId'] = promotionTypeId;
    data['propertyId'] = propertyId;
    data['promotionType'] = promotionType;
    data['accountId'] = accountId;
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: data,
        cache: false,
        beforeSend: function(){
            $(".loader").removeClass("hidden");
        },
        Update: function (response) {

        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        },
            complete: function(){
                $(".loader").addClass("hidden");
            }
    });
};

/**
 * Get modal data by promotion ID
 * @param promotionId
 * @param promotionTypeId
 */
var getModalData = function (promotionId, promotionTypeId) {

    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: {
            action: 'read',
            promotionId: promotionId,
            promotionTypeId: promotionTypeId
        },
        cache: false,
        beforeSend: function(){
            $(".loader").removeClass("hidden");
        },
        success: function (response) {
            console.log(response)
            console.log("dipply")
            setFormData('add-promotion', response)
            enableFP();
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        },
        complete: function(){
            $(".loader").addClass("hidden");
        },
        complete: function(){
            $(".loader").addClass("hidden");
        }
    });
};

/**
 * Get form data by form ID
 * @param formId
 * @returns {{}}
 */
var getFormData = function (formId) {

    var data = {};
    var formDataInput = document.getElementById(formId).getElementsByTagName('INPUT');
    var formDataSelect = document.getElementById(formId).getElementsByTagName('SELECT');
    var formDataTextArea = document.getElementById(formId).getElementsByTagName('TEXTAREA');

    for (var i = 0; i < formDataInput.length; i++) {
        if (formDataInput[i].type.toLowerCase() == 'radio') {
            var radioButtons = document.getElementsByName(formDataInput[i].name);

            for(var r = 0; r < radioButtons.length; r++){
                if(radioButtons[r].checked){
                    data[formDataInput[i].name] = radioButtons[r].value;
                }
            }
        } else if (formDataInput[i].type.toLowerCase() == 'checkbox') {
            if (formDataInput[i].checked) {
                data[formDataInput[i].name] = 1;
            } else {
                data[formDataInput[i].name] = 0;
            }
        } else {
            data[formDataInput[i].name] = formDataInput[i].value;
        }
    }
    for (var i = 0; i < formDataSelect.length; i++) {
        data[formDataSelect[i].name] = formDataSelect[i].value;
    }
    for (var i = 0; i < formDataTextArea.length; i++) {
        data[formDataTextArea[i].name] = formDataTextArea[i].value;
    }
    //console.log(data);

    return data;
};

/**
 * Set Form data by Form ID
 * @param formId
 * @param data
 */

var setFormData = function (formId, data) {
    var formDataInput = document.getElementById(formId).getElementsByTagName('INPUT');
    var formDataSelect = document.getElementById(formId).getElementsByTagName('SELECT');
    var formDataTextArea = document.getElementById(formId).getElementsByTagName('TEXTAREA');

    for (var i = 0; i < formDataInput.length; i++) {
        if (data[formDataInput[i].name]) {
            if (formDataInput[i].type.toLowerCase() == 'radio') {
                var radioButtons = document.getElementsByName(formDataInput[i].name);

                for(var r = 0; r < radioButtons.length; r++){

                    if(data[formDataInput[i].name] == radioButtons[r].value){
                        radioButtons[r].checked = true;
                    }
                }
            } else if (formDataInput[i].type.toLowerCase() == 'checkbox') {
                $(formDataInput[i]).trigger('change');
                //console.log(formDataInput[i].name+":"+ data[formDataInput[i].name]);
                if (data[formDataInput[i].name] == 1) {
                    formDataInput[i].checked = true;
                } else {
                    formDataInput[i].checked = false;
                }
            } else {

                formDataInput[i].value = data[formDataInput[i].name];
            }
        }
    }
    for (var i = 0; i < formDataSelect.length; i++) {
        if (data[formDataSelect[i].name]) {
            formDataSelect[i].value = data[formDataSelect[i].name];
        }
    }
    for (var i = 0; i < formDataTextArea.length; i++) {
        if (data[formDataTextArea[i].name]) {
            formDataTextArea[i].value = data[formDataTextArea[i].name];
        }
    }
    $('#instant-winner-options').show();
    if(parseInt(data['pgtPlayerCount'])>0){
        playerarray = [];
        //alert('should be parsing');
        for(i=1;i<data['pgtPlayerCount']+1;i++){
            loadTemplate(data['pgt_player_name'+i],data['pgt_current_points'+i],data['pgt_player_id'+i])

        }

    }
    $('#ttlockDef').trigger('change');
    if($('#pgt_enable_instant_winners').is(':checked')){
        $('#instant-winner-options').show();
    }else{
        $('#instant-winner-options').hide();
    }
//
    $('#2hr-option').show();
    checkhr();
    $("input[name='session_timer']").click(function() {
        checkhr();

    });
    function checkhr() {
        if($('input:radio[name="session_timer"]:checked').val() =="1"){
            $('#2hr-option').show();
        }else{
            $('#2hr-option').hide();
        }
    }
    //spectrum
    $(".spectrumcl").spectrum({
        showInput: true,
        //className: "full-spectrum",
        showInitial: true,
        showPalette: true,
        showSelectionPalette: true,
        maxSelectionSize: 10,
        preferredFormat: "hex",
        localStorageKey: "spectrum.demo",
        move: function (color) {

        },
        show: function () {

        },
        beforeShow: function () {

        },
        hide: function () {

        },
        change: function() {

        },
        palette: [
            ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)",
                "rgb(204, 204, 204)", "rgb(217, 217, 217)","rgb(255, 255, 255)"],
            ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
                "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"],
            ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
                "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
                "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
                "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
                "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
                "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
                "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
                "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
                "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
                "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
        ]
    });
    if(document.getElementById('monster_carlo_settings_payouts')){
        arr = document.getElementById('monster_carlo_settings_payouts').value.split(',');
        countMonsterCarlo();
    }
    if(document.getElementById('multi_madness_values')){
        arr = document.getElementById('multi_madness_values').value.split(',');
        countMMMultipliers();
        hideStartButton();
    }
    enableFP();
};


