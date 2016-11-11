<div class="toolbench">
    <div class="toolbar">
        <?php
        if($permission->hasPermissionByAccount('casino','C')){
            ?>
            <div id = "create-casino-btn" class="button-body tool-button" data-toggle="tooltip" title="Create New Property">
                <span class="glyphicon glyphicon-home tool-glyphicon white" aria-hidden="true"></span>
            </div>
            <?php
        }
        if($permission->hasPermissionByAccount('account','C')){

          ?>
        <div id = "" class="button-body tool-button" data-toggle="tooltip" title="Edit User">
            <span class="glyphicon glyphicon-user tool-glyphicon white" aria-hidden="true"></span>
        </div>


        <?php }

        if($permission->hasPermissionByAccount("display","R")) {
        ?>


        <div id = "toggle-display" class="toggle-display-btn button-body tool-button" data-toggle="tooltip" title="Switch to Display View">
            <span class="glyphicon glyphicon-tasks tool-glyphicon white" aria-hidden="true"></span>
        </div>


        <div id = "toggle-promotion" class="toggle-display-btn hidden button-body tool-button" data-toggle="tooltip" title="Switch to Promotion View">
            <span class="glyphicon glyphicon-certificate tool-glyphicon white" aria-hidden="true"></span>
        </div>
        <?php
      }
 ?>


        <div id = "" class="button-body tool-button" data-toggle="tooltip" title="Options">
            <span class="glyphicon glyphicon-cog tool-glyphicon white" aria-hidden="true"></span>
        </div>

        <div id = "" class="button-body tool-button" data-toggle="tooltip" title="Request Help">
            <span class="glyphicon glyphicon-comment tool-glyphicon white" aria-hidden="true"></span>
        </div>

        <div id="logoutBtn" class="button-body tool-button" data-toggle="tooltip" title="Logout">
            <span class="glyphicon glyphicon-log-out tool-glyphicon white" aria-hidden="true"></span>

        </div>
    </div>
</div>
