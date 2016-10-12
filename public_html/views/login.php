<?php
    include('../dependencies/php/header.php');
    $_SESSION['test'] = 'test';
?>
<!-- Login form -->
<html>
    <head>
        <script src="http://code.jquery.com/jquery.js"></script>
        <link href="../dependencies/css/login.css" rel="stylesheet">
    <body>
        <div class="loginForm" id="mainLoginForm">
            <ul id="errorMessage" hidden> </ul>

            <input type="text" name="userName" id="userName" placeholder="User Name" onkeypress="return on_enter_key(event)">
            <br/>
            <br/>
            <input type="password" name="password" id="password" placeholder="Password">
            <br/>
            <br/>
            <button type="submit" name="loginBtn" id="loginBtn">Login</button>

        </div>
    </body>
    <script>
        
        var validateLogin = function() {

            //assign variables from form data
            var s_name = $("#userName").val();
            var s_password = $("#password").val();

            //ajax call to validation controller
            $.ajax({
                url: '../controllers/validationScript.php',
                type: 'post',
                data: {userName: s_name, password : s_password},
                cache: false,
                success: function(json) {
                    //if returned data is formatted correctly
                    if (json.valid === "yes"){

                        $("#errorMessage").empty();
                        $("#errorMessage").hide();
                        alert("You are now logged in");
                        window.location.replace("http://casino.greenrivertech.net/promotionPageTest.php");
                    }else{

                        //display error message
                        ul = document.getElementById("errorMessage");
                        $("#errorMessage").empty();
                        $("#errorMessage").show();
                        $.each(json.errorMessage, function(index, item){
                            var li = document.createElement("li");
                            li.appendChild(document.createTextNode(item));
                            ul.appendChild(li);
                        });
                    }
                },
                error: function(xhr, desc, err){
                    console.log(xhr + "\n" + err);
                }
            });
        };

        $("#loginBtn").click(validateLogin);
        
        function on_enter_key(e) {
            if (e.keyCode == 13) {
                validateLogin();
            return false;
            }
        }   
        
    </script>

</html>
