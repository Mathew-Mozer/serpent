$(document).on("click", "#addUserBtn", function(){
    $('#UserModalContent').load("views/newuserview.php", {propertyId: $('#UserModalContent').data('property-id')});
});

$(document).on("click", "#viewUserBtn", function(){
    console.log("Clicked View Users");
    $('#UserModalContent').load('views/userview.php');
});

$(document).on("click", ".edit-user-button", function(){
    $('#UserModalContent').load("views/EditUserPermissionsView.php", {propertyId: $(this).data('property-id'),userId: $(this).data('account-id')});
    $("#userid").val($(this).data('account-id'));
    $("#account-name").text($(this).text().trim() + "'s");

});

$(document).on("click", "#createUserBtn", function(){
    createUser();
});
$(document).on("input", ".confirm-password-field", function(){
if($("#confirm_password").val()==$("#new_password").val()){
    $("#changeUserPasswordBtn").removeAttr("disabled");
    $msg=""

}else{
    $("#changeUserPasswordBtn").attr("disabled", "disabled");
    $msg="Passwords Do Not Match";
}
    $("#changeUserPasswordMsg").text($msg)
});
$(document).on("click", "#changeUserPasswordBtn", function(){
    updateUserPassword($("#userid").val(),$("#new_password").val());
});

var updateUserPermissions = function (userid,propertyid,tagid,modtype,permvalue) {
    var userId = userid;
    var tagId  = tagid;
    var propertyID = propertyid;
    $.ajax({

        url: 'controllers/newusercontroller.php',
        global: false,
        type: 'post',
        success: function (response){
            console.log(response);
        },
        data: {
            action: 'updateUserPermission',userId: userId, tagId:tagId, propertyId: propertyID,modType:modtype,permValue:permvalue}

    })
};
var updateUserPassword = function (userid,newpassword) {
    var userId = userid;
    var newPassword  = newpassword;
    $.ajax({

        url: 'controllers/newusercontroller.php',
        global: true,
        type: 'post',
        success: function (response){
            $("#changeUserPasswordMsg").text(response);
        },
        data: {
            action: 'updateUserPassword',userId: userId, userPassword:newPassword}
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