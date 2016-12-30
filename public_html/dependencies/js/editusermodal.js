/**
 * This file inserts a new user into the database
 */

var editUserModal = $('#editUsersModal').dialog({
    autoOpen: false,
    global: false,
    height: 500,
    width: 500,
    modal: true,
    close: function () {
      $('#UserModalContent').empty();
    }
});
