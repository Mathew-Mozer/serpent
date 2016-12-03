

var saveDisplayOptions = function () {

    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'update',
            propertyId: $('#property-id').val(),
            displayId: $('#display-id').val(),
            displayName: $('#display-name').val(),
            displayLocation: $('#display-location').val()
        },
        cache: false,
        success: function() {
            location.reload();
            editDisplayModal.dialog('close');
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

var addPromotionToDisplay = function () {

    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'addPromotion'
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

$('#update-display-btn').click(function() {
    saveDisplayOptions();
});

$('.remove-from-display').click(function () {
    removePromotionFromDisplay(this.id);
});

$('.add-to-display').click(function () {
    alert('add clicked');
    addPromotionToDisplay();
});