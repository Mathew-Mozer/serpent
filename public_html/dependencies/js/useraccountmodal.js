
var editUsersModal = $("#editUsers").dialog({
    autoOpen: false,
    height: 400,
    width: 350,
    modal: true,
    buttons: {
        Submit: function () {
            //submit changes to db through options modal class
            editUsers.dialog('close');
        }
    }
});