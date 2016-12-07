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
var addPromotionByType = function (propertyId, promotionTypeId, promotionType, accountId) {

    var data = getFormData('add-promotion');
    data['action'] = 'add';
    data['promotionTypeId'] = promotionTypeId;
    data['propertyId'] = propertyId;
    data['promotionType'] = promotionType;
    data['accountId'] = accountId;
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: data,
        cache: false,
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
    console.log(promotionTypeId);
    data['promotionId'] = promotionId;
    data['accountId'] = accountId;
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: data,
        cache: false,
        Update: function (response) {
            alert(response);
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

/**
 * Update promotion settings by id
 * @param promotionId
 */
var updatePromotionSettings = function (promotionId) {
    var data = getFormData('add-promotion');
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
        Update: function (response) {

        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
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
        success: function (response) {
            setFormData('add-promotion', response)
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
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
        if (formDataInput[i].type == 'RADIO') {
            if (formDataInput[i].checked) {
                data[formDataInput[i].name] = formDataInput[i].value;
            }
        } else if (formDataInput[i].type == 'CHECKBOX') {
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
    console.log(data);
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
            if (formDataInput[i].type == 'RADIO') {
                if (data[formDataInput[i].name] == formDataInput[i].value) {
                    formDataInput[i].checked = true;
                }
            } else if (formDataInput[i].type == 'CHECKBOX') {
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

};

/**
 * Inserts a template promotion into the database
 */
var saveTemplate = function () {
    var promotionData = getFormData('add-promotion');
    var promotionTypeId = $('#promotionTypeId').val();
    var propertyId = $('input[name=propertyId]').val();
    var promotionType = $('#promotionTypeName').val();
    var accountId =  1;
    var templateName = $('#template-name').val();
    var sceneId = $('#scene-id').val();
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: {
            action: 'saveTemplate',
            promotionTypeId: promotionTypeId,
            propertyId : propertyId,
            promotionType: promotionType,
            accountId : accountId,
            templateName: templateName,
            sceneId : sceneId,
            data: promotionData
        },
        cache: false,
        success: function () {
            $('#addPromotion').dialog('close');
            $("#promotion-details").empty();
            $('#add-promotion-buttons').empty();
            $('#create-template').empty();
            $("#promotion-select").show();
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};
