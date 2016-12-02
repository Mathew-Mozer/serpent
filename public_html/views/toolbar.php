<div class="toolbench">
    <div class="toolbar">
        <?php
        if($permission->hasPermissionByAccount('property','C')){
            ?>
            <div id = "create-property-btn" class="button-body tool-button" data-toggle="tooltip" title="Create New Property">
                <!--<span class="glyphicon icon-glyphicon-new-property tool-glyphicon white" aria-hidden="true"></span>-->
                <i class="font-awesome-toolbar fa fa-sitemap fa-3x"></i>
            </div>
            <?php
        }
        if($permission->hasPermissionByAccount('account','C')){

          ?>
        <div id = "" class="button-body tool-button" data-toggle="tooltip" title="Edit User">
            <!--<span class="glyphicon glyphicon-user tool-glyphicon white" aria-hidden="true"></span>-->
            <i class="font-awesome-toolbar fa fa-user fa-3x"></i>
        </div>


        <?php }

        if($permission->hasPermissionByAccount("display","R")) {
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
      }
 ?>


        <div id = "options-btn" class="button-body tool-button" data-toggle="tooltip" title="Options">
            <!--<span class="glyphicon glyphicon-cog tool-glyphicon white" aria-hidden="true"></span>-->
            <i class="font-awesome-toolbar fa fa-cog fa-3x"></i>
        </div>

        <div id = "" class="button-body tool-button" data-toggle="tooltip" title="Request Help">
            <!--<span class="glyphicon glyphicon-comment tool-glyphicon white" aria-hidden="true"></span>-->
            <i class="font-awesome-toolbar fa fa-comment-o fa-3x"></i>
        </div>

        <div id="logoutBtn" class="button-body tool-button" data-toggle="tooltip" title="Logout">
            <!--<span class="glyphicon glyphicon-log-out tool-glyphicon white" aria-hidden="true"></span>-->
            <i class="font-awesome-toolbar fa fa-sign-out fa-3x"></i>
        </div>
    </div>
</div>
