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


            console.log(json);
            if (json.valid === "yes") {

                $("#errorMessage").empty();

                $("#errorMessage").hide();

                loginModal.dialog('close');

                $('#page').load('views/mainView.php', {id : json.userId});
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
