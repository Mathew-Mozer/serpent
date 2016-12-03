
var editDisplayModal = $("#editDisplayModal").dialog({
    autoOpen: false,
    height: 450,
    width: 500,
    modal: true,
    buttons: {
        Close: function(){
            editDisplayModal.dialog('close');
        }

    }
});

var saveDisplayOptions = function () {
    alert($('#display-id').val());
    alert($('#display-name').val());
    alert($('#display-location').val());
    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {
            action: 'update',
            propertyId: propertyId,
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

