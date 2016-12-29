/**
 * This file inserts a new user into the database
 */

var createUserModal = $('#createUser').dialog({
    autoOpen: false,
    height: 610,
    width: 350,
    modal: true,
    buttons: {
        Submit: function () {
            createUser();
            createUserModal.dialog('close');
        }
    }
});

