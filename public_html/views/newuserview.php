<?php
if(!isset($_SESSION)) {
    session_start();
}
require "../models/PromotionModel.php";
require "../models/PermissionModel.php";
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
$promotion = new PromotionModel($dbcon->read_database());
?>
<div id="createUser" style="" title="Create User">
<br>
    <form id="userForm" autocomplete="off">
        <label for="theName">Username</label><br>
        <input type="text" id="theName" name="theName" autocomplete="off" value="" placeholder="username" readonly onfocus="this.removeAttribute('readonly')" required>
        <br/>
        <br/>
        <label for="theWord">Password</label><br>
        <input type="password" id="theWord" name="theWord"  value="" placeholder="password" required>
        <br/>
        <br/>
        <label for="propertyID">Select Property</label><br>
        <select id="propertyID" name="propertyID">
            <?php
            if(isset($_SESSION['userId'])){
                $properties = $promotion->getAssignableProperties();
                foreach ($properties as $property){
                    echo "<option value='" . $property['property_id'] . "'>" . $property['property_name'] . "</option>";
                }
            }
            ?>
        </select>

        <br/>
        <br/>
<button type="button" id="createUserBtn">Create User</button>

</div>
