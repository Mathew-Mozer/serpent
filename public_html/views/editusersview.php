<?php
/**
 * Created by PhpStorm.
 * User: zhydi
 * Date: 12/23/2016
 * Time: 10:53 AM
 */
if(!isset($_SESSION)) {
    session_start();
}
?>
<button class="btn btn-primary" type="button" id="addUserBtn">Add User</button>&nbsp;<button class="btn btn-primary" type="button" id="viewUserBtn">View Users</button>
    <h3>Change <span id="account-name">Your</span> Password:</h3>
<div id="changeUserPasswordMsg"></div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password:<input type="password" class="confirm-password-field" id="new_password" name="new_password"><br>
    Confirm Password:<input type="password" class="confirm-password-field" id="confirm_password" name="confirm_password"><br>
<input type="hidden" value="<?php echo($_SESSION['userId'])?>" id="userid">
    <button class="btn btn-primary" type="button" id="changeUserPasswordBtn">Change Password</button>
<hr>
<div id="UserModalContent">
<?php
echo "<script>$('#UserModalContent').load('views/userview.php');</script>";
?>
</div>


