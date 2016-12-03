

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

$('#update-display-btn').click(function() {
    alert('Clicked');
    saveDisplayOptions();
});

$('');

