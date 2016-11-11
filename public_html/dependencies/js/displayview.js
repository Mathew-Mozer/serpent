
var getBoxById = function (id) {
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
            updateBox($('#displayId').html(), $('#displayCasinos').val());
        }
    }
});

var setValuesInModal = function(values) {
  $('#displayId').html(values['id']);
  $('#displayName').html("Display ID: " + values['name']);
  $('#displaySerial').html("Display Name: " + values['serial']);
  $('#displayMacAddress').html("MAC Address: " + values['macAddress']);

   values['casinos'].forEach(function(casino) {
        $('#displayCasinos').append("<option value='" + casino['casinoId'] +"'>" + casino['casinoName'] + "</option>");
    });
};

var updateBox = function(displayId,casinoId) {

    $.ajax({
        url:'controllers/displaycontroller.php',
        type:'post',
        data:{action:'assignDisplay', displayId: displayId, casinoId: casinoId},
        cache: false,
        success: function (result) {

            if(result['updated'] |= true){
                console.log(result);
            }
            assignDisplayModal.dialog('close');
            location.reload();
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    })
};
