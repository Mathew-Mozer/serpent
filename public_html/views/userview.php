<?php
if(!isset($_SESSION)) {
    session_start();
}
require "../models/PromotionModel.php";
require "../models/PermissionModel.php";
require "../models/UsersModel.php";
require_once("../dependencies/php/HelperFunctions.php");
require_once(getServerPath() . "dbcon.php");
$dbcon = NEW DbCon();
$promotion = new PromotionModel($dbcon->read_database());
$user = new UsersModel($dbcon->read_database());?>
<?php
            if(isset($_SESSION['userId'])){
                $properties = $promotion->getAssignableProperties();
                foreach ($properties as $property){
                    echo "</bt><div><h1>".$property['property_name']."</h1>";
                    $propertyUsers = $user->getUsers($property['property_id'],$_SESSION['userId']);
                    foreach ($propertyUsers as $propertyuser) {
                        ?>
                        <div class="edit-user-button" data-account-id="<?php echo $propertyuser['account_id'] ?>" data-property-id="<?php echo $property['property_id'] ?>">
                            <?php echo $propertyuser['account_name'] ?>
                        </div>

                        <?php
                    }
                    echo "</div><br><hr>";

                }
}
            ?>
