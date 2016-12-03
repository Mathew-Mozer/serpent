
var getDisplayById = function (id) {
    $.ajax({
        url: 'controllers/displaycontroller.php',
        type: 'post',
        data: {action: 'getSingleDisplay', displayId: id},
        cache: false,
        success: function (response) {
            var displayValues = $.parseJSON(response);
            setValuesInModal(displayValues);
            assignDisplayModal.dialog('open');
        }
    });
};

var assignDisplayModal = $("#assign-display").dialog({
    autoOpen: false,
    height: 400,
    width: 350,
    modal: true,
    buttons: {
        Submit: function () {
            updateDisplay($('#displayId').html(), $('#displayProperties').val());
        }
    }
});

var setValuesInModal = function(values) {
  $('#displayId').html(values['id']);
  $('#displayName').html("Display ID: " + values['serial']);
  $('#displaySerial').html("Display Name: " + values['name']);
  $('#displayMacAddress').html("MAC Address: " + values['macAddress']);

   values['properties'].forEach(function(property) {
        $('#displayProperties').append("<option value='" + property['propertyId'] +"'>" + property['propertyName'] + "</option>");
    });
};

var updateDisplay = function(displayId,propertyId) {

    $.ajax({
        url:'controllers/displaycontroller.php',
        type:'post',
        data:{action:'assignDisplay', displayId: displayId, propertyId: propertyId},
        cache: false,
        success: function (result) {


            assignDisplayModal.dialog('close');
            location.reload();
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    })
};


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
