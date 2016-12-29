$("#addUserBtn").click(function () {
    console.log('clicked add user');
    $('#UserModalContent').load("views/newuserview.php", {propertyId: $('#UserModalContent').data('property-id')});
});
$("#createUserBtn").click(function () {
 console.log('clicked it');
    createUser();
});
$(document).on("click", ".editUserBtn", function(){
    console.log("userid:"+$(this).data('account-id'));
    $('#UserModalContent').load("views/EditUserPermissionsView.php", {propertyId: $(this).data('property-id'),userId: $(this).data('account-id')});
});
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
    var userName = $('#theName').val();
    var userPassword = $('#theWord').val();
    var propertyID = $('#UserModalContent').data('property-id');
    $.ajax({
        url: 'controllers/newusercontroller.php',
        type: 'post',
        success: function (response){
          console.log('user created');
        },
        data: {
            action: 'newuser',userName: userName, userPassword: userPassword, propertyID: propertyID}

    })
};