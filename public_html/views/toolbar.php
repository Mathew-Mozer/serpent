<?php
/**
 * This is the toolbar that defines what options a user has based on their permissions
 */
?>
<div class="toolbench">
    <div class="toolbar">

            <div id = "view-documents-btn" class="button-body tool-button" data-toggle="tooltip" title="Documents">
                <!--<span class="glyphicon icon-glyphicon-new-property tool-glyphicon white" aria-hidden="true"></span>-->
                <i class="font-awesome-toolbar fa fa-folder-o fa-3x"></i>
            </div>
            <?php

        if($permission->hasPermissionByAccount('account','R')||$_SESSION['isGod']){

          ?>
        <div id = "userBtn" class="button-body tool-button" data-toggle="tooltip" title="Edit User">
            <!--<span class="glyphicon glyphicon-user tool-glyphicon white" aria-hidden="true"></span>-->
            <i class="font-awesome-toolbar fa fa-group fa-3x"></i>
        </div>


        <?php }

        if($permission->hasPermissionByAccount("display","R")||$_SESSION['isGod']) {
        ?>


        <div id = "toggle-display" class="toggle-display-btn button-body tool-button" data-toggle="tooltip" title="Switch to Display View">
            <!--<span class="glyphicon glyphicon-tasks tool-glyphicon white" aria-hidden="true"></span>-->
            <i class="font-awesome-toolbar fa fa-tasks fa-3x"></i>
        </div>


        <div id = "toggle-promotion" class="toggle-display-btn hidden button-body tool-button" data-toggle="tooltip" title="Switch to Promotion View">
            <!--<span class="glyphicon glyphicon-certificate tool-glyphicon white" aria-hidden="true"></span>-->
            <i class="font-awesome-toolbar fa fa-star-half-full fa-3x"></i>
        </div>
            <?php
            if($permission->hasPermissionByAccount('property','C')||$_SESSION['isGod']) {
                ?>
                <div id="create-property-btn" class="button-body tool-button" data-toggle="tooltip"
                     title="Create New Property">
                    <!--<span class="glyphicon icon-glyphicon-new-property tool-glyphicon white" aria-hidden="true"></span>-->
                    <i class="font-awesome-toolbar fa fa-sitemap fa-3x"></i>
                </div>
                <?php
            }

            ?>
        <?php
      }
 ?>


        <div id = "options-btn" class="button-body tool-button hidden" data-toggle="tooltip" title="Options">
            <!--<span class="glyphicon glyphicon-cog tool-glyphicon white" aria-hidden="true"></span>-->
            <i class="font-awesome-toolbar fa fa-cog fa-3x"></i>
        </div>

        <div id = "" class="button-body tool-button hidden" data-toggle="tooltip" title="Request Help">
            <!--<span class="glyphicon glyphicon-comment tool-glyphicon white" aria-hidden="true"></span>-->
            <i class="font-awesome-toolbar fa fa-comment-o fa-3x"></i>
        </div>
        <?php
        if($_SESSION['isGod']) {
            ?>
            <div id="skin-manager-btn" class="button-body tool-button" data-toggle="tooltip" title="Skin Manager">
                <!--<span class="glyphicon icon-glyphicon-new-property tool-glyphicon white" aria-hidden="true"></span>-->
                <i class="font-awesome-toolbar fa fa-paint-brush fa-3x"></i>
            </div>
            <?php
        }

        ?>
        <?php
        if($permission->hasPermissionByAccount('billing','R')||$_SESSION['isGod']) {
            ?>
            <div id="view-account-btn" class="button-body tool-button" data-toggle="tooltip"
                 title="Administrator Account Information">
                <!--<span class="glyphicon icon-glyphicon-new-property tool-glyphicon white" aria-hidden="true"></span>-->
                <i class="font-awesome-toolbar fa fa-user fa-3x"></i>
            </div>
            <?php
        }

        ?>
        <div id="logoutBtn" class="button-body tool-button" data-toggle="tooltip" title="Logout">
            <!--<span class="glyphicon glyphicon-log-out tool-glyphicon white" aria-hidden="true"></span>-->
            <i class="font-awesome-toolbar fa fa-sign-out fa-3x"></i>
        </div>

    </div>
</div>
