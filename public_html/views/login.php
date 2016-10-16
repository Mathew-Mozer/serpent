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
        </div>
    </body>
    <script>
        


        $("#loginBtn").click(validateLogin);
        
        function on_enter_key(e) {
            if (e.keyCode == 13) {
                validateLogin();
            return false;
            }
        }   
        
    </script>

</html>
