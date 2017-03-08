/**
 * This file creates the new property
 */

/**
 * Create the property modal
 * @type {any}
 */
var viewDocumentsModal = $('#createProperty').dialog({
    autoOpen: false,
    height: 610,
    width: 800,
    modal: true,
    title: 'Skin Manager',
    buttons: {
        Close: function () {
            viewDocumentsModal.dialog('close');
        }
    }
});


$(document).on("click",".edit-skin-tag",function () {
    loadSkinTagData($(this).data('tag-id'));
});
$(document).on("click","#save-skin-btn",function () {
console.log('forecolor:' + $('#skin-data-bordercolor').val() )
    $.ajax({
        url: 'controllers/skincontroller.php',
        type: 'post',
        data: {
            action: 'saveskin',
            id:$('#skin-data-id').val(),
            skinid:$('#skinmanager-select-skin').val(),
            tagid:$(this).data('tag-id'),
            xcoor:$('#skin-data-xcoor').val(),
            ycoor:$('#skin-data-ycoor').val(),
            forecolor:$('#skin-data-forecolor').val(),
            backcolor:$('#skin-data-backcolor').val(),
            textcolor:$('#skin-data-textcolor').val(),
            width:$('#skin-data-width').val(),
            height:$('#skin-data-height').val(),
            backsprite:$('#skin-data-backsprite').val(),
            foresprite:$('#skin-data-foresprite').val(),
            bordercolor:$('#skin-data-bordercolor').val()
        },
        cache: false,
        beforeSend: function(){
            $(".loader").removeClass("hidden");
        },
        success: function(response) {

        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        },
        complete: function(){
            $(".loader").addClass("hidden");
        }
    });
});
$(document).on("change","#skinmanager-select-skin",function () {
    loadSkinTags();
});
$(document).on("change","#skinmanager-select-property",function () {
    loadSkinTags();
});
var loadSkinTags = function () {
    $("#skin-tags").load("views/SkinTagView.php", {
        sceneId: $('#skinmanager-select-property').val(),
        skinId: $('#skinmanager-select-skin').val()
    });
    checkSaveButton();
}
var loadSkinTagData = function (tagid) {
    $("#skin-data").load("views/SkinTagEditView.php", {
        skinTagId: tagid,
        skinId:$('#skinmanager-select-skin').val()
    });
   checkSaveButton();
}
function checkSaveButton () {
    if($.isNumeric($('#skinmanager-select-skin').val())){
        $('#errorlabel').hide();
        $('#save-skin-btn').show();
    }else {
        $('#save-skin-btn').hide();
        $('#errorlabel').show();
    }
}


