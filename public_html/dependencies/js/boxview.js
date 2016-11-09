
var getBoxById = function (id) {
    $.ajax({
        url: 'controllers/boxcontroller.php',
        type: 'post',
        data: {action: 'getSingleBox', boxId: id},
        cache: false,
        success: function (response) {
            var boxValues = $.parseJSON(response);
            setValuesInModal(boxValues);
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
  $('#displayName').html("Box ID: " + values['name']);
  $('#displaySerial').html("Box Name: " + values['serial']);
  $('#displayMacAddress').html("MAC Address: " + values['macAddress']);
    console.log(values['casinos']);
   values['casinos'].forEach(function(casino) {
        $('#displayCasinos').append("<option value='" + casino['casinoId'] +"'>" + casino['casinoName'] + "</option>");
    });
};

var updateBox = function(boxId,casinoId) {
    alert(boxId + " " + casinoId);
    $.ajax({
        url:'controllers/boxcontroller.php',
        type:'post',
        data:{action:'updateBox',boxId: boxId, casinoId: casinoId},
        cache: false,
        success: function (result) {
            console.log(result);
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
