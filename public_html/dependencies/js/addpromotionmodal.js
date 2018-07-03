/**
 * This file adds new promotion tiles.
 */

/**
 * This adds a new tile to the tile view with the proper image
 * @param data
 */
var isTemplate=false;
var addPromotion = function (data) {
    data['append_promotion'] = true;
    data['promo_status']=1;
    data['property_point_storage']=$("#promotion-view-modal").data("point-storage");
    $.ajax({
        url: 'views/promotionview.php',
        type: 'post',
        data: data,
        cache: false,
        success: function (html) {
            //$("#promotion-list-" + data['property_id']).append(html);
            $("#promotioncontainer" + data['property_id']).append(html);
            $("#tile-" + data['promo_id']).unbind('click').click(tileBodyClick);
            $("#tile-" + data['promo_id'] + " div div.settingsBtn").unbind('click').click(settingsButtonClick);
            $("#tile-" + data['promo_id'] + " div div.promotionStatusBtn").unbind('click').click(promoStatusButtonClick);
            $("#tile-" + data['promo_id'] + " div div.promotionDeleteBtn").unbind('click').click(promotionDeleteBtnClick);
            $("#tile-" + data['promo_id'] + " div.tile-menu-item").hover(highlightCurrentOption, dehighlightCurrentOption);
            //$("#tile-" + data['promo_id']).hover(showOptionsBar, hideOptionsBar);
            $("#tile-" + data['promo_id']).tooltip();
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};


/**
 * Construct the modal
 * @type {any}
 */
var addPromotionModal = $("#addPromotion").dialog({
    autoOpen: false,
        height: '700',
        width: '1050',
    modal: true
});

var promotionName;

/**
 * When a promotion type is selected from menu
 */
$("div.addPromotion").on('click', function (e) {
    e.preventDefault();
    $('#enable-scene-select').val(false)
    var promotionTypeId = this.id;
    $("#promotion-details").data("promotion-id", $(this).data('promotion-id'));
    promotionName = $(this).data('promotion-name');
    $("#promotion-select").hide();
    $('#use-template').load("views/createtemplateview.php");
    $("#use-template-prompt").hide();
    $("#save-template-prompt").hide();
    $("#template-data").hide();
    $("#select-skin-container").hide();
    $("#select-scene-style").hide();
    $('#use-template').show();
    getTemplateForPromotionType(promotionName,promotionTypeId);
    //$('#add-promotion-buttons').append(
      //  "<button type='button' id='scratch-promotion-btn'>Create New</button>" +
      //  "<br><br>" +
      //  "<button type='button' id='use-template-btn'>Use Template</button>");
});
$(document).on("click", "#scratch-promotion-btn", function () {
    noTemplate();
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
    //$("#use-template-prompt").hide();
    //$('#add-promotion-buttons').empty();
    //$('#select-template').show();
    $.each(response, function(i,obj) {
        $('#promo-templates').append(
            "<div class='promo-template-button' data-propertypromoid='"+obj.promo_property_promo_id+"'>"
            +obj.promo_property_template_name+
            "</div>"
        )
    });
    $('#template-options').show();
    //$('#add-promotion-buttons').append("<button type='button' id='next-page-btn'> Next </button>");

    $('.promo-template-button').click(function () {
        $('#use-template-prompt').hide();
        $('#template-form').load('views/addpromotionviews/add'+promotionName+'view.php',{promotion_template:true});
        $('#template-form').show();
        //addPromotionUsingTemplate($('#template-options').val(),promotionTypeId);
        addPromotionUsingTemplate($(this).data("propertypromoid"),promotionTypeId);
    });
};

var addPromotionUsingTemplate = function (promotionId,promotionTypeId) {
    console.log(promotionId + "-" + promotionTypeId);
    $("#template-form").load("views/addpromotionviews/add"+promotionName+"view.php",{promotion_settings:true,
        promotion_id:promotionId, promotion_type:promotionTypeId,promotion_template:true});
    $('#add-promotion-buttons').empty();
    $('#add-promotion-buttons').append("<button type='button' id='next-page'>Next</button>");
    $('#next-page').click(function () {
        //CreateTemplatePrompt();
        $('#add-promotion').hide();
        isTemplate=true;
        if($('#enable-scene-select').val()=="true"){
            selectStyle();
        }else{
            selectSkin();
        }
    });
    /*
    create button
    */
};

var noTemplate = function () {
console.log("No Template")
    $('#use-temlate').hide();
    $('#use-temlate-prompt').hide();
    $("#promotion-details").load("views/addpromotionviews/add" + promotionName + "view.php",{promotion_template:true,propertyId:$('input[name=propertyId]').val()});
    $('#promotion-details').show();
    $('#add-promotion-buttons').empty();
    $("#use-template-prompt").hide();
    $('#add-promotion-buttons').append("<button type='button' id='next-page'>Next</button>");

    $('#next-page').click(function () {
        //CreateTemplatePrompt();
        $('#add-promotion').hide();
        if($('#enable-scene-select').val()=="true"){
            selectStyle();
        }else{
            selectSkin();
        }
    });
};
var selectStyle = function () {
    $('#use-template-prompt').hide();
    $('#promotion-details').hide();
    $("#select-scene-style").load("views/selectStyle.php",{promotionTypeId:$('input[name=promotionTypeId]').val()});
    $("#select-scene-style").show();
    $('#add-promotion-buttons').empty();
    $('#add-promotion-buttons').append("<button type='button' id='next-page'>Next</button>");

    $('#next-page').click(function () {
        $('#scene-id').val($('input[name=style_id]:checked').val());
        selectSkin();
    });
};
var selectSkin = function () {

    $('#use-template-prompt').hide();
    $('#promotion-details').hide();
    $("#select-scene-style").hide();
    $("#select-skin-container").load("views/selectSkin.php",{propertyId:$('input[name=propertyId]').val()});
    $("#select-skin-container").show();
    $('#add-promotion-buttons').empty();

    if(isTemplate){
        $('#add-promotion-buttons').append("<button type='button' id='create-promotion-btn'>Create Promotion</button>");
        $('#create-promotion-btn').click(function () {
            var promotionTypeId = $("#promotion-details").data("promotion-id");
            var propertyId = $('input[name=propertyId]').val();
            var promotionType = $('input[name=promotionType]').val();
            var accountId = 1;
            var selectedSkin = $('#skin-chooser').val();
            var promotionlabel = $('#Promotion-Label').val();
            var animation = $('#Promotion-Animation').is(":checked");
            $("#promotion-details").hide();
            addPromotionByType(propertyId, promotionTypeId, promotionType, accountId,selectedSkin,promotionlabel,animation);
        });
    }else{
        $('#use-template-prompt').hide();
        $('#promotion-details').hide();
        $("#select-scene-style").hide();
        $('#add-promotion-buttons').append("<button type='button' id='next-page'>Next</button>");

        $('#next-page').click(function () {
            //console.log($('#scene_id').val());
            CreateTemplatePrompt();
        });

    }
};
/**
 * Creates a template or promotion
 */
var CreateTemplatePrompt = function () {
    $('#promotion-details').hide();
    $('#select-skin-container').hide();
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
        var selectedSkin = $('#skin-chooser').val();
        var accountId = 1;
        var promotionlabel = $('#Promotion-Label').val();
        var animation = $('#Promotion-Animation').is(":checked");
        $("#promotion-details").hide();
        addPromotionByType(propertyId, promotionTypeId, promotionType, accountId,selectedSkin,promotionlabel,animation);
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
