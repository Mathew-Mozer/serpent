/**
 * This file adds new promotion tiles.
 */

/**
 * This adds a new tile to the tile view with the proper image
 * @param data
 */
var addPromotion = function (data) {
    data['append_promotion'] = true;
    $.ajax({
        url: 'views/promotionview.php',
        type: 'post',
        data: data,
        cache: false,
        success: function (html) {
            $("#promotion-list-" + data['property_id']).append(html);
            $("#tile-" + data['promo_id']).unbind('click').click(tileBodyClick);
            $("#tile-" + data['promo_id'] + " div div.settingsBtn").unbind('click').click(settingsButtonClick);

            $("#tile-" + data['promo_id'] + " div.tile-menu-item").hover(highlightCurrentOption, dehighlightCurrentOption);
            $("#tile-" + data['promo_id']).hover(showOptionsBar, hideOptionsBar);
            $("#tile-" + data['promo_id']).tooltip();
        }
    });
};


/**
 * Construct the modal
 * @type {any}
 */
var addPromotionModal = $("#addPromotion").dialog({
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    position: 'center',
    modal: true
});

var promotionName;

/**
 * When a promotion type is selected from menu
 */
$("div.addPromotion").on('click', function (e) {

    e.preventDefault();
    var promotionTypeId = this.id;
    $("#promotion-details").data("promotion-id", $(this).data('promotion-id'));
    promotionName = $(this).data('promotion-name');
    $("#promotion-select").hide();
    $('#use-template').load("views/createtemplateview.php");
    $("#use-template-prompt").hide();
    $("#save-template-prompt").hide();
    $("#template-data").hide();
    $('#use-template').show();
    $('#add-promotion-buttons').append(
        "<button type='button' id='scratch-promotion-btn'>Create New</button>" +
        "<br><br>" +
        "<button type='button' id='use-template-btn'>Use Template</button>");

    $('#use-template-btn').click(function () {
        getTemplateForPromotionType(promotionName,promotionTypeId);
    });

    $('#scratch-promotion-btn').click(function () {
        noTemplate();
    })
});

var getTemplateForPromotionType = function (promotionName, promotionTypeId) {

    var promotionType = promotionName;
    var propertyId = $('input[name=propertyId]').val();
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: {
            action: 'getTemplates',
            promotionType: promotionType,
            propertyId: propertyId
        },
        cache: false,
        success: function (response) {
            chooseTemplateToUse(response, promotionTypeId);
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });

};

var chooseTemplateToUse = function (response, promotionTypeId) {
    $("#use-template-prompt").hide();
    $('#add-promotion-buttons').empty();
    $('#select-template').show();
    $.each(response, function(i,obj) {
        $('#template-options').append(
            "<option value='"+obj.promo_property_promo_id+"'>"+obj.promo_property_template_name+"</option>"
        )
    });

    $('#add-promotion-buttons').append("<button type='button' id='next-page-btn'> Next </button>");

    $('#next-page-btn').click(function () {
        $('#select-template').hide();
        $('#template-form').load('views/addpromotionviews/add'+promotionName+'view.php');
        addPromotionUsingTemplate($('#template-options').val(),promotionTypeId);
    });
};

/*var getTemplateValues = function(templateId,promotionTypeId) {
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: {
            action: 'getTemplateValues',
            promotionTypeId: promotionTypeId,
            templateId: templateId
        },
        cache: false,
        success: function (response) {
            addPromotionUsingTemplate(response);
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};*/

var addPromotionUsingTemplate = function (promotionId,promotionTypeId) {
    $("#template-form").load("views/addpromotionviews/add"+promotionName+"view.php",{promotion_settings:true,
        promotion_id:promotionId, promotion_type:promotionTypeId});
    $('#add-promotion-buttons').empty();
    $('#add-promotion-buttons').append("<button type='button' id='create-promotion-btn'>Create Promotion</button>");

    $('#create-promotion-btn').click(function () {
        var promotionTypeId = $("#promotion-details").data("promotion-id");
        var propertyId = $('input[name=propertyId]').val();
        var promotionType = $('input[name=promotionType]').val();
        var accountId = 1;
        $("#promotion-details").hide();
        addPromotionByType(propertyId, promotionTypeId, promotionType, accountId);
    });
};

var noTemplate = function () {
    $('#use-template-prompt').hide();
    $("#promotion-details").load("views/addpromotionviews/add" + promotionName + "view.php");
    $('#add-promotion-buttons').empty();
    $('#add-promotion-buttons').append("<button type='button' id='next-page'>Next</button>");

    $('#next-page').click(function () {
        CreateTemplatePrompt();
    });
};

/**
 * Creates a template or promotion
 */
var CreateTemplatePrompt = function () {
    $('#promotion-details').hide();
    $('#save-template-prompt').append("<p> Do you want to create the promotion or save as a template?</p>"+
    "<br><br><br>");
    $('#add-promotion-buttons').empty();


    $('#add-promotion-buttons').append(
        "<button type='button' id='create-template-btn'>Save Template</button>" +
        "<br><br>" +
        "<button type='button' id='create-promotion-btn'>Create Promotion</button>");

    $('#create-template-btn').click(function () {
        $('#add-promotion-buttons').empty();
        $('#add-promotion-buttons').append(
            "<button type='button' id='save-template-btn'>Save Template</button>");
        $('#template-prompt').hide();
        $('#template-data').show();

        $('#save-template-btn').click(function () {
            saveTemplate();
        });
    });

    $('#create-promotion-btn').click(function () {
        var promotionTypeId = $("#promotion-details").data("promotion-id");
        var propertyId = $('input[name=propertyId]').val();
        var promotionType = $('input[name=promotionType]').val();
        var accountId = 1;
        $("#promotion-details").hide();
        addPromotionByType(propertyId, promotionTypeId, promotionType, accountId);
    });
};

/**
 * Inserts a template promotion into the database
 */
var saveTemplate = function () {
    var promotionData = getFormData('add-promotion');
    promotionData['promotionTypeId'] = $('#promotionTypeId').val();
    promotionData['propertyId'] = $('input[name=propertyId]').val();
    promotionData['promotionType'] = $('#promotionTypeName').val();
    promotionData['accountId'] =  1;
    promotionData['templateName'] = $('#template-name').val();
    promotionData['sceneId'] = $('#scene-id').val();
    promotionData['action'] = 'saveTemplate';
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: promotionData,
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
