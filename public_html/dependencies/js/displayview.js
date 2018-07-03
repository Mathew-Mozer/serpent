//TODO COMMENT!!!!

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

var refreshUnassignedDisplay = function(){
    console.log("Should load")
    $("#unassigned-displays").load('views/unassigneddisplayview.php')
};
var deleteUnassignedDisplay = function(id){
    if (confirm('Are you sure you want to remove this display?')) {
        console.log("Deleting: " + id)
        $.ajax({
            url: 'controllers/displaycontroller.php',
            type: 'post',
            data: {action: 'removeUnassignedDisplay', displayId: id},
            cache: false,
            success: function (response) {
                if(response==1){
                    $(".unassigned-display-body[data-display-id="+id+"]").remove()
                }
            }
        });

    } else {
        console.log("Didn't Delete Display")
    }
};
var assignDisplayModal = $("#assign-display").dialog({
    autoOpen: false,
    height: 400,
    width: 350,
    modal: true,
    buttons: {
        Submit: function () {
            //alert($('#unassigneddisplayname').val());
            updateDisplay($('#displayId').html(), $('#displayProperties').val(),$('#unassigneddisplayname').val());
        }
    }
});

var setValuesInModal = function(values) {
    $('#displayId').html(values['id']);
    $('#displayName').html("Display LinkCode: " + values['linkcode']);

    values['properties'].forEach(function(property) {
        $('#displayProperties').append("<option value='" + property['propertyId'] +"'>" + property['propertyName'] + "</option>");
    });
};

var updateDisplay = function(displayId,propertyId,displayname) {

    $.ajax({
        url:'controllers/displaycontroller.php',
        type:'post',
        data:{action:'assignDisplay', displayId: displayId, propertyId: propertyId,displayName:displayname},
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
    width: 800,
    modal: true,
    buttons: {
        Close: function(){
            editDisplayModal.dialog('close');
        }

    }
});
