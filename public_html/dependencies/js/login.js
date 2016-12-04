/**
* This file controls login validation
*/

/**
 * Login Validation Root Function
 */
var validateLogin = function () {

    //assign variables from form data
    var s_name = $("#userName").val();
    var s_password = $("#password").val();

    //ajax call to validation controller
    $.ajax({
        url: 'controllers/validationScript.php',
        type: 'post',
        data: {userName: s_name, password: s_password},
        cache: false,
        success: function (json) {
            if (json.valid === "yes") {
                $("#errorMessage").empty();
                $("#errorMessage").hide();
                loginModal.dialog('close');
                $('#page').load('views/mainview.php', {id : json.userId});
                $('#page').show();
            } else {
                //display error message
                ul = document.getElementById("errorMessage");
                $("#errorMessage").empty();
                $("#errorMessage").show();
                $.each(json.errorMessage, function (index, item) {
                    var li = document.createElement("li");
                    li.appendChild(document.createTextNode(item));
                    ul.appendChild(li);
                });
            }
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

/**
* login Modal Window
*/
var loginModal = $("#loginModal").dialog({
    autoOpen: false,
    height: 275,
    width: 350,
    modal: true,
    buttons: {
        Submit: function () {
            validateLogin();
        }
    }
});

/**
 * Bind return key to the login button
 */
$('#password').keypress(function(e) {
    if(e.which == 13) {
        validateLogin();
    }
});

/**
 * Logout the user
 */
var logoutUser = function () {
    $.ajax({
        url: 'controllers/logincontroller.php',
        type: 'post',
        data: {action: 'logout'},
        cache: false,
        success: function () {
            location.reload();
        }
    });
};
