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
console.log('Loaded FormHelperFunctions.js');
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
            console.log(xhr + "\n" + err);
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
            console.log('Get Modal Data:'+ response);
            setFormData('add-promotion', response)
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
                //console.log(formDataInput[i].name+":"+ data[formDataInput[i].name]);
                if (data[formDataInput[i].name] == 1) {
                    formDataInput[i].checked = true;
                } else {
                    formDataInput[i].checked = false;
                }
            } else {
                //console.log(formDataInput[i].name);
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


    if($('#pgt_enable_instant_winners').is(':checked')){
        $('#instant-winner-options').show();
    }else{
        $('#instant-winner-options').hide();
    }
};


