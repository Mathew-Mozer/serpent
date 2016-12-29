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
<button type="button" id="addUserBtn">Add User</button><button type="button" id="viewUserBtn">View Users</button>
<div id="UserModalContent">
<?php
echo "<script>$('#UserModalContent').load('views/userview.php', {id :" . $_SESSION['userId'] . "});</script>";
?>
</div>
<script src="dependencies/js/editusers.js?t=<?php echo microtime()?>"></script>
