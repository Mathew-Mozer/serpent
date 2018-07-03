<?php
session_start();
/**
 *	This script builds the entire main page
 *	This needs to be cleaned up and recommended
 *	Several models are mislabeled as modals.
 *
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once "../models/PromotionModel.php";
    //require_once "../models/PropertyDisplays.php";
    require "../models/PermissionModel.php";
    require_once("../dependencies/php/HelperFunctions.php");
    require_once(getServerPath() . "dbcon.php");

    //Create database connection object
    $dbcon = NEW DbCon();

    //Create models
    $promotion = new PromotionModel($dbcon->read_database());
    $permission = new PermissionModel($dbcon->update_database(), $_POST['id']);

    //Another require
    require 'toolbar.php';


    //Create Property objects
    $propertyList = $promotion->getPromotionProperties();
    $propertyCount = count($propertyList);
    $propertyRowIndex = 0;

    //List all the properties that the current user has permissions to view

    if ($permission->hasPermissionByAccount('display_manager','C')||$_SESSION['isGod']) {
        require "unassigneddisplayview.php";
    }
    foreach ($propertyList as $property) {
        //If the permission checks out, print the promotion
        if ($permission->hasPermissionById('property', $property['property_id'],'R')||$_SESSION['isGod']) {
            include('propertyview.php');
            $propertyRowIndex++;
            ?>
           <!--
                <hr>

                <div id="displayViewContainer<?php echo($property['property_id']) ?>">
                <?php
            //    include 'displayview.php';
            ?>
            </div>
            -->
            <?php

        }
    }


    //If they have no permissions to view a property, let them know.
    if ($propertyRowIndex == 0) { ?>
        <div>
            <h3>You are not currently assigned to any properties.</h3>
            <p>Please contact your supervisor for property pillages.</p>
        </div>
    <?php }

    include '../dependencies/php/footer.php';
}
?>