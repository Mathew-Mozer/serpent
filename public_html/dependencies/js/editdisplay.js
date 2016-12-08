//TODO  COMMENT!!!!!!!!!!!!!

var saveDisplayOptions = function () {

    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'updateDisplaySettings',
            propertyId: $('#property-id').val(),
            displayId: $('#display-id').val(),
            displayName: $('#display-name').val(),
            displayLocation: $('#display-location').val()
        },
        cache: false,
        success: function () {
          $('#update-display-btn').hide();
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

var removePromotionFromDisplay = function (promotionId) {

    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'removePromotion',
            promotionId: promotionId,
            displayId: $('#display-id').val()
        },
        cache: false,
        success: function() {
            editDisplayModal.dialog('close');
            editDisplayModal.dialog('open');
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

var addPromotionToDisplay = function (promotionId) {

    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'addPromotion',
            displayId:  $('#display-id').val(),
            propertyId: $('#property-id').val(),
            skinId: $('#default-skin').val(),
            sceneDuration: $('#default-scene-duration').val(),
            promotionId: promotionId,
            active: 1
        },
        cache: false,
        success: function() {
            editDisplayModal.dialog('close');
            //location.reload();
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

var savePromotionDisplaySettings = function (promotionId,sceneDuration,skinId) {
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
        success: function() {
            $('#save-btn-'+promotionId).hide();
            $('.remove-from-display').show();

        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });

};

$('#update-display-btn').click(function() {
    saveDisplayOptions();
});

$('.remove-from-display').click(function () {
    removePromotionFromDisplay(this.id);
});

$('.add-to-display').click(function () {
    addPromotionToDisplay(this.id);
});

$('.scene-duration').bind("keyup change",function (){
    $('.remove-from-display').hide();
    $('#save-btn-'+this.name).show();
});

$('select').change(function (){
    $('#save-btn-'+this.name).show();
});

$('#display-name').bind("keyup change",function (){
    $('#update-display-btn').show();
});

$('#display-location').bind("keyup change",function (){
    $('#update-display-btn').show();
});

$('.save-btn').click(function () {
    var sceneDuration = $('#scene-duration-'+this.name).val();
    var skinId = $('#skin-id-'+this.name).val();
    savePromotionDisplaySettings(this.name,sceneDuration,skinId);
});