$(document).on("click", "#addUserBtn", function(){
    $('#UserModalContent').load("views/newuserview.php", {propertyId: $('#UserModalContent').data('property-id')});
});

$(document).on("click", "#viewUserBtn", function(){
    console.log("Clicked View Users");
    $('#UserModalContent').load('views/userview.php');
});

$(document).on("click", ".edit-user-button", function(){
    $('#UserModalContent').load("views/EditUserPermissionsView.php", {propertyId: $(this).data('property-id'),userId: $(this).data('account-id')});
});

$(document).on("click", "#createUserBtn", function(){
    console.log('trying to create user');
    createUser();
});

console.log('loaded editusers.js');

var updateUserPermissions = function (userid,propertyid,tagid,modtype,permvalue) {
    var userId = userid;
    var tagId  = tagid;
    var propertyID = propertyid;
    $.ajax({
        url: 'controllers/newusercontroller.php',
        type: 'post',
        success: function (response){
            console.log(response);
        },
        data: {
            action: 'updateUserPermission',userId: userId, tagId:tagId, propertyId: propertyID,modType:modtype,permValue:permvalue}

    })
};
var createUser = function () {
    console.log('trying to create user');
    var userName = $('#theName').val();
    var userPassword = $('#theWord').val();
    var propertyID = $('#propertyID').val();
    $.ajax({
        url: 'controllers/newusercontroller.php',
        type: 'post',
        success: function (response){
          console.log('user created');
            $('#UserModalContent').load('views/userview.php');
        },
        data: {
            action: 'newuser',userName: userName, userPassword: userPassword, propertyID: propertyID}

    })
};